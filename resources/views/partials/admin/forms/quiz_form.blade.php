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
        {{ Form::text('question', null, ['class' => 'form-control', 'id' => 'question', 'required']) }}
        <label class="form-label">Question</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('answer', null, ['class' => 'form-control', 'id' => 'answer', 'required']) }}
        <label class="form-label">Answer</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('verse', null, ['class' => 'form-control', 'id' => 'verse']) }}
        <label class="form-label">Verse(s)</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('category', null, ['class' => 'form-control', 'id' => 'category']) }}
        <label class="form-label">Category</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::select('type', ['simple' => 'simple', 'moderate' => 'moderate', 'hard' => 'hard'], null, ['class' => 'form-control show-tick', 'id' => 'type', 'placeholder' => 'Please choose a level']) }}
        <label class="form-label">Level</label>
    </div>
</div>
<div class="form-group">
    <span>Status</span>
    <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['statcheck1'] }}>
    <label for="active">Active</label>
    <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['statcheck2'] }}>
    <label for="inactive" class="m-l-20">Inactive</label>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>