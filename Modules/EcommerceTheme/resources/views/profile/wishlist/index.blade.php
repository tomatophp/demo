@extends('ecommerce-theme::layouts.master')

@section('content')
    <div class="bg-white dark:bg-zinc-900 min-h-screen">
        <div class="flex flex-col items-center border-b border-zinc-200 dark:border-zinc-700 py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
            <div class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{__('Wishlist')}}</div>
        </div>
        <div class="sm:px-10 lg:px-20 xl:px-32 my-4">
            <x-splade-modal>
                <x-slot:title>
                    {{__('Wishlist')}}
                </x-slot:title>

                @if($products->count())
                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 xl:gap-x-8">
                        @foreach($products as $product)
                            @include('tomato-sections::sections.shop.partials.product-card', ['product' => $product->product])
                        @endforeach
                    </div>

                    <div class="my-4">
                        {!! $products->links('tomato-sections::sections.pagination') !!}
                    </div>
                @else
                    <div>
                        {{__('You have no products in your wishlist.')}}
                    </div>
                @endif
            </x-splade-modal>
        </div>
    </div>
@endsection
