{!! Form::open(['route' => 'password.update', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
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
    <div class="form-group">
        <label for="oldpassword" class="col-sm-3 control-label">Old Password</label>
        <div class="col-sm-9">
            <div class="form-line">
                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">New Password</label>
        <div class="col-sm-9">
            <div class="form-line">
                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="password_confirmation" class="col-sm-3 control-label">Confirm New Password</label>
        <div class="col-sm-9">
            <div class="form-line">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-danger">SUBMIT</button>
        </div>
    </div>
{!! Form::close() !!}