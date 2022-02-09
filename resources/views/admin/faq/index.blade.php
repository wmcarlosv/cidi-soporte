@extends('layouts.tickets')
@section('title', 'FAQ List')
@section('content')
    <div class="page-content">
        <div class="category-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="table-section">
                            <h3 class="title clearfix">All <span>Questions</span>
                                <a href="{{url('admin/faq/create')}}" class="pull-right">Add new</a>
                            </h3>
                            <div class="table-responsive">
                                <table class="table table-lead faq-table">
                                    <thead>
                                    <tr>
                                        <th class="heading">id #</th>
                                        <th class="heading">Title</th>
                                        <th class="heading">Department</th>
                                        <th class="heading">Date</th>
                                        <th class="heading">action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($faqs as $faq)
                                        <tr id="{{$faq->id}}">
                                            <td>{{$faq->id}}</td>
                                            <td>
                                                <a href="{{url('/admin/faq/')}}/{{$faq->id}}/edit">{{$faq->subject}}</a>
                                            </td>
                                            <td>{{$faq['departments']['name']}}</td>
                                            <td>{{$faq->created_at->toDateString()}}</td>
                                            <td>
                                                <a href="{{url('/admin/faq/')}}/{{$faq->id}}/edit" class="eye">
                                                    <i class="fa fa-pencil"></i></a>
                                                <a href="#" class="eye delete-btn" data-id="{{$faq->id}}"><i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination_links clearfix">
                            {{ $faqs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    url: '{{url('/admin/faq')}}'+"/"+id,
                                    data:{
                                        id:id,
                                        '_token': '{{csrf_token()}}'
                                    },
                                    success: function (data) {
                                        $('.faq-table tr#'+id+'').hide();
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

