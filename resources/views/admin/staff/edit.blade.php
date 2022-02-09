@extends('layouts.tickets')
@section('title', 'Edit Staff')
@section('content')
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            {{Form::open(['url'=>['/admin/staff',$user->id], 'class'=>'defaultForm','method' =>'PUT',  'files' => true])}}
                            <div class="small-border"></div>
                            <small>Edit Staff</small>
                            <h1>
                                @if($user->avatar ==  null)
                                    <img src="{{asset('uploads')}}/avatar.png" alt="avatar" class="img-circle" style="height: 40px; width:40px">
                                    @else
                                    <img src="{{asset('uploads')}}/{{$user->avatar}}" alt="avatar" class="img-circle" style="height: 40px; width:40px">
                                @endif
                                {{$user->name}}</h1>
                            <hr>

                            <div class="form-group">
                                <label class="control-label">Name*:</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">User Name*:</label>
                                <input type="text" class="form-control" readonly name="username" value="{{$user->username}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Email*:</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Avatar:</label>

                                <div class="custom-file-upload">
                                    <input type="file" id="file" name="file" value="{{$user->avatar}}"/>
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="control-label">Department:</label>
                                    <select name="department" class="form-control">
                                        <option value selected>Please select</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{($user->department_id) == $department->id ? 'selected' : ''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Designation*:</label>
                                    <input type="text" class="form-control" name="designation" value="{{$user->designation}}" required/>
                                </div>


                                <div class="form-group">
                                <label class="control-label">Role*:</label>
                                <select name="role" class="form-control">
                                    <option value="admin" @if($user->hasRole('admin'))selected @endif>Admin</option>
                                    <option value="staff" @if($user->hasRole('staff'))selected @endif>Staff</option>
                                    <option value="client"  @if($user->hasRole('client'))selected @endif>Client</option>
                                </select>
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>

                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.file-upload-input').attr('value', '{{$user->avatar}}');
        });
    </script>



    @stop
