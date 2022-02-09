@extends('layouts.tickets')
@section('title', 'Departments')
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
                                <h3 class="title clearfix">Department <span>List</span>
                                    <a href="javascript:;" data-toggle="modal" data-target="#add_new" class="pull-right add_new">Add new</a>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-lead dep-table">
                                        <thead>
                                        <tr>
                                            <th class="heading">id #</th>
                                            <th class="heading">Name</th>
                                            <th class="heading">Date</th>
                                            <th class="heading">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($departments as $department)
                                            <tr id="{{$department->id}}">
                                                <td>{{$department->id}}</td>
                                                <td>{{$department->name}}</td>
                                                <td>{{$department->created_at->toDateString()}}</td>
                                                <td>
                                                    <a href="javascript:;" data-id="{{$department->id}}" class="eye edit-rec">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="#" class="eye delete-btn" data-id="{{$department->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="pagination_links clearfix">
                                {{ $departments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <div class="modal fade" id="add_new" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{Form::open(['url'=>'admin/departments', 'class'=>'defaultForm','method' =>'post'])}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Department</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Department Name:</label>
                        <input type="text" class="form-control" name="name" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="basic-button red" data-dismiss="modal">Close</button>
                    <button type="submit" class="basic-button">Save changes</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_rec" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{Form::open(['url'=>['/admin/departments', 1], 'class'=>'defaultForm','method' =>'put'])}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Department</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group get_values">
                        <label class="control-label">Department Name:</label>
                        <input type="text" class="form-control" name="name" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="basic-button red" data-dismiss="modal">Close</button>
                    <button type="submit" class="basic-button">Save changes</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.edit-rec', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{url('/admin/departments')}}'+"/"+id+'/edit',
                    data:{
                        id:id,
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data) {
                        $('.get_values').html(data);
                        $('#edit_rec').modal('show');
                    }
                })
            });

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
                                url: '{{url('/admin/departments')}}'+"/"+id,
                                data:{
                                    id:id,
                                    '_token': '{{csrf_token()}}'
                                },
                                success: function (data) {
                                    $('.dep-table tr#'+id+'').hide();
                                    swal("Deleted!", "Your record has been deleted.", "success");

                                }
                            })
                        } else {
                            swal("Cancelled", "record is safe :)", "error");
                        }
                    });
            });
        });
    </script>

@stop

