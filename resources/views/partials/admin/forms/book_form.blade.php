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
        <label class="form-label">Book Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('shortname', null, ['class' => 'form-control', 'id' => 'shortname']) }}
        <label class="form-label">Short Name</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('priority', null, ['class' => 'form-control', 'id' => 'priority', 'required']) }}
        <label class="form-label">Priority Number</label>
    </div>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>