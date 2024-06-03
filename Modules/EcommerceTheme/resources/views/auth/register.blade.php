@extends('ecommerce-theme::layouts.master')

@section('content')
    <section class="bg-white dark:bg-zinc-900 h-screen">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <aside
                class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"
            >
                <img
                    alt="Pattern"
                    src="https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                    class="absolute inset-0 h-full w-full object-cover"
                />
            </aside>

            <main
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
            >
                <div class="max-w-xl lg:max-w-3xl">
                    <a class="block text-blue-600" href="/">
                        <span class="sr-only">{{__('Home')}}</span>
                        <img src="{{setting('site_logo')}}" alt="{{setting('site_name')}}" class="h-16" />
                    </a>

                    <h1
                        class="mt-6 text-2xl font-bold text-zinc-900 dark:text-zinc-100 sm:text-3xl md:text-4xl"
                    >
                        {{__('Register')}}
                    </h1>

                    <p class="mt-4 leading-relaxed text-zinc-500 dark:text-zinc-200">
                        {{ __('Please fill all fields to register a new account')  }}
                    </p>

                    <x-splade-form action="{{route('accounts.register.store')}}" class="mt-8 grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label
                                for="Name"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300"
                            >
                                {{__('Name')}}
                            </label>

                            <x-splade-input
                                id="Name"
                                type="text"
                                name="name"
                            />
                        </div>


                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                {{__('Email')}}
                            </label>

                            <x-splade-input
                                id="Email"
                                type="email"
                                name="email"
                            />
                        </div>

                        <div class="col-span-6">
                            <label for="Phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                {{__('Phone')}}
                            </label>

                            <x-splade-input
                                id="Phone"
                                type="tel"
                                name="phone"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label
                                for="Password"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300"
                            >
                                {{__('Password')}}
                            </label>

                            <x-splade-input
                                type="password"
                                id="Password"
                                name="password"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label
                                for="PasswordConfirmation"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300"
                            >
                                {{__('Password Confirmation')}}
                            </label>

                            <x-splade-input
                                type="password"
                                id="PasswordConfirmation"
                                name="password_confirmation"
                            />
                        </div>

                        <div class="col-span-6">
                            <label for="MarketingAccept" class="flex gap-2">
                                <x-splade-checkbox
                                    type="checkbox"
                                    id="MarketingAccept"
                                    name="marketing_accept"
                                />

                                <span class="text-sm text-zinc-700 dark:text-zinc-300">
                                    {{__('I want to receive emails about events, product updates and
                                company announcements.')}}
                              </span>
                            </label>
                        </div>

                        <div class="col-span-6">
                            <p class="text-sm text-zinc-500 dark:text-zinc-200">
                                {{__('By creating an account, you agree to our')}}
                                <x-splade-link href="{{url('/terms')}}" class="text-zinc-700 dark:text-zinc-300 underline">
                                    {{__('terms and conditions')}}
                                </x-splade-link>
                                {{__('and')}}
                                <x-splade-link href="{{url('/privacy')}}" class="text-zinc-700 dark:text-zinc-300 underline">{{__('privacy policy')}}</x-splade-link>.
                            </p>
                        </div>

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <x-tomato-admin-submit
                                spinner
                            >
                                {{__('Create an account')}}
                            </x-tomato-admin-submit>

                            <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-200 sm:mt-0">
                                {{__('Already have an account?')}}
                                <x-splade-link href="{{route('accounts.login')}}" class="text-zinc-700 dark:text-zinc-300 underline">{{__('Log in')}}</x-splade-link>.
                            </p>
                        </div>
                    </x-splade-form>
                </div>
            </main>
        </div>
    </section>
@endsection
