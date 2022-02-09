@extends('layouts.tickets')
@section('title', 'Edit FAQ')
@section('content')
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">

                            {{Form::open(['url'=>['/admin/faq', $faq->id], 'class'=>'defaultForm','method' =>'PUT'])}}
                            <div class="small-border"></div>
                            <small>Edit</small>
                            <h1>QUESTION</h1>
                            <hr>
                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong> {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Department:</label>
                                <select name="department" class="form-control" required>
                                    @foreach($departments as $department)
                                        @if($faq->department_id == $department->id)
                                            <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Subject*:</label>
                                <input type="text" class="form-control" name="subject" value="{{$faq->subject}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description" required>{{$faq->description}}</textarea>
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="btn btn-default">UPDATE</button>
                            </div>

                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

