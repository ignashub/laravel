@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"><h1>Admin</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/export" class="btn btn-primary float-right m-3">Export</a>
                    <h3> All registered users</h3>
                    @if(count($users)> 0)
                    <table class="table">
                        <tr>
                            <th>Username</th>
                            <th>ID</th>
                            <th></th>
                        </tr>
                        {{-- Looping through posts for that specific user --}}
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->id}}</td>
                                <td>
                                        {!!Form::open(['action' => ['Useredit@destroy', $user], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete user', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                                </td>
                            </tr>
                            @foreach($posts as $post)
                                @if($post->user_id == $user->id)
                                <tr class="table-secondary">
                                    <div id="collapseOne" class="collapse in p-3">
                                    <td>
                                            {{$post->title}}
                                    </td>
                                    <td>
                                        <a href="/posts/{{$post->id}}/edit" class= "btn btn-success"> Edit</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}

                                    </td>
                                    </div>
                                </tr>
                                @endif
                                @endforeach
                        @endforeach
                    </table>
                    @else
                        <p> There are no registered users </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
