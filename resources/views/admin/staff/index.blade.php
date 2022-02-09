@extends('layouts.tickets')
@section('title', 'Staff List')
@section('content')
    <div class="page-content">
        <section id="category-one">
            <div class="category-one">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Alert!</strong> {{ Session::get('message') }}
                                </div>
                            @endif

                            <div class="table-section">
                                <div class="table-responsive">
                                    <table class="table table-lead user-table">
                                        <h3 class="title clearfix">Staff <span>List</span>
                                            <a href="{{url('admin/staff/create')}}" class="pull-right">Add new</a>

                                        </h3>
                                        <thead>
                                        <tr>
                                            <th class="heading">Name</th>
                                            <th class="heading">Email</th>
                                            <th class="heading">Avatar</th>
                                            <th class="heading">Department</th>
                                            <th class="heading">Registered On</th>
                                            <th class="heading">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($users as $user)
                                            @if($user->hasRole('staff'))
                                                <tr id="{{$user->id}}">
                                                    <td>
                                                        <a href="{{url('admin/staff')}}/{{$user->id}}/edit">
                                                            {{$user->name}}
                                                        </a>
                                                    </td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @if($user->avatar ==  null)
                                                            <img src="{{asset('uploads')}}/avatar.png" alt="avatar" class="img-circle" style="height: 40px; width:40px">
                                                        @else
                                                            <img src="{{asset('uploads')}}/{{$user->avatar}}" alt="avatar" class="img-circle" style="height: 40px; width:40px">

                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($user->department_id ==  null)
                                                            No Department
                                                            @else
                                                            {{$user->departments->name}}


                                                        @endif
                                                    </td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td>
                                                        <a href="{{url('admin/staff')}}/{{$user->id}}/edit" class="eye">
                                                            <i class="fa fa-pencil"></i></a>
                                                        <a href="#" class="eye delete-btn" data-id="{{$user->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="pagination_links clearfix">
                                {{ $users->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-btn', function () {
                var id = $(this).attr('data-id');
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
                                type: 'DELETE',
                                url: '{{url('/admin/staff')}}'+"/"+id,
                                data:{
                                    id:id,
                                    '_token': '{{csrf_token()}}'
                                },
                                success: function (data) {
                                    $('.user-table tr#'+id+'').hide();
                                    swal("Deleted!", "Staff has been deleted.", "success");

                                }
                            })
                        } else {
                            swal("Cancelled", "Staff is safe :)", "error");
                        }
                    });
            });
        });
    </script>

@stop
