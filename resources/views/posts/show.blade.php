@extends('layouts.app')
@section('content')
        <h1>{{$post->title}}</h1>
        <img style="width:250px; height:250px" src="/storage/recipe_images/{{$post->recipe_image}}" onmouseover="src='/storage/recipe_images/pixelated/{{$post->recipe_image}}';"
             onmouseout="src='/storage/recipe_images/{{$post->recipe_image}}';">
        <br><br>
        <div>
                {!!$post->body!!}
        </div>
        <hr>
        @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
        <div>
        <a href="/posts/{{$post->id}}/edit" class = "btn btn-success">Edit</a>
        <small>Written on {{$post->created_at}} by {{$post->user['name']}} </small>
        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        </div>
        @endif
        @endif
        <br>
        <a href="{{ route('pdf', $post->id)}}" class="btn btn-dark"> Download PDF</a>
        <a href="/posts" class="btn btn-dark"> Go Back</a>
@endsection
