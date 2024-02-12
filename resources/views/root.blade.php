<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{setting('site_description')}}">
        <meta name="author" content="{{setting('site_author')}}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{url()->current()}}" />
        <title>{{setting('site_name')}}</title>

        <meta property="fb:app_id" content="2314752672172558" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{setting('site_name')}}" />
        <meta property="og:description" content="{{setting('site_description')}}" />
        <meta property="og:image" content="{{setting('site_profile')}}" />
        <meta property="og:image:alt" content="{{setting('site_name')}}" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:site_name" content="{{setting('site_name')}}" />

        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{setting('site_name')}}">
        <meta name="twitter:description" content="{{setting('site_description')}}">
        <meta name="twitter:image" content="{{setting('site_profile')}}">
        <meta name="twitter:site" content="@phptomato">
        <meta name="twitter:creator" content="@endfadymondy">

        <link rel="icon" href="{{asset('/favicon.ico')}}">
        @spladeHead
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased">
        @splade
    </body>
</html>
