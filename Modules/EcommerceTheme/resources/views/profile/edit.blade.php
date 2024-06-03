@extends('ecommerce-theme::layouts.profile', ['withoutCard' => true])

@section('body')
    @php $user = auth('accounts')->user(); @endphp
    <div class="w-full">
        <div class="flex justify-between items-center my-4">
            <h1 class="text-2xl font-bold">{{__('Edit Profile')}}</h1>
        </div>
        <div class="flex flex-col gap-6">
            <div class="dark:bg-zinc-800 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div dusk="update-profile-information">
                    @include('ecommerce-theme::profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="dark:bg-zinc-800 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div  dusk="update-password">
                    @include('ecommerce-theme::profile.partials.update-password-form')
                </div>
            </div>

            <div class="dark:bg-zinc-800 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div  dusk="delete-user">
                    @include('ecommerce-theme::profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
