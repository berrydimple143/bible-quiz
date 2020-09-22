<?php
    $mstat = $user->membership;
    $cls = "bg-green";
    if($mstat == "regular") {
        $mstat = "trial";
        $cls = "bg-red";
    }
    $info = "Click me to change your profile picture.";
?>
<aside id="leftsidebar" class="sidebar">
    <div class="user-info">
        <div class="image">
            <a href="{{ route('picture.change') }}" id="change-pic" rel="popover" data-content="{{ $info }}"><img src="{{ $profile_pic }}" width="48" height="48" alt="User" class="img-responsive" /></a>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $user->firstname }} {{ $user->lastname }}</div>
            <div class="email">{{ $user->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('logout') }}"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">MEMBERSHIP: &nbsp;&nbsp;<span class="{{ $cls }}">&nbsp;{{ strtoupper($mstat) }}&nbsp;</span></li>
            <li class="{{ $menus['menu1'] }}">
                <a href="{{ route('dashboard') }}">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if($user->membership == "admin")
                <li class="{{ $menus['menu2'] }}">
                    <a href="{{ route('users') }}">
                        <i class="material-icons">group</i>
                        <span>Users</span>
                    </a>
                </li>
            @endif
            @if($user->membership != "player")
                <li  class="{{ $menus['menu3'] }}">
                    <a href="{{ route('posts') }}">
                        <i class="material-icons">speaker_notes</i>
                        <span>Posts</span>
                    </a>
                </li>
            @endif
            @if($user->membership == "admin")
                <li  class="{{ $menus['menu4'] }}">
                    <a href="{{ route('comments') }}">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>
                <li class="{{ $menus['menu5'] }}">
                    <a href="{{ route('categories') }}">
                        <i class="material-icons">view_list</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li  class="{{ $menus['menu6'] }}">
                    <a href="{{ route('photos') }}">
                        <i class="material-icons">image</i>
                        <span>Images</span>
                    </a>
                </li>
                <li  class="{{ $menus['menu7'] }}">
                    <a href="{{ route('subscriptions') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>Subscriptions</span>
                    </a>
                </li>
                <li  class="{{ $menus['menu8'] }}">
                    <a href="{{ route('quizzes') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>Quizzes</span>
                    </a>
                </li>
                <li  class="{{ $menus['menu10'] }}">
                    <a href="{{ route('topics') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>Bible Topics</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('logout') }}">
                    <i class="material-icons">input</i>
                    <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<script>
    $("#change-pic").popover({
        placement: 'right',
        trigger: 'hover',
        template: '<div class="popover field-info"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
        html: true,
        title: 'Information'
    });
</script>