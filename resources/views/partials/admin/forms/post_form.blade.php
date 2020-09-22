<?php
    $sluginfo = "<strong>Important:</strong><br/>This is used as a url suffix of this article/post (e.g. http://onlinestorehouse.com/blog/favorite-sport-shoe).
                    <br/>Separate each word with a hyphen.<br/> This is used by google to easily find this article/blog.<br/> This must be unique for each post/article.
                    <br/>Example: the-quick-brown-fox<br/><br/>Note: <strong>For SEO purposes</strong>
                ";
    $keywordinfo = "<strong>Important:</strong><br/>Keywords used by search engines (google, etc.) to find this article/post.
                    <br/>Separate each word or phrase with comma if you have multiple keywords.<br/>Example: sports, animation, games, etc.<br/><br/>Note: <b>For SEO purposes</b>";
?>
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
@if($title == "Article Editor")
    {{ Form::hidden('date_posted', $model->date_posted) }}
    {{ Form::hidden('lastpub', $model->published) }}
@endif
@if($title == "Article Creator")
    <div class="form-group form-float">
        <div class="form-line">
            <select class="form-control show-tick" name="category_id" id="category_id" required>
                <option value="">-- Please select a category for this article/post here --</option>
                @foreach($model as $ct)
                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                @endforeach
            </select>
            <label class="form-label">Category</label>
        </div>
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
        {{ Form::text('author', null, ['class' => 'form-control', 'id' => 'author']) }}
        <label class="form-label">Author</label>
    </div>
</div>
<div class="form-group form-float">
    <div class="input-group">
        <div class="form-line">
            {{ Form::text('description', null, ['class' => 'form-control date', 'id' => 'description', 'placeholder' => 'Keyword(s)']) }}
        </div>
        <span class="input-group-addon">
            <button type="button" class="btn bg-orange btn-circle waves-effect waves-circle waves-float" id="keyword-info" rel="popover" data-content="{{ $keywordinfo }}">
                <i class="material-icons">error_outline</i>
            </button>
        </span>
    </div>
</div>
@if($title == "Article Creator")
    <div class="form-group form-float">
        <div class="input-group">
            <div class="form-line">
                {{ Form::text('slug', null, ['class' => 'form-control date', 'id' => 'slug', 'placeholder' => 'Slug', 'required']) }}
            </div>
            <span class="input-group-addon">
                <button type="button" class="btn bg-orange btn-circle waves-effect waves-circle waves-float" id="slug-info" rel="popover" data-content="{{ $sluginfo }}">
                    <i class="material-icons">error_outline</i>
                </button>
            </span>
        </div>
    </div>
@endif
<div class="form-group">
    {{ Form::textarea('body', null, ['id' => 'postbody', 'placeholder' => 'Type your article or blog post here...']) }}
</div>
@if($title == "Article Creator")
    <div class="form-group form-float">
        <div class="form-line">
            <input type="file" name="photo" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-iconName="glyphicon glyphicon-upload" data-buttonText="Upload your image here (We recommend 500x300 px)" required>
        </div>
    </div>
@endif
<div class="form-group">
    <span>Publish it now?</span>
    <input type="radio" name="published" id="yes" value="yes" class="with-gap" {{ $params['pub1'] }}>
    <label for="yes">Yes</label>
    <input type="radio" name="published" id="no" value="no" class="with-gap" {{ $params['pub2'] }}>
    <label for="no" class="m-l-20">No</label>
</div>
@if($user->membership == "admin")
    <div class="form-group">
        <span>Status</span>
        <input type="radio" name="status" id="active" value="active" class="with-gap" {{ $params['statcheck1'] }}>
        <label for="active">Active</label>
        <input type="radio" name="status" id="inactive" value="inactive" class="with-gap" {{ $params['statcheck2'] }}>
        <label for="inactive" class="m-l-20">Inactive</label>
    </div>
    <div class="form-group">
        <span>Reported</span>
        <input type="radio" name="reported" id="repyes" value="yes" class="with-gap" {{ $params['repcheck1'] }}>
        <label for="repyes">Yes</label>
        <input type="radio" name="reported" id="repno" value="no" class="with-gap" {{ $params['repcheck2'] }}>
        <label for="repno" class="m-l-20">No</label>
    </div>
    <div class="form-group">
        <span>Popular</span>
        <input type="radio" name="popular" id="popyes" value="yes" class="with-gap" {{ $params['pop1'] }}>
        <label for="popyes">Yes</label>
        <input type="radio" name="popular" id="popno" value="no" class="with-gap" {{ $params['pop2'] }}>
        <label for="popno" class="m-l-20">No</label>
    </div>
@endif
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>
<script>
    tinymce.init({
        selector: "#postbody",
        theme: "modern",
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    $("#keyword-info, #slug-info").popover({
        placement: 'top',
        trigger: 'hover',
        template: '<div class="popover field-info"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>',
        html: true,
        title: 'Instructions/Information'
    });
</script>