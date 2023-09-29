<div class="flex flex-col justify-center">
    <div class="flex justify-end gap-4  underline mx-4 my-4 relative">
        @if (Route::has('login') && Auth::check())
            <x-splade-link href="{{ url('/admin') }}">Dashboard</x-splade-link>

        @elseif (Route::has('login') && !Auth::check())
            <x-splade-link href="{{ url('/login') }}">Login</x-splade-link>
            <x-splade-link href="{{ url('/register') }}">Register</x-splade-link>
        @endif
    </div>

    <div class="h-screen flex flex-col justify-center items-center">
        <x-splade-link href="/" class="flex justify-center">
            <x-application-logo />
        </x-splade-link>

        <div class="flex justify-center gap-4 my-4">
            <a href="https://docs.tomatophp.com" target="_blank">Documentation</a>
            <a href="https://discord.com/invite/VZc8nBJ3ZU" target="_blank">Discord</a>
            <a href="https://x.com/engfadymondy" target="_blank">Twitter</a>
            <a href="https://www.github.com/tomatophp" target="_blank">Github</a>
        </div>
    </div>
</div>
