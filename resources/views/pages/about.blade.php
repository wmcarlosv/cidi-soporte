@extends('layouts.app')
@section('title', 'About')

@section('content')
    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>About Page</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-page">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-img">
                            <img src="{{asset('images/aboutus1.jpg')}}" class="img-responsive" alt="about us"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="about-text">
                            <p>
                                Quisque pellentesque ex eu tellus facilisis, id consequat magna iaculis. Sed condimentum, purus scelerisque pellentesque laoreet, ante elit fringilla erat, a viverra erat dui fermentum urna. Duis orci tortor, mattis eu ipsum id, facilisis finibus mauris. Aliquam tempus gravida diam, at accumsan risus blandit quis. Integer non mauris fringilla.
                                <br>

                                Aenean dictum in sapien eget fermentum. Fusce imperdiet dolor in est sodales, sed lacinia massa laoreet. Quisque rutrum ac lacus a viverra. Cras molestie sem a nunc vehicula vehicula. Nullam fringilla risus vestibulum sem convallis accumsan. Suspendisse ut velit ligula. Integer rutrum nisl eros. Sed tincidunt tincidunt neque, in hendrerit magna egestas a. Aliquam interdum, orci ultrices tristique tempus, tellus nisi fringilla tortor, eu ornare turpis felis vitae mi
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="about-text">
                            <p>
                                Aenean pharetra fringilla quam, tincidunt pellentesque lacus congue imperdiet. Curabitur viverra, metus in pellentesque tempor, nunc tortor consectetur purus, quis elementum dui ipsum ut sem. Nam venenatis, nulla at malesuada sodales, tortor dui fringilla ex, sit amet dapibus orci nisi non mauris. Nullam dapibus augue quis diam porta vehicula. Ut dictum lacus urna, nec mollis diam pellentesque at. Ut suscipit, diam id sollicitudin ornare, tortor libero condimentum diam, vel posuere ante risus a ligula. Sed purus urna, consectetur ac elementum vel, varius sed erat. Donec volutpat sapien non ante tincidunt, a tempus lectus euismod.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="about-img">
                            <img src="{{asset('images/aboutimg2.jpg')}}" class="img-responsive" alt="about us"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-text">
                <h2>Our Mission</h2>
                <p>
                    Nam at faucibus enim. Vestibulum vestibulum, urna sed semper convallis, nunc augue fringilla ipsum, vel varius justo nibh ac sem. Aliquam erat volutpat. Quisque sed posuere est. Nunc scelerisque commodo nunc, non vehicula libero iaculis vitae. Ut in turpis varius, iaculis odio ac, porta libero. Vestibulum sed odio dolor. Donec in leo venenatis, pulvinar magna ac, finibus ipsum. Proin vehicula semper mauris, vitae dictum ante interdum ac. Nam nunc mi, ultricies a leo eu, laoreet varius enim. Nullam lectus urna, pretium in mi sit amet, consequat laoreet augue. Phasellus ullamcorper venenatis lacus, molestie feugiat felis tempor vitae. Suspendisse ac tellus quam. Proin semper non ante quis faucibus. Quisque dapibus nisi in placerat pharetra. Donec fermentum enim at magna hendrerit, id luctus tortor tristique.
                </p>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            $('.navbar-default .navbar-nav li').removeClass('active');
            $('.navbar-default .navbar-nav li.about').addClass('active');
        });
    </script>
@stop