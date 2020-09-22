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
@if($title == "Bible Verses Creator")
    <div class="form-group form-float">
        <div class="form-line">
            <select class="form-control show-tick" name="topic_id" id="topic_id" required>
                <option value="">-- Please select a topic for this verse --</option>
                @foreach($params['topics'] as $top)
                    @if($top->verses_count > 0)
                        <option value="{{ $top->id }}" style="color: red;">{{ $top->title }} ({{ $top->verses_count }})</option>
                    @else
                        <option value="{{ $top->id }}" style="color: green;">{{ $top->title }} ({{ $top->verses_count }})</option>
                    @endif
                @endforeach
            </select>
            <label class="form-label">Topic</label>
        </div>
    </div>
    <div class="form-group form-float">
        <div class="form-line">
            <select class="form-control show-tick" name="book_id" id="book_id" required>
                <option value="">-- Please select a book for this verse --</option>
                @foreach($params['books'] as $bk)
                    <option value="{{ $bk->id }}">{{ $bk->name }}</option>
                @endforeach
            </select>
            <label class="form-label">Book</label>
        </div>
    </div>
@endif
<div class="form-group form-float">
    <div class="form-line">
        {{ Form::textarea('message', null, ['class' => 'form-control no-resize', 'cols' => 30, 'rows' => 5, 'required']) }}
        <label class="form-label">Message</label>
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
<button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ strtoupper($params['btn']) }}</button>