@extends('layouts.app')

@section('title', 'Tickets')

@section('content')

    <section id="main-home">
        <div class="main-home">
            <div class="main-img-area app">
                <div class="container">
                    <h1>Tickets List</h1>
                    @role('staff')
                    <p>Table contains all the tickets that assigned to you or the tickets that submitted by you</p>
                    @endrole
                    @role('client')
                    <p>Table contains all the tickets that you submitted</p>
                    @endrole
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
                            <div class="table-section">
                                <h3 class="title clearfix">Tickets <span>List</span></h3>
                                <div class="table-responsive">
                                    <table class="table table-lead ticket-table">
                                        <thead>
                                        <tr>
                                            <th class="heading">Token #</th>
                                            <th class="heading">Title</th>
                                            <th class="heading">Department</th>
                                            @role('staff')
                                            <th class="heading">Submitted By</th>
                                            @endrole
                                            <th class="heading">Status</th>
                                            <th class="heading">Date</th>
                                            <th class="heading">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tickets as $ticket)
                                            @if($ticket->user_id == Auth::id() || $ticket->assigned_to == Auth::id())
                                                <tr id="{{$ticket->id}}">
                                                    <td>{{$ticket->token_no}}</td>
                                                    <td>
                                                        <a href="{{url('ticket')}}/{{$ticket->id}}/{{str_replace(' ', '-',   strtolower($ticket->subject) )}}">{{$ticket->subject}}</a></td>
                                                    <td>{{$ticket->departments->name}}</td>
                                                    @role('staff')
                                                    @if($ticket->user_id == Auth::id())
                                                        <td>me</td>
                                                    @else
                                                        <td>{{$ticket->submittedBy->name}}</td>
                                                    @endif
                                                    @endrole

                                                    <td>
                                                    <span class="ticket-status {{$ticket->status}}">
                                                        {{$ticket->status}}
                                                    </span>
                                                    </td>

                                                    <td>{{$ticket->created_at->format('d-m-Y')}}</td>
                                                    <td>
                                                        @if(Auth::user()->hasRole('client'))
                                                            @if($settings->client_can_edit == 'yes')
                                                                <a href="{{url('edit/tickets')}}/{{$ticket->id}}" class="eye" data-id="{{$ticket->id}}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            @endif
                                                        @endif
                                                        @if(Auth::user()->hasRole('staff'))
                                                            @if($settings->staff_can_edit == 'yes')
                                                                <a href="{{url('edit/tickets')}}/{{$ticket->id}}" class="eye" data-id="{{$ticket->id}}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            @endif
                                                        @endif


                                                        <a href="javascript:;" class="eye delete-btn" data-id="{{$ticket->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                {{ $tickets->links() }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="second-heading-area">
                                <div class="search_box clearfix">
                                    <form action="{{url('find/ticket')}}" method="get">
                                        @if(!empty($search_term))
                                            <input type="text" name="q" class="form-control" placeholder="Search Ticket" required value="{{$search_term}}">
                                        @else
                                            <input type="text" name="q" class="form-control" placeholder="Search Ticket" required>
                                        @endif
                                        <button type="submit" class="basic-button">Submit</button>
                                    </form>
                                </div>
                                <div class="ticket-info">
                                    <div class="title-sidebar">
                                        <h1>Search By Status</h1>
                                    </div>
                                    <div class="catege-one">
                                        <ul>
                                            <li>
                                                <a href="{{url('find/status/open')}}" class="open">
                                                    Open Tickets
                                                    <span class="number-box">{{$open}}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{url('find/status/closed')}}" class="closed">
                                                    Closed Tickets
                                                    <span class="number-box"> {{$closed}}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{url('find/status/pending')}}" class="pending">
                                                    Pending Tickets
                                                    <span class="number-box">{{$pending}}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{url('find/status/replied')}}" class="replied">
                                                    Replied Tickets
                                                    <span class="number-box">{{$replied}}</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{url('tickets')}}">
                                                    View All
                                                    <span class="number-box">{{count($tickets_depart)}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ticket-info">
                                    <div class="title-sidebar">
                                        <h1>Departments</h1>
                                        <div class="catege-one">
                                            <ul>
                                                @foreach($departments as $department)
                                                    <?php $count = 0?>
                                                    @foreach($tickets_depart as $item)
                                                        @if($item->department_id == $department->id)
                                                            <?php $count++?>
                                                        @endif
                                                    @endforeach
                                                    <li>
                                                        <a href="{{url('find/department')}}/{{$department->id}}">
                                                            {{$department->name}}
                                                            <span class="number-box">{{$count}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
            $('.navbar-default .navbar-nav li').removeClass('active');
            $('.navbar-default .navbar-nav li.ticket').addClass('active');
            $(".delete-btn").on('click', function () {
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
                                    type: 'POST',
                                    url: '{{url('/delete/tickets')}}'+"/"+id,
                                    data:{
                                        id:id,
                                        '_token': '{{csrf_token()}}'
                                    },
                                    success: function (data) {
                                        $('.ticket-table tr#'+id+'').hide();
                                        swal("Deleted!", "Record has been deleted.", "success");

                                    }
                                })
                            } else {
                                swal("Cancelled", "Record is safe :)", "error");
                            }
                        });
            });
        });
    </script>
@stop

