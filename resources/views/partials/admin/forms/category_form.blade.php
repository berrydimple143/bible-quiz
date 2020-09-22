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
        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) }}
        <label class="form-label">Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::textarea('description', null, ['class' => 'form-control no-resize', 'maxlength' => 254, 'cols' => 30, 'rows' => 5, 'required']) }}
        <label class="form-label">Description</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::select('icon', $params['icons'], null, ['class' => 'form-control show-tick', 'id' => 'icon', 'placeholder' => 'Please choose an icon here']) }}
        <label class="form-label">Icon</label>
    </div>
</div>
<div class="form-group">
    <span>Dummy</span>
    <input type="radio" name="dummy" id="yes" value="yes" class="with-gap" {{ $params['dummycheck1'] }}>
    <label for="yes">Yes</label>
    <input type="radio" name="dummy" id="no" value="no" class="with-gap" {{ $params['dummycheck2'] }}>
    <label for="no" class="m-l-20">No</label>
</div>
<div class="form-group">
    <span>Status</span>
    <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['statcheck1'] }}>
    <label for="active">Active</label>
    <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['statcheck2'] }}>
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