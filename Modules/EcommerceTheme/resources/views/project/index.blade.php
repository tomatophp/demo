@extends('ecommerce-theme::layouts.master')
@section('title', $project->title)
@section('description', $project->short_description)
@section('keywords', $project->keywords)
@if($project->getMedia('feature') && count($project->getMedia('feature')))
    @section('image', $project->getFirstMediaUrl('feature'))
@endif

@section('content')
    <section class="relative overflow-hidden dark:text-white bg-zinc-200 dark:bg-zinc-800 font-main">
        <div class="max-w-screen-xl px-8 py-32 mx-auto lg:items-center lg:flex">
            <div class="max-w-3xl mx-auto text-center">
                <h1
                    class="py-2 text-3xl font-extrabold  sm:text-5xl bg-clip-text bg-gradient-to-r text-main">
                    {{ $project->title }}
                </h1>
                <p class="my-1 text-lg text-white">{{ $project->short_description }}</p>

            </div>
        </div>
    </section>
    <section class="px-8 py-4 lg:px-16 font-main">
        <div class="grid grid-cols-1 lg:gap-4 lg:grid-cols-10">
            <div class="col-span-7 px-8 py-6 my-4 border dark:border-zinc-700 rounded-lg shadow-sm">
                <h1 class="text-xl text-main font-medium border-b py-2 mb-4 dark:border-zinc-700">{{__("More information about the project")}}</h1>
                @if($project->getMedia('images') && count($project->getMedia('images')))
                    @foreach($project->getMedia('images') as $image)
                        <img alt="{{ $project->title }}" class="mx-auto w-full" src="{{ $image->getUrl() }}">
                    @endforeach
                @endif
                <x-tomato-markdown-viewer :content="$project->body" />
                <hr class="my-4">
                @if($project->service)
                    <x-tomato-admin-button :href="'/contact?service_id=' . $project->service?->id">
                        {{__("Request your service now")}}
                    </x-tomato-admin-button>
                @endif
            </div>
            <div class="col-span-3 flex flex-col gap-4 mt-4">
                <div class="px-8 py-2  border dark:border-zinc-700 rounded-lg shadow-sm">
                    <h1 class="text-xl text-main font-medium border-b dark:border-zinc-700 py-2">{{__("Client")}}</h1>
                    <p class="my-4 text-justify">{{ $project->company }}</p>
                </div>
                <div class="px-8 py-2 border dark:border-zinc-700 rounded-lg shadow-sm">
                    <h1 class="text-xl text-main font-medium border-b dark:border-zinc-700 py-2">{{__("Date")}}</h1>
                    <p class="my-4 text-justify">{{ $project->created_at->toDateString() }}</p>
                </div>
                <div class="px-8 py-2 border dark:border-zinc-700 rounded-lg shadow-sm">
                    <h1 class="text-xl text-main font-medium border-b dark:border-zinc-700 py-2">{{__("Project Type")}}</h1>
                    <div class="my-4">
                        <x-splade-link :href="url('projects?service=' . $project->service?->name )"
                                       class="text-justify ">{{ $project->service?->name }}</x-splade-link>
                    </div>
                </div>
                <div class="px-8 py-2  border dark:border-zinc-700 rounded-lg shadow-sm">
                    <h1 class="text-xl text-main font-medium border-b dark:border-zinc-700 py-2">{{__('Views')}}</h1>
                    <p class="my-4 text-justify">{{ $project->views }}</p>
                </div>
            </div>
        </div>

        @if(count($rel))
            <h1 class="my-4 text-3xl text-center text-main">{{__("Similar projects")}}</h1>

            <div class="grid grid-cols-1 gap-4 lg:gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($rel as $relProject)
                    @php
                        $image = "";
                        if($relProject->getMedia('feature') && count($relProject->getMedia('feature'))){
                            $image = $relProject->getMedia('feature')->first()->getUrl();
                        }
                        else {
                            $image = "https://ui-avatars.com/api/?name=".$relProject->title;
                        }
                    @endphp
                    <x-splade-link href="{{ url('/projects/' . $relProject->id) }}" class="block">
                        <article
                            class="relative overflow-hidden rounded-lg shadow transition hover:shadow-lg"
                        >
                            <img
                                alt="{{$relProject->title}}"
                                src="{{$image}}"
                                class="absolute inset-0 h-full w-full object-cover"
                            />

                            <div
                                class="relative bg-gradient-to-t from-gray-900/50 to-gray-900/25 pt-32 sm:pt-48 lg:pt-64"
                            >
                                <div class="p-4 sm:p-6">
                                    <div class="flex justify-between">
                                        <div>
                                            <time datetime="{{$relProject->created_at->toDateString()}}" class="block text-xs text-white/90">
                                                {{$relProject->created_at->diffForHumans()}}
                                            </time>

                                            <a href="#">
                                                <h3 class="mt-0.5 text-lg text-white ">
                                                    {{ \Str::limit($relProject->title, 30, $end='...') }}
                                                </h3>
                                            </a>
                                        </div>
                                        <div class="flex flex-col  justify-end text-white/9">
                                            <div class="flex justify-end text-white">
                                                <i class="bx bxs-show mx-2"></i>
                                                <span class="text-xs">{{$relProject->views}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </x-splade-link>
                @endforeach
            </div>
        @endif
    </section>
@endsection
