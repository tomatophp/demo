@extends('ecommerce-theme::layouts.master')

@section('content')
    <div class="flex flex-col items-center border-b dark:border-zinc-700 bg-white dark:bg-zinc-900 py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{__('Checkout')}}</div>
    </div>

    <x-splade-form method="POST" action="{{route('checkout.submit')}}" :default="array_merge(auth('accounts')->user()->toArray(), [
        'shipper_id' => $shippers[0]? $shippers[0]->id : auth('accounts')->user()->meta('shipper_id') ?? null,
        'payment_method' => 'cash',
        'city_id' => auth('accounts')->user()->meta('city_id'),
        'country_id' => auth('accounts')->user()->meta('country_id'),
        'area_id' => auth('accounts')->user()->meta('area_id'),
        'payment_method' => auth('accounts')->user()->meta('payment_method'),
    ])">
    <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
        <div class="px-4 pt-8">
            <p class="text-xl font-medium">{{__('Order Summary')}}</p>
            <p class="text-zinc-400">{{__('Check your items. And select a suitable shipping method.')}}</p>
            <div class="mt-8 gap-3 rounded-lg border dark:border-zinc-700 bg-white dark:bg-zinc-800 px-2 py-4 sm:px-6">
                @foreach($carts as $cart)
                    <div class="flex flex-col rounded-lg bg-white dark:bg-zinc-800 sm:flex-row">
                        @if($cart->product?->getMedia('featured_image')?->first())
                        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center" src="{{$cart->product?->getMedia('featured_image')?->first()?->getUrl() ?? url('placeholder.webp')}}" alt="" />
                        @else
                            <div class="m-2 h-24 w-28 flex flex-col justify-center items-center bg-zinc-200 dark:bg-zinc-900 rounded-lg">
                                <i class="bx bxs-cart text-4xl"></i>
                            </div>
                        @endif
                            <div class="flex w-full flex-col px-4 py-4">
                            <span class="font-semibold">{{$cart->item}}</span>
                            <span class="float-right text-zinc-400 dark:text-zinc-200">
                                @foreach($cart->options as $key=>$option)
                                    {{str($key)->ucfirst()}} : {{$option}} <br>
                                @endforeach
                            </span>
                            <p class="text-lg font-bold">{!! dollar(($cart->price + $cart->vat) - $cart->discount) !!} × {{$cart->qty}} = {!! dollar($cart->total) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="mt-8 text-lg font-medium">{{__('Shipping Methods')}}</p>
            <div class="mt-5 grid gap-6 my-4">
                @foreach($shippers as $shipper)
                    <div class="relative" @click.prevnt="form.shipper_id = @js($shipper->id)">
                        <span v-bind:class="{'border-primary-600':form.shipper_id === @js($shipper->id)}" class="absolute rtl:left-4 ltr:right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8"></span>
                        <label v-bind:class="{'border border-zinc-200 bg-white dark:bg-zinc-800 dark:border-zinc-700':form.shipper_id === @js($shipper->id)}" class="flex cursor-pointer select-none rounded-lg border p-4">
                            @if($shipper->getMedia('logo')?->first()?->getUrl())
                            <div class="w-14 h-14 bg-center bg-contain rounded-lg border" style="background-image: url('{{$shipper->getMedia('logo')?->first()?->getUrl() ?? url('placeholder.webp')}}')">

                            </div>
                            @else
                                <div class="w-14 h-14 flex flex-col justify-center items-center bg-zinc-200 dark:bg-zinc-900 rounded-lg">
                                    <i class="bx bxs-truck text-2xl"></i>
                                </div>
                            @endif
                            <div class="rtl:mr-5 ltr:ml-5">
                                <span class="mt-2 font-semibold">{{$shipper->name}}</span>
                                <p class="text-slate-500 text-sm leading-6">{{__('Delivery: 2-4 Days')}}</p>
                            </div>
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="mt-10 bg-zinc-50 dark:bg-zinc-800 px-4 pt-8 lg:mt-0">
            <p class="text-xl font-medium">{{__('Payment Details')}}</p>
            <p class="text-zinc-400">{{__('Complete your order by providing your payment details.')}}</p>
            <div class="my-4 flex flex-col gap-4">
                <x-splade-input disabled name="name" type="text"  label="{{__('Name')}}" placeholder="{{__('Your Name')}}" />
                <x-splade-input disabled name="email" type="email"  label="{{__('Email')}}" placeholder="{{__('Your Email')}}" />
                <x-splade-input disabled name="phone" type="tel"  label="{{__('Phone')}}" placeholder="{{__('Your Phone')}}" />
                <x-splade-textarea name="address" type="text"  label="{{__('Address')}}" placeholder="{{__('Your Address')}}" />
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-splade-select
                        choices
                        remote-url="{{route('checkout.select') . '?type=country'}}"
                        remote-root="data"
                        name="country_id"
                        label="{{__('County')}}"
                        placeholder="{{__('Your County')}}"
                        option-label="name"
                        option-value="id"
                    />
                    <x-splade-select
                        choices
                        remote-url="`{{route('checkout.select') . '?type=city&country_id='}}${form.country_id}`"
                        remote-root="data"
                        name="city_id"
                        label="{{__('City')}}"
                        placeholder="{{__('Your City')}}"
                        option-label="name"
                        option-value="id"
                    />
                    <x-splade-select
                        choices
                        remote-url="`{{route('checkout.select') . '?type=area&city_id='}}${form.city_id}`"
                        remote-root="data"
                        name="area_id"
                        label="{{__('Area')}}"
                        placeholder="{{__('Your Area')}}"
                        option-label="name"
                        option-value="id"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{__('Payment Methods')}}</label>
                    <div class="flex justify-start gap-4 my-2">
                        <x-splade-radio name="payment_method" value="cash" label="{{__('Cash')}}" />
                        <x-splade-radio name="payment_method" value="wallet" label="{{__('Wallet')}}" />
                        <x-splade-radio name="payment_method" value="card" label="{{__('Credit Card')}}" />
                    </div>
                </div>
                <x-splade-defer url="{{route('checkout.shipping')}}" method="POST" watch-value="form.area_id" request="{country_id: form.country_id, city_id: form.city_id, area_id: form.area_id, shipper_id: form.shipper_id}">

                <div v-if="form.payment_method === 'wallet'" v-bind:class="{'text-danger-500': @js(auth('accounts')->user()->balance) <= (@js($carts->map(fn($item)=> $item->total)->sum())) , 'text-success-500': (@js(auth('accounts')->user()->balance) >= @js($carts->map(fn($item)=> $item->total)->sum())) }">
                    <span>{{__('You Wallet Balance Is: ')}} @{{ Intl.NumberFormat('en-US', {style: 'currency',currency: @js(setting('local_currency'))}).format(@js(auth('accounts')->user()->balance)) }}</span>
                    @if(auth('accounts')->user()->balance < $carts->map(fn($item)=> $item->total)->sum())
                        <div>
                            {{__('Please Recharge Your Wallet')}}
                        </div>
                    @endif
                </div>

                <!-- Total -->

                <div class="mt-6 border-t dark:border-zinc-700 border-b py-2">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{__('Subtotal')}}</p>
                        <p class="text-zinc-900 dark:text-zinc-100 font-bold">@{{ Intl.NumberFormat('en-US', {style: 'currency',currency: @js(setting('local_currency'))}).format(@js($carts->map(fn($item)=> $item->total)->sum())) }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{__('Shipping')}}</p>
                            <p class="font-semibold text-zinc-900 dark:text-zinc-100"><span class="font-bold">@{{ response.price ? Intl.NumberFormat('en-US', {style: 'currency',currency: @js(setting('local_currency'))}).format(response.price) : Intl.NumberFormat('en-US', {style: 'currency',currency: @js(setting('local_currency'))}).format(0) }}</span></p>

                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{__('Total')}}</p>
                    <p class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        <span class="font-bold">@{{ response.price ? Intl.NumberFormat('en-US', {style: 'currency',currency: @js(setting('local_currency'))}).format(response.price + @js($carts->map(fn($item)=> $item->total)->sum())) : Intl.NumberFormat(@js(app()->getLocale() === 'ar' ? 'ar-EG' : 'en-US'), {style: 'currency',currency: @js(setting('local_currency'))}).format(@js($carts->map(fn($item)=> $item->total)->sum())) }}</span>
                    </p>
                </div>
                </x-splade-defer>
            </div>
            <x-tomato-admin-submit spinner  class="mt-4 mb-8 w-full rounded-md bg-zinc-900 px-6 py-3 font-medium text-white">{{__('Place Order')}}</x-tomato-admin-submit>
        </div>
    </div>
    </x-splade-form>
@endsection
