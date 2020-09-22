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
        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'required']) }}
        <label class="form-label">Caption</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::textarea('description', null, ['class' => 'form-control no-resize', 'maxlength' => 254, 'cols' => 30, 'rows' => 3]) }}
        <label class="form-label">Description</label>
    </div>
</div>
@if($title == "IMAGE UPLOADER")
    <div class="form-group form-float">
        <div class="form-line">
            {{ Form::file('filename', ['required']) }}
        </div>
    </div>
@endif
@if($user->membership == "admin")
    <div class="form-group">
        <span>Status</span>
        <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['stat1'] }}>
        <label for="active">Active</label>
        <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['stat2'] }}>
        <label for="inactive" class="m-l-20">Inactive</label>
    </div>
@endif
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>