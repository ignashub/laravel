<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- TinyMCE Editor -->
    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FoodBlog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
</head>
<body>
<div>
    <div>
<h1>{{$post->title}}</h1>
</div>
    <br><br>
    <img style="width:250px; height:250px" src="./storage/recipe_images/{{$post->recipe_image}}">
<br><br>
<div>
    <p>
    {!!$post->body!!}
    </p>
</div>
<br><br>
<small>Written on {{$post->created_at}} by {{$post->user['name']}} </small>
</div>
</body>
