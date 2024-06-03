@extends('ecommerce-theme::layouts.profile')

@section('body')
    <div class="w-full">
        <div class="flex justify-between items-center my-4">
            <h1 class="text-2xl font-bold">{{__('Wallet')}}</h1>
            <x-tomato-admin-button modal :href="route('profile.wallet.create')">
                {{__('Change Balance')}}
            </x-tomato-admin-button>
        </div>
        <div class="flex items-center p-4 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-xs my-4">
            <div class="p-3 ltr:mr-4 rtl:ml-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <x-heroicon-s-currency-dollar class="w-4 h-4" />
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                    {{__('Account Balance')}}
                </p>
                <p class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">
                    {!! dollar(auth('accounts')->user()->balance) !!}
                </p>
            </div>
        </div>

        <x-splade-table :for="$table" striped>
            <x-splade-cell amount>
                <x-tomato-admin-row table value="{!! dollar($item->amount) !!}" />
            </x-splade-cell>
            <x-splade-cell confirmed>
                <x-tomato-admin-row table type="bool" :value="$item->confirmed" />
            </x-splade-cell>

            <x-splade-cell actions>
                <div class="flex justify-start">
                    <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('profile.wallet.show', $item->id)">
                        <x-heroicon-s-eye class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </div>
            </x-splade-cell>
        </x-splade-table>

    </div>
@endsection
