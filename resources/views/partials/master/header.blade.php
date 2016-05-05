<?php $user = Auth::user();
//$notifications = \DB::select('select * from notifications where user_id = :id', ['id' => $user->id]);
$notifications = DB::table('notifications')->orderBy('id', 'desc')->where('user_id', $user->id)->get();
$not_seen_notifications = \DB::select('select * from notifications where user_id = :id and seen = "No"', ['id' => $user->id])?>
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ticket</b>Support</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if(count($not_seen_notifications) > 0)
                            <span class="label label-warning">{{count($not_seen_notifications)}}</span>
                        @else
                            <span class="label label-warning"></span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{count($not_seen_notifications)}} new notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                @foreach($notifications as $notification)
                                    <li>
                                        <a href="{{$notification->url}}">
                                            <i class="fa fa-users text-aqua"></i> {{$notification->body}}
                                        </a>
                                    </li>
                                    <?php  DB::table('notifications')->where('id', $notification->id)->update(['seen' => "Yes"]); ?>
                                @endforeach

                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/bower_components/AdminLTE/dist/img/default-avatar.jpg" class="user-image"
                             alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->fullName()}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('/bower_components/AdminLTE/dist/img/default-avatar.jpg')}}"
                                 class="img-circle" alt="User Image">

                            <p>
                                {{Auth::user()->fullName()}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('auth/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route("users.show",Auth::user())}}"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>