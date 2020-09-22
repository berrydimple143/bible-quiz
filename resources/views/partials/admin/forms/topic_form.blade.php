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
        <label class="form-label">Title</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('book', null, ['class' => 'form-control', 'id' => 'book']) }}
        <label class="form-label">Book</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('chapter', null, ['class' => 'form-control', 'id' => 'chapter']) }}
        <label class="form-label">Chapter</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('verse', null, ['class' => 'form-control', 'id' => 'verse']) }}
        <label class="form-label">Verse</label>
    </div>
</div>
<div class="form-group">
    <span>Visible</span>
    <input type="radio" name="visible" id="yes" value="yes" class="with-gap" {{ $params['visibility1'] }}>
    <label for="yes">Yes</label>
    <input type="radio" name="visible" id="no" value="no" class="with-gap" {{ $params['visibility2'] }}>
    <label for="no" class="m-l-20">No</label>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>