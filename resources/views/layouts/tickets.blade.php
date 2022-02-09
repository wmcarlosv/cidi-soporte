<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$settings->description}}">
    <meta name="keywords" content="{{$settings->keywords}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{asset('plugin/jquery/jquery.min.js')}}"></script>

    <title>Ticket Plus | @yield('title')</title>

    <link rel="stylesheet" href="{{asset('plugin/bootstrap-3.3.7/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/datatable/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">

    <link rel="icon" href="{{asset('images/fav.png')}}" type="image/x-icon"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand navbar-link" href="{{url('/')}}">
                <img src="{{asset('uploads')}}/{{$settings->logo}}" alt="LOGO"></a>
            <div class="visible-sm visible-xs pull-right" id="menu-btn">
                <span class="fa fa-ellipsis-v"></span>
            </div>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('/about')}}">About</a></li>
                <li><a href="{{url('/')}}">Contact</a></li>
                @if(Auth::user())
                    <li class="ticket"><a href="{{url('tickets')}}">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle clearfix" data-toggle="dropdown">
                            Notifications <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span>
                        </a>
                        <ul class="dropdown-menu notification_dropdown">
                            @foreach (Auth::user()->notifications as $notification)
                                @if($notification->type == 'App\Notifications\TicketReply')
                                    <li>
                                        <a href="{{url('ticket')}}/{{$notification->data['ticket_id']}}/{{str_replace(' ', '-',   strtolower($notification->data['ticket_title']))}}">
                                            <strong class="badge">{{$notification->data['reply_user']}}</strong>
                                            <small>replied to a ticket</small>
                                            <br><span class="ticket_small_title">{{$notification->data['ticket_title']}}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($notification->type == 'App\Notifications\TicketStatus')
                                    <li>
                                        <a href="{{url('ticket')}}/{{$notification->data['ticket_id']}}/{{str_replace(' ', '-',   strtolower($notification->data['ticket_title']))}}">
                                            <small>Ticket status changed to</small>
                                            <strong class="badge">{{$notification->data['status']}}</strong>
                                            <br>
                                            <span class="ticket_small_title"> {{$notification->data['ticket_title']}}</span>
                                        </a>
                                    </li>
                                @endif

                                @if($notification->type == 'App\Notifications\NewTicket')
                                    <li>
                                        <a href="{{url('ticket')}}/{{$notification->data['ticket_id']}}/{{str_replace(' ', '-',   strtolower($notification->data['ticket_title']))}}">
                                            <small>New ticket created by</small>
                                            <strong class="badge">{{$notification->data['user_name']}}</strong>
                                            <br>
                                            <span class="ticket_small_title"> {{$notification->data['ticket_title']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle clearfix" data-toggle="dropdown">
                            @if(Auth::user()->avatar == null)
                                <span class="avatar"><img src="{{asset('uploads/avatar.png')}}" alt="avatar"></span>
                            @else
                                <span class="avatar"><img src="{{asset('uploads')}}/{{Auth::user()->avatar}}" alt="avatar"></span>

                            @endif
                            <span class="user_name">{{Auth::user()->name}}</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('profile/settings')}}"><i class="fa fa-gear"></i> Profile Settings</a></li>
                            <li><a href="{{url('change/password')}}"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-lock"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @endif

                @if(Auth::guest())
                    <li><a href="{{url('login')}}">Login</a></li>
                    <li><a href="{{url('register')}}" >Register</a></li>
                @endif
                <li><a href="{{url('new/ticket')}}" class="new_ticket">New Ticket</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="main-home">
    <div class="main-home">
        <div class="main-img-area small-title">
            <div class="container">
                <h1>@yield('title')</h1>
            </div>
        </div>
    </div>
</section>

<div class="many-button-box text-center" id="ticket-setting">

    <div class="button-box dropdown">
        @if(Auth::user()->hasRole('admin'))
            <a  class="btn btn-default" href="{{asset('/admin/tickets')}}">
                <img src="{{asset('images/sms-icon.png')}}" alt="Icon Not available">
                <i class="fa fa-comment-o"></i>
                <span class="button-text">Tickets</span>
            </a>
        @else
            <a  class="btn btn-default" href="{{asset('/tickets')}}">
                <img src="{{asset('images/sms-icon.png')}}" alt="Icon Not available">
                <i class="fa fa-comment-o"></i>
                <span class="button-text">Tickets</span>
            </a>
        @endif
    </div>

    <div class="button-box dropdown">
        <a  class="btn btn-default admin" href="{{asset('/admin/admins')}}">
            <img src="{{asset('images/handset.png')}}" alt="Icon Not available">
            <i class="fa fa-headphones"></i>
            <span class="button-text">Admin</span>
        </a>
    </div>

    <div class="button-box dropdown">
        <a  class="btn btn-default users" href="{{asset('/admin/staff')}}">
            <img src="{{asset('images/user-group.png')}}" alt="Icon Not available">
            <i class="fa fa-users"></i>
            <span class="button-text">Staff</span>
        </a>
    </div>

    <div class="button-box dropdown">
        <a  class="btn btn-default  setting" href="{{asset('/admin/clients')}}">
            <img src="{{asset('images/user-group.png')}}" alt="Icon Not available">
            <i class="fa fa-users"></i>
            <span class="button-text">Clients</span>
        </a>

    </div>

    <div class="button-box dropdown">
        <a class="btn btn-default faq" href="{{url('admin/faq')}}">
            <img src="{{asset('images/question-mark.png')}}" alt="Icon Not available">
            <i class="fa fa-question-circle-o"></i>
            <span class="button-text">FAQ</span>
        </a>
    </div>

    <div class="button-box dropdown">

        <a href="{{url('admin/departments')}}" type="button" class="btn btn-default department">
            <img src="{{asset('images/department.png')}}" alt="Icon Not available">
            <i class="fa fa-building-o"></i>
            <span class="button-text">Department</span>
        </a>
    </div>

    <div class="button-box dropdown right-margin0">
        <a href="{{url('/admin/settings')}}" type="button" class="btn btn-default setting">
            <img src="{{asset('images/setting.png')}}" alt="Icon Not available">
            <i class="fa fa-gear"></i>
            <span class="button-text">Setting</span>
        </a>

    </div>


</div>


@yield('content')

<section id="footer">
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-content">
                        <div class="col-md-12">
                            <div class="section-one">
                                <img src="{{asset('uploads')}}/{{$settings->footer_logo}}" class="img-responsive" alt="Nothing">
                                <p class="media-body">{{$settings->footer_description}}
                                </p>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="{{$settings->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="{{$settings->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{$settings->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="registered">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="one text-center">
                                <p>{{$settings->copyrights}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>

<!--jquery-->
<script src="{{asset('plugin/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugin/bootstrap-3.3.7/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugin/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('plugin/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugin/slick/slick.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

<script>
    $('.notification_dropdown li a').on('click', function () {
        $.ajax({
            type: 'GET',
            url: '{{url('/markAsRead')}}'
        })
    });
</script>

@yield('script')

</body>
</html>
