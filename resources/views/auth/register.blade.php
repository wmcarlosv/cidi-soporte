@extends('layouts.app')
@section('title', 'Register')
@section('content')

    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>User Registration</h1>
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
                                <img src="{{asset('uploads')}}/{{$settings->logo}}"  alt="logo">
                                <p>
                                    {{$settings->footer_description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-text">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {!! csrf_field() !!}
                            <h1>Create Your Account</h1>

                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                                <div class="form-group">
                                    <div class="icon"  >
                                        <span class="fa fa-user"></span>
                                    </div>
                                    <input type="text" placeholder="name" name="name" value="{{old('name')}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-user" aria-hidden="true"></span>
                                    </div>
                                    <input type="text" placeholder="username" name="username" value="{{old('username')}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-envelope-o" aria-hidden="true"></span>
                                    </div>
                                    <input type="email" placeholder="Email" name="email"  value="{{old('email')}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-lock" aria-hidden="true"></span>
                                    </div>

                                    <input type="password" placeholder="Password" name="password"  value="{{old('password')}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <div class="icon">
                                        <span class="fa fa-unlock-alt" aria-hidden="true"></span>
                                    </div>
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation"  value="{{old('confirm')}}" class="form-control" required>
                                    <span style="color:red">{{$errors->first('confirm')}}</span>

                                </div>
                                <button type="submit" class="btn btn-default login-button">SIGN UP</button>
                                <ul>
                                    <li>
                                        <a href="{{asset('/password/reset')}}">Forget Your Password . ?</a>
                                    </li>
                                    <li>
                                        <a href="{{url('contact')}}">Need Support .</a>
                                    </li>
                                    <li>
                                        <a href="{{asset('/login')}}">Login.</a>
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
            $('.navbar-default .navbar-nav li.register').addClass('active');
        });

    </script>
@endsection
