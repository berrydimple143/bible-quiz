<div class="single-box comment-box">
    <h2>Leave a Comment</h2>
    <div class="coment-form">
      {!! Form::open(['route' => 'send.comment', 'method' => 'POST']) !!}
      <input type="hidden" name="slug" value="{{ $params['slug'] }}">
      <input type="hidden" name="pid" value="{{ $model->id }}">
      <p>Make sure you enter the required information where indicated. HTML code is not allowed.</p>
      <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
        	    <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif  
        <div class="col-sm-6">
          <label for="name">Name</label>
          <input id="name" name="name" type="text" class="form-control">
        </div>
        <div class="col-sm-6">
          <label for="email">Email (Optional)</label>
          <input id="email" name="email" type="email" class="form-control">
        </div>
        <div class="col-sm-12">
          <label for="website">Website URL (Optional)</label>
          <input id="website" name="website" type="text" class="form-control">
        </div>
        <div class="col-sm-12">
          <label for="message">Message</label>
          <textarea name="message" id="message" rows="8" class="form-control"></textarea>
        </div>
      </div>
      <button type="submit" class="button"><span><i class="fa fa-send"></i>&nbsp;&nbsp; Post Comment</span></button>
      {!! Form::close() !!}
    </div>
  </div>