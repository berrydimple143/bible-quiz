@extends('layouts.admin')
@section('title', $title)
@section('content')
    @if (session('newstatus'))
        <div class="row clearfix">
            <div class="alert alert-success" id="success-alert">
                <strong>Well done!</strong> {{ session('newstatus') }}
            </div>
        </div>
    @endif
    @include('admin.dashboard.statistics')
    <div class="row clearfix">
        <div class="col-xs-24 col-sm-12">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                            <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                            <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                @include('admin.dashboard.intro')
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                @include('admin.dashboard.profile_form')
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                @include('admin.dashboard.password_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#success-alert").fadeTo(3000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    </script>
@endsection