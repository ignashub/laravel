@extends('app')
@section('title', 'Recipes')
@section('content')
    <h1>Recipes</h1>
    <ul>
   @forelse($recipes as $recipe)
       <li>{{ $recipe }}</li>
       @empty
       <p>There are no recipes at the moment</p>
        @endforelse
    </ul>
@endsection
