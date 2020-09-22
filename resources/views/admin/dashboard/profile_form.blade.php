<?php $emailinfo = "If you want to change your <strong>email address</strong>, please click this button."; ?>
{!! Form::open(['route' => 'profile.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    @if ($errors->any())
        <div class="alert bg-red alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ $user->firstname }}" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ $user->lastname }}" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="middlename" class="col-sm-2 control-label">Middle Name</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name" value="{{ $user->middlename }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <div class="input-group">
                <div class="form-line">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" read-only disabled>
                </div>
                <span class="input-group-addon">
                    <a href="{{ route('email.change') }}"><button type="button" class="btn bg-orange btn-circle waves-effect waves-circle waves-float" id="keyword-info" rel="popover" data-content="{{ $emailinfo }}">
                        <i class="material-icons">edit</i>
                    </button></a>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Self Description</label>
        <div class="col-sm-10">
            <div class="form-line">
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe yourself here if you want ..." value="{{ $user->description }}">{{ $user->description }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="website" class="col-sm-2 control-label">Website</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="website" name="website" placeholder="Type your website url here if any ..." value="{{ $user->website }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="facebook" class="col-sm-2 control-label">Facebook</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Type your facebook url here if any ..." value="{{ $user->facebook }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="twitter" class="col-sm-2 control-label">Twitter</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Type your twitter account like this '@Virgil_Dimple' for SEO purposes if any ..." value="{{ $user->twitter }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="linkedin" class="col-sm-2 control-label">LinkedIn</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Type your LinkedIn url here if any ..." value="{{ $user->linkedin }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="portfolio" class="col-sm-2 control-label">Portfolio Site</label>
        <div class="col-sm-10">
            <div class="form-line">
                <input type="text" class="form-control" id="portfolio" name="portfolio" placeholder="Type the url of your portfolio here if any ..." value="{{ $user->portfolio }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">SAVE CHANGES</button>
        </div>
    </div>
{!! Form::close() !!}
<script>
    $("#keyword-info").popover({
        placement: 'top',
        trigger: 'hover',
        template: '<div class="popover field-info"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
        html: true,
        title: 'Information'
    });
</script>