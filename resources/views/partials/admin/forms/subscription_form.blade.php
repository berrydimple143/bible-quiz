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
        {{ Form::text('article', null, ['class' => 'form-control', 'id' => 'article', 'required']) }}
        <label class="form-label"># of Articles</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('image', null, ['class' => 'form-control', 'id' => 'image', 'required']) }}
        <label class="form-label"># of Images</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'required']) }}
        <label class="form-label">Price</label>
    </div>
</div>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>