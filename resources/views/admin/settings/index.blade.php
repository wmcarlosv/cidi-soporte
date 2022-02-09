@extends('layouts.tickets')
@section('title', 'Settings')
@section('content')
    <section id="category-one">
        <div class="category-one">
            <div class="container contact">
                <div class="submit-area">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            {{Form::open(['url'=>'admin/settings/', 'class'=>'defaultForm','method' =>'post',  'files' => true])}}
                            <input type="hidden" name="id" value="{{$settings->id}}">
                            <div class="small-border"></div>
                            <h1>General Settings</h1>
                            <hr>

                            @if(count($errors->all()))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Alert!</strong> {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong> {{ Session::get('error') }}
                                </div>
                            @endif

                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong> {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label">Name*:</label>
                                <input type="text" class="form-control" name="name" value="{{$settings->name}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Logo*:</label>
                                <div class="custom-file-upload logo">
                                    <input type="file" id="file" name="logo" value="{{$settings->logo}}" accept="image/x-png,image/gif,image/jpeg"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Email*:</label>
                                    <input type="email"  name="admin_email" class="form-control" value="{{$settings->admin_email}}"/>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Keywords:</label>
                                <input type="text" class="form-control" name="keywords" value="{{$settings->keyword}}"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <textarea class="form-control" name="description">{{$settings->description}}</textarea>
                            </div>

                            <br>

                            <div class="small-border"></div>
                            <h1>Footer Setting</h1>

                            <div class="form-group">
                                <label class="control-label">Footer Logo*:</label>
                                <div class="custom-file-upload footer_logo">
                                    <input type="file" id="file" name="footer_logo" value="{{$settings->footer_logo}}" accept="image/x-png,image/gif,image/jpeg"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Footer Description*:</label>
                                <textarea class="form-control" name="footer_description">{{$settings->footer_description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Copyrights*:</label>
                                <input type="text" class="form-control" name="copyrights" value="{{$settings->copyrights}}"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Facebook:</label>
                                <input type="text" class="form-control" name="facebook" value="{{$settings->facebook}}"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Twitter:</label>
                                <input type="text" class="form-control" name="twitter" value="{{$settings->twitter}}"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Linkedin:</label>
                                <input type="text" class="form-control" name="linkedin" value="{{$settings->linkedin}}"/>
                            </div>

                            <br>

                            <div class="small-border"></div>
                            <h1>Ticket Setting</h1>

                            <div class="form-group">
                                <label class="control-label">Send Email on New Ticket*:</label>
                                <select name="ticket_email" class="form-control">
                                    <option value="yes" {{($settings->ticket_email) == 'yes' ? 'selected' : ''}}>Yes</option>
                                    <option value="no" {{($settings->ticket_email) == 'no' ? 'selected' : ''}}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Client Can Edit Tickets*:</label>
                                <select name="client_can_edit" class="form-control">
                                    <option value="yes" {{($settings->client_can_edit) == 'yes' ? 'selected' : ''}}>Yes</option>
                                    <option value="no" {{($settings->client_can_edit) == 'no' ? 'selected' : ''}}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Staff Can Edit Tickets*:</label>
                                <select name="staff_can_edit" class="form-control">
                                    <option value="yes" {{($settings->staff_can_edit) == 'yes' ? 'selected' : ''}}>Yes</option>
                                    <option value="no" {{($settings->staff_can_edit) == 'no' ? 'selected' : ''}}>No</option>
                                </select>
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
@section('script')
    <script>
        $(document).ready(function () {
            $('.custom-file-upload.logo .file-upload-input').attr('value', '{{$settings->logo}}');
            $('.custom-file-upload.footer_logo .file-upload-input').attr('value', '{{$settings->footer_logo}}');
        });
    </script>
@stop

