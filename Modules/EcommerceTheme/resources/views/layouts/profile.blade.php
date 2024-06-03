@extends('ecommerce-theme::layouts.master')

@section('content')
   <div class="dark:bg-zinc-900 dark:text-zinc-100 min-h-screen flex justify-center">
       <div class="w-full px-8 sm:px-16 md:px-32 lg:px-48">
           <div class="flex flex-col gap-4 justify-center items-center text-center my-8">
               <div>
                   @php
                       $email = auth('accounts')->user()->email;
                       $default = url('placeholder.webp');
                       $size = 200;
                       $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=mp&s=" . $size;
                   @endphp

                   <img src="{{$grav_url}}" alt="" class="w-32 h-32 mx-auto rounded-full dark:bg-zinc-500 aspect-square">
                   <div class="space-y-4 text-center divide-y dark:divide-zinc-700">
                       <div class="my-2 space-y-1">
                           <x-splade-link :href="route('profile.edit')" class="text-xl font-semibold sm:text-2xl">{{auth('accounts')->user()->name}}</x-splade-link>
                           <p class="px-5 text-xs sm:text-base dark:text-zinc-400">{{auth('accounts')->user()->email}}</p>
                       </div>
                   </div>
               </div>
               <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4 w-full">
                   <!-- Card -->
                   <div class="flex items-center p-4 bg-white border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-xs dark:bg-zinc-800">
                       <div class="p-3 ltr:mr-4 rtl:ml-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                           <x-heroicon-s-star class="w-4 h-4" />
                       </div>
                       <div>
                           <p class="mb-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                               {{__('Product Reviews')}}
                           </p>
                           <p class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">
                               {{ auth('accounts')->user()->reviews->count() }}
                           </p>
                       </div>
                   </div>
                   <!-- Card -->
                   <x-splade-link :href="route('profile.wallet.index')" class="flex items-center p-4 bg-white border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-xs dark:bg-zinc-800">
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
                   </x-splade-link>
                   <!-- Card -->
                   <x-splade-link :href="route('profile.wishlist.index')" class="flex items-center p-4 bg-white border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-xs dark:bg-zinc-800">
                       <div class="p-3 ltr:mr-4 rtl:ml-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                           <x-heroicon-s-shopping-cart class="w-4 h-4" />
                       </div>
                       <div>
                           <p class="mb-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                               {{__('My Wishlist')}}
                           </p>
                           <p class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">
                               {{ auth('accounts')->user()->wishlist->count() }}
                           </p>
                       </div>
                   </x-splade-link>
                   <!-- Card -->
                   <x-splade-link :href="route('profile.orders.index')" class="flex items-center p-4 bg-white border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-xs dark:bg-zinc-800">

                       <div class="p-3 ltr:mr-4 rtl:ml-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                           <x-heroicon-s-rocket-launch class="w-4 h-4" />
                       </div>
                       <div>
                           <p class="mb-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                               {{__('My Orders')}}
                           </p>
                           <p class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">
                               {{ auth('accounts')->user()->orders->count() }}
                           </p>
                       </div>
                   </x-splade-link>
               </div>

               @yield('body')
           </div>
       </div>
   </div>
@endsection
