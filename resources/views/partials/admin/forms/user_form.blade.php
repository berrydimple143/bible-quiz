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
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'required']) }}
        <label class="form-label">First Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname', 'required']) }}
        <label class="form-label">Last Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('middlename', null, ['class' => 'form-control', 'id' => 'middlename']) }}
        <label class="form-label">Middlename</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) }}
        <label class="form-label">Email</label>
    </div>
</div>
@if($title == "User Creator")
    <div class="form-group form-float">
        <div class="form-line">
            {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required'])  }}
            <label class="form-label">Password</label>
        </div>
    </div>
@endif
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::select('membership', $params['mem'], null, ['class' => 'form-control show-tick', 'placeholder' => 'Choose a membership']) }}
        <label class="form-label">Membership</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::select('subscription', $params['sub'], null, ['class' => 'form-control show-tick', 'placeholder' => 'Choose a subscription']) }}
        <label class="form-label">Subscription</label>
    </div>
</div>
<div class="form-group">
    <span>Status</span>
    <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['stat1'] }}>
    <label for="active">Active</label>
    <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['stat2'] }}>
    <label for="inactive" class="m-l-20">Inactive</label>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>