@extends('layouts.app')
@section('title', 'New Ticket')
@section('content')

    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>Add New Ticket</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            {{Form::open(['url'=>'/tickets', 'class'=>'defaultForm','method' =>'post',  'files' => true])}}
                            <div class="small-border"></div>
                            <small>SUBMIT YOUR</small>
                            <h1>TICKET</h1>

                            <hr>

                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            @if(Auth::user()->roles[0]->display_name == 'Client')
                                <input type="hidden" name="department_id" value="{{ Auth::user()->department_id }}">
                            @else
                                <div class="form-group">
                                    <label class="control-label">Department:</label>
                                    <select name="department_id" class="form-control">
                                        @foreach($departments as $department)
                                            <option @if(Auth::user()->department_id == $department->id) selected='selected' @endif value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label">Attach File:</label>

                                <div class="custom-file-upload">
                                    <input type="file" id="file" name="file" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Subject*:</label>
                                <input type="text" class="form-control" name="subject" value="{{ old('subject')}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description" required>{{ old('description')}}</textarea>
                                <span class="help-block" id="message"></span>
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="btn btn-default">SUBMIT</button>
                            </div>

                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
