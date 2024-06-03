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
                        {{__('Verify OTP')}}
                    </h1>

                    <p class="mt-4 leading-relaxed text-zinc-500 dark:text-zinc-200">
                        {{ __('Please input code you got on your email and your new password')  }}
                    </p>

                    <x-splade-form action="{{route('accounts.reset.submit')}}" class="mt-8 grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <x-splade-input
                                label="{{__('OTP')}}"
                                type="number"
                                id="otp"
                                name="otp_code"
                            />
                        </div>
                        <div class="col-span-6">
                            <x-splade-input
                                label="{{__('Password')}}"
                                type="password"
                                name="password"
                            />
                        </div>

                        <div class="col-span-6">
                            <x-splade-input
                                label="{{__('Password Confirmation')}}"
                                type="password"
                                name="password_confirmation"
                            />
                        </div>

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <x-tomato-admin-submit spinner>
                                {{__('Reset Password')}}
                            </x-tomato-admin-submit>

                            <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-200 sm:mt-0">
                                {{__("Don't get the code?")}}
                                <x-splade-link href="{{route('accounts.otp.resend')}}" class="text-zinc-700 dark:text-zinc-300 underline" method="POST">{{__('Resend')}}</x-splade-link>.
                            </p>

                        </div>
                    </x-splade-form>
                </div>
            </main>
        </div>
    </section>
@endsection
