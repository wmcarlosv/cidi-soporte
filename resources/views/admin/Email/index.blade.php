@extends('layouts.app')
@section('title', 'Complaint Detail')
@section('content')
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-9">
                            {{Form::open(['url'=>'/email/add', 'class'=>'defaultForm','method' =>'post',  'files' => true])}}
                            <div class="small-border"></div>

                            <h1>Email</h1>

                            <hr>

                            <div class="form-group">
                                <label class="control-label">Name*:</label>
                                <input type="text" class="form-control" name="name"  value="{{$name}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Logo:</label>

                                <div class="custom-file-upload">
                                    <input type="file" id="file" name="file"  required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Key Word*:</label>
                                <input type="text" class="form-control" name="keyword" value="{{$keyword}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description"  required>{{$description}}
                                </textarea>
                                <span class="help-block" id="message"></span>
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="btn btn-default">SUBMIT</button>
                            </div>

                            {{Form::close()}}

                        </div>
                        <div class="col-md-3 ">
                            <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div class="all-category">
                                        <h1>All Categories</h1>
                                    </div>
                                    <div class="catege-one">
                                        <ul>
                                            <li><a href="#">Trading For Money<span class="number-box">47</span></a></li>
                                            <li><a href="#">Vault Keys Giveaway<span class="number-box">47</span></a></li>
                                            <li><a href="#">Misc Guns Location<span class="number-box">47</span></a></li>
                                            <li><a href="#">Looking For Players<span class="number-box">45</span></a></li>
                                            <li><a href="#">Stupid Bugs &amp; Solves<span class="number-box">45</span></a></li>
                                            <li><a href="#">Video and Audio Drivers<span class="number-box">45</span></a></li>
                                            <li><a href="#">2K Official Forums<span class="number-box">45</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div class="forum-statistics">
                                        <h1>Forum Statistics</h1>
                                    </div>
                                    <div class="row margin-off">
                                        <div class="forum-box">
                                            <div class="col-md-4 col-padding-off col-sm-4 col-xs-4">
                                                <div class="forum-sms">
                                                    <img src="{{asset('images/speech-bubble-2.png')}}" alt="Nothing">
                                                    <p>Threads</p>
                                                    <h1>35,206</h1>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-padding-off col-sm-4 col-xs-4">
                                                <div class="forum-details">
                                                    <img src="{{asset('images/posts.png')}}" alt="Nothing">
                                                    <p>Posts</p>
                                                    <h1>12,958</h1>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-padding-off col-sm-4 col-xs-4">
                                                <div class="forum-details">
                                                    <img src="{{asset('images/members.png')}}" alt="Nothing">
                                                    <p>Members</p>
                                                    <h1>24,703</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div class="catege-three">
                                        <h1>Howdy, Stranger</h1>
                                        <p>If You wnat to login you can use:<br>
                                            <br>
                                            Username: user<br>
                                            Password: pass
                                        </p>
                                        <a href="register.html"><button type="button" class="btn btn-default">Register</button></a>
                                        <a href="login.html"><button type="button" class="btn btn-default">Login</button></a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
