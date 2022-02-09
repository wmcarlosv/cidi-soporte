@extends('layouts.app')
@section('title', 'Login')
@section('content')

    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>User Login</h1>
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
                            <div>
                                <img src="{{asset('uploads')}}/{{$settings['logo']}}"  alt="logo">
                                <p>
                                    {{$settings['footer_description']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-text">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            {!! csrf_field() !!}
                            <h1>LOGIN TO YOUR ACCOUNT</h1>

                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-user" aria-hidden="true"></span>
                                    </div>
                                    <input id="username" type="text" class="form-control" placeholder="username or email" name="username" value="{{ old('username') }}" autofocus>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-lock" aria-hidden="true"></span>
                                    </div>
                                    <input type="password" placeholder="Password" name="password" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default login-button">LOGIN NOW</button>
                            <ul>
                                <li>
                                    <a href="{{asset('/password/reset')}}">Forget Your Password . ?</a>
                                </li>
                                <li>
                                    <a href="{{url('contact')}}">Need Support .</a>
                                </li>
                                <li>
                                    <a href="{{asset('/register')}}">Sign up .</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.navbar-default .navbar-nav li').removeClass('active');
            $('.navbar-default .navbar-nav li.login').addClass('active');
        });

    </script>
@endsection
