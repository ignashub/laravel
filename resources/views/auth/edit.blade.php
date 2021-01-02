@extends('layouts.app')

@section('content')
    @if(Auth::user()->id == $user->id)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center font-weight-bold"><h1>Account Settings</h1></div>

                    <!-- <img src="{{asset(Auth::user()->avatar)}}" alt=""> -->

                    <div class="row justify-content-center">

                        <div class="profile-header-container">
                            <div class="profile-header-img">
                                <img class="rounded-circle" src="/images/{{$user->avatar}}" alt="" style="width: 250px; height:250px;"

                                onmouseover="src='/images/pixelated_avatars/{{ $user->avatar }}';"
                                onmouseout="src='/images/{{ $user->avatar }}';">
                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <form action="/profile/{user}/updatePic" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="card-body">
                       <form method="POST" action="{{ route('users.update', $user) }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                            {!! Form::open(['action' => ['Useredit@update', $user], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                {{-- {{Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-right'])}} --}}

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="{{$user->name}}" autofocus>
                                    {{-- {{Form::text('name', $user->name, ['class' => 'form-control @error("name") is-invalid @enderror', 'placeholder' => 'Name'])}} --}}
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                {{-- {{Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label text-md-right'])}} --}}
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{$user->email}}">
                                    {{-- {{Form::text('email', $user->email, ['class' => 'form-control @error("email") is-invalid @enderror', 'placeholder' => 'Email'])}} --}}
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Old Password</label>
                                {{-- {{Form::label('password', 'Password', ['class' => 'col-md-4 col-form-label text-md-right'])}} --}}
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    {{-- {{Form::text('password', $user->password, ['class' => 'form-control @error("password") is-invalid @enderror', 'placeholder' => 'Password'])}} --}}
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                {{-- {{Form::label('new-password', 'New-Password', ['class' => 'col-md-4 col-form-label text-md-right'])}} --}}
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control @error('password') is-invalid @enderror" name="new-password" autocomplete="new-password">
                                    {{-- {{Form::text('new-password', $user->password, ['class' => 'form-control @error("password") is-invalid @enderror', 'placeholder' => 'New-Password'])}} --}}
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                        {!!Form::close()!!}
                                    </button>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    {!! Form::open(['action' => ['Useredit@destroy', $user], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete Account', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
