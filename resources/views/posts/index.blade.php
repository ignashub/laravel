@extends('layouts.app')

@section('content')

        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                                <img style="width:250px; height:250px" src="/storage/recipe_images/{{$post->recipe_image}}" onmouseover="src='/storage/recipe_images/pixelated/{{$post->recipe_image}}';"
                                     onmouseout="src='/storage/recipe_images/{{$post->recipe_image}}';">
                        </div>

                        <div class="col-md-4 col-sm-4">
                                <h1>{{$post->title}}</h1>
                                <h4>Recipe by {{$post->user['name']}}</h4>
                                <p><small>Written on {{$post->created_at}} </small></p>
                                <a href="posts/{{$post->id}}" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>

            @endforeach
            {{$posts->links()}}
        @else
            <p> No posts found</p>
        @endif

@endsection
