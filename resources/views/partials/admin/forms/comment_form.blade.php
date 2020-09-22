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
@if($title == "Comment Creator")
    <div class="form-group form-float">
        <div class="form-line">
            <select class="form-control show-tick" name="post_id" id="post_id" required>
                <option value="">-- Please select a post for this comment here --</option>
                @foreach($model as $p)
                    <option value="{{ $p->id }}">{{ $p->title }}</option>
                @endforeach
            </select>
            <label class="form-label">Post</label>
        </div>
    </div>
@endif
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) }}
        <label class="form-label">Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
        <label class="form-label">Email</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('website', null, ['class' => 'form-control', 'id' => 'website']) }}
        <label class="form-label">Website</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::textarea('message', null, ['class' => 'form-control no-resize', 'maxlength' => 254, 'cols' => 30, 'rows' => 5]) }}
        <label class="form-label">Description</label>
    </div>
</div>
<div class="form-group">
    <span>Status</span>
    <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['stat1'] }}>
    <label for="active">Active</label>
    <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['stat2'] }}>
    <label for="inactive" class="m-l-20">Inactive</label>
</div>
<div class="form-group">
    <span>Reported</span>
    <input type="radio" name="reported" id="yes" value="yes" class="with-gap" {{ $params['repcheck1'] }}>
    <label for="yes">Yes</label>
    <input type="radio" name="reported" id="no" value="no" class="with-gap" {{ $params['repcheck2'] }}>
    <label for="no" class="m-l-20">No</label>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>