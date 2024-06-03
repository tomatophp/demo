<nav aria-label="Breadcrumb">
    <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 lg:max-w-7xl">
        <li>
            <div class="flex items-center">
                <x-splade-link href="/" class="ltr:mr-2 rtl:ml-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">{{__('Home')}}</x-splade-link>
                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-zinc-300 dark:text-zinc-700">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
            </div>
        </li>
        @foreach($links as $key=>$link)
            <li>
                <div class="flex items-center">
                    @if($key === count($links) - 1)
                        <x-splade-link href="{{$link['url']}}" aria-current="page" class="font-medium text-zinc-900 dark:text-zinc-100 dark:hover:text-zinc-400 hover:text-zinc-600">{{$link['label']}}</x-splade-link>
                    @else
                        <x-splade-link href="{{$link['url']}}" class="ltr:mr-2 rtl:ml-2  text-sm font-medium text-zinc-500 dark:text-zinc-400">{{$link['label']}}</x-splade-link>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-zinc-300 dark:text-zinc-700">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
