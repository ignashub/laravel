@extends('layouts.app')

@section('content') 
    
        @if(count($posts) > 0)
            @foreach($posts as $post)
                {{-- <div class="well">
                    <h3><a href="posts/{{$post->id}}">{{$post->title}}</h3>
                    <small>Written on {{$post->created_at}}</small>
                </div> --}}
                <section class="wrapper style1">
                        <div class="inner">
                <div class="flex flex-3">
                    <div class="col align-center">
                        <h1>{{$post->title}}</h1>
                        <div class="image round fit">
                            <img src="images/pic03.jpg" alt="" />
                        </div>
                        <p>Sed congue elit malesuada nibh, a varius odio vehicula aliquet. Aliquam consequat, nunc quis sollicitudin aliquet. </p>
                        <p><small>Written on {{$post->created_at}}</small></p>
                        <a href="posts/{{$post->id}}" class="button">Learn More</a>
                    </div>
                </div>
            </section>
            @endforeach
            {{$posts->links()}}
        @else
            <p> No posts found</p>
        @endif

@endsection