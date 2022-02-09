@extends('layouts.tickets')
@section('title', 'FAQ')
@section('content')
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">

                            {{Form::open(['url'=>'/admin/faq', 'class'=>'defaultForm','method' =>'post'])}}
                            <div class="small-border"></div>
                            <small>Add New</small>
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
                            <div class="form-group">
                                <label class="control-label">Department:</label>
                                <select name="department" class="form-control" required>
                                    <option value>Please select</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Subject*:</label>
                                <input type="text" class="form-control" name="subject" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description" required></textarea>
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

