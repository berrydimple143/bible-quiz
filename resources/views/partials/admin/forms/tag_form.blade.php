{{ Form::hidden('postid', $params['id']) }}
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('tag', null, ['class' => 'form-control', 'id' => 'tag', 'required']) }}
        <label class="form-label">Tag</label>
    </div>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ $params['btn'] }}</button>