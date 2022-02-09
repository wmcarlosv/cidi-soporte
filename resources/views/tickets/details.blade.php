@extends('layouts.app')
@section('title', 'Tickets')
@section('content')
    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>Ticket Detail</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="page-content">
        <section id="category-one">
            <div class="category-one">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <!--ticket-detail-box-->
                            <div class="ticket_replies">
                                <div class="ticket-detail-box">
                                    <div class="outer-white" >
                                        <h4 class="ticket-number">Token#:
                                            <span class="count">{{$ticket->token_no}} | Date: {{$ticket->created_at->format('d-m-Y')}}</span>
                                        </h4>
                                        <h3 class="title">{{$ticket->subject}}</h3>
                                        <div class="date-time">
                                            <span class="name">Submitted By: {{$ticket->submittedBy->name}}</span></div>
                                        <p class="details">
                                            {{$ticket->description}}
                                        </p>
                                    </div>
                                </div>

                                @foreach($replies as $reply)
                                    <div class="ticket-detail-box ">
                                        <div class="outer-white">
                                            <h3 class="title">
                                                @if($reply->users->avatar ==  null)
                                                    <img src="{{asset('uploads')}}/avatar.png" alt="avatar" class="img-circle">
                                                @else
                                                    <img src="{{asset('uploads')}}/{{$reply->users->avatar}}" alt="avatar" class="img-circle">
                                                @endif
                                                {{$reply->users->name}} |
                                                <span class="text-muted date">Date: {{$reply->created_at->format('d-m-Y')}}</span>
                                                <span class="text-muted time">
                                                @ {{$reply->created_at->format('H:i')}}
                                                </span>
                                                @if($reply->user_id == Auth::id())

                                                    <a href="javascript:;"  class="basic-button delete-btn red pull-right" data-id="{{$reply->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </h3>


                                            <p class="details">
                                                {{$reply->reply}}
                                            </p>
                                            @foreach($files as $file)
                                                @if($file->reply_id == $reply->id)
                                                    <p class="file_link">
                                                        Attached File:
                                                        <a href="{{url('download')}}/{{$file->name}}">
                                                            <i class="fa fa-paperclip"></i> {{$file->name}}
                                                        </a>
                                                    </p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--ticket-detail-box-->
                            <hr>
                            <!--text editor-->
                            <div class="tc-editor">
                                <h3>Reply this ticket</h3>
                                {{Form::open(['id' => 'replies', 'files'=> true])}}
                                <input type="hidden" name="token" value="{{csrf_token()}}">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <textarea name="reply" class="form-control"></textarea>
                                <div class="text-right button-box">
                                    <div class="fileUpload btn btn-media">
                                        <i class="fa fa-upload"></i>
                                        <span>Add File</span>
                                        <input type="file" name="file" class="upload"/>
                                    </div>
                                    <button type="submit" class="btn btn-reply">reply</button>
                                </div>
                                {{Form::close()}}
                                <div class="alert alert-danger reply-body" style="display: none">
                                    <strong>Alert!</strong> Reply body can not be empty!
                                </div>
                            </div>
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
                                    @if(Auth::user()->hasRole('staff') || Auth::user()->hasRole('admin'))
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
                                    @endif

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
        </section>
    </div>


    <div class="modal fade" id="status-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                {{Form::open(['url'=>['update/status', $ticket->id], 'class'=>'defaultForm','method' =>'post'])}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Ticket Status</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Status:</label>
                        <select name="status" class="form-control">

                            <option value="open" {{($ticket->status) == 'open'? 'selected': ''}}>Open</option>
                            <option value="replied" {{($ticket->status) == 'replied'? 'selected': ''}}>Replied</option>
                            <option value="closed" {{($ticket->status) == 'closed'? 'selected': ''}}>Closed</option>
                            <option value="pending" {{($ticket->status) == 'closed'? 'pending': ''}}>Pending</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="basic-button red" data-dismiss="modal">Close</button>
                    <button type="submit" class="basic-button">Update</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="assign-ticket">
        <div class="modal-dialog">
            <div class="modal-content">
                {{Form::open(['url'=>['assign/ticket', $ticket->id], 'class'=>'defaultForm','method' =>'post'])}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Assign Ticket</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Staff List:</label>
                        <select name="assign" class="form-control" required>
                            <option value>Please Select</option>

                            @foreach($staff as $item)
                                <option value="{{$item->id}}" {{($ticket->assigned_to) == $item->id? 'selected': ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="basic-button red" data-dismiss="modal">Close</button>
                    <button type="submit" class="basic-button">Update</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>


@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('input.upload').on('change', function () {
                var path = $(this).val();
                var filename = path.replace(/^.*\\/, "");
                $('.fileUpload span').html(filename);
            });


            $("#replies").on('submit', function (e) {
                e.preventDefault();
                if($('#replies textarea').val() == ''){
                    $('.reply-body').hide().fadeIn(800).delay(3000).fadeOut(800);
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{url('/add-reply')}}',
                    data: new FormData($("#replies")[0]),
                    async:false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(".ticket_replies").append(data);
                        $('#replies')[0].reset();
                        $('.fileUpload span').html('Add File');
                        $('upload').val('');
                    },
                    error: function () {
                        alert('error');
                    }
                })
            });

            $(document).on('click',".delete-btn", function () {
                var id = $(this).attr('data-id');
                $(this).parent().closest('.outer-white').addClass('reply_to_delete');
                swal({
                            title: "Are you sure?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel!",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                $.ajax({
                                    type: 'POST',
                                    url: '{{url('/delete/replies')}}'+"/"+id,
                                    data:{
                                        id:id,
                                        '_token': '{{csrf_token()}}'
                                    },
                                    success: function (data) {
                                        $('.reply_to_delete').hide();
                                        swal("Deleted!", "Reply message has been deleted.", "success");

                                    }
                                })
                            } else {
                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                        });
            });
        });

    </script>



@stop

