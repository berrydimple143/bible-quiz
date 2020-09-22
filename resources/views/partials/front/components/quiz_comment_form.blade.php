<div class="single-box comment-box">
    <h2>Leave a discussion</h2>
    <div class="coment-form">
      {!! Form::open(['route' => 'send.discussion', 'method' => 'POST']) !!}
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
        <div class="col-sm-12">
          <label for="message">Message</label>
          <textarea name="message" id="message" rows="8" class="form-control"></textarea>
        </div>
      </div>
      <button type="submit" class="button"><span><i class="fa fa-send"></i>&nbsp;&nbsp; Send</span></button>
      {!! Form::close() !!}
    </div>
  </div>