@extends('layouts.app')
@section('title', 'Edit Ticket')
@section('content')
    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>Edit Ticket</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-9">
                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif


                            {{Form::open(['url'=>['/update/tickets',$ticket->id], 'class'=>'defaultForm','method' =>'post',  'files' => true])}}
                            <div class="small-border"></div>
                            <small>Edit Ticket</small>
                            <hr>

                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong> {{Session::get('message')}}
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="control-label">Title*:</label>
                                <input type="text" class="form-control" name="subject" value="{{$ticket->subject}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Department*:</label>
                                <select name="department" required class="form-control">
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{($department->id) == $ticket->department_id ? 'selected' : ''}}>{{$department->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description"  required>{{$ticket->description}}</textarea>
                                <span class="help-block" id="message"></span>
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>

                            {{Form::close()}}

                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="ticket-info">
                                <div class="title-sidebar">
                                    <h1>Ticket information</h1>
                                </div>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="tno">#Token Number:</td>
                                        <td><span class="label-green">{{$ticket->token_no}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="tno">Submitted By:</td>
                                        <td><span>{{$ticket->submittedBy->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td class="tno">{{$ticket->departments->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>ticket status</td>
                                        <td><span class="ticket-status {{$ticket->status}}">{{$ticket->status}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Assigned ticket</td>
                                        @if($ticket->assigned_to  == null)
                                            <td class="tno">not assigned</td>
                                        @else
                                            <td class="tno">{{$ticket->users->name}}</td>
                                        @endif
                                    </tr>
                                    @role('admin')
                                    <tr>
                                        <td class="no-border">
                                            <span class="new-tk ticker">
                                                <a href="javascript:;" data-toggle="modal" data-target="#assign-ticket">
                                                    assign ticket
                                                </a>

                                            </span>
                                        </td>
                                        <td class="no-border">
                                            <span class="update-tk ticker">
                                                <a href="javascript:;" data-toggle="modal" data-target="#status-modal"> update status</a>
                                            </span>
                                        </td>
                                    </tr>
                                    @endrole

                                    </tbody>
                                </table>
                            </div>
                            <!--ticket-files-->
                            <div class="ticket-files">
                                <div class="title-sidebar">
                                    <h1>Files</h1>
                                </div>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>name</td>
                                        <td>uploaded by</td>
                                    </tr>

                                    @foreach($files as $file)
                                        <tr>
                                            <td>
                                                <a href="{{url('download')}}/{{$file->name}}" class="file-up">{{$file->name}}</a>
                                            </td>
                                            <td>{{$file->users->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


