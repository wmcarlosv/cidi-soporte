@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>Reset Password</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="login">
        <div class="login">
            <div class="container">
                <div class="col-md-6">
                    <div class="login-area">
                        <div class="login-back"></div>
                        <div class="login-front">
                            <img src="{{asset('images/ravitlash-logo.png')}}"  alt="nothing">
                            <p>Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-text">
                        <form  method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <h1>Reset Password</h1>

                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong>  {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-envelope-o"></span>
                                    </div>
                                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                    <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                    <input placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default login-button">Reset Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
