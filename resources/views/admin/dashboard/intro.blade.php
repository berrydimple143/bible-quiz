<div class="panel panel-default panel-post">
    <div class="panel-heading">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img src="{{ asset('admin/images/user-lg.jpg') }}" />
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <a href="#">Codename Black</a>
                </h4>
                Message from the CEO
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="post">
            <div class="post-heading">
                <p>
                    Good {{ $params['greetings'] }}, {{ $user->firstname }}. I hope you are doing well this {{ $params['greetings'] }}.
                    Here's a quote for you today: <strong>{{ $params['quote'] }}</strong>.
                </p>
            </div>
            <div class="post-content">
                <img src="{{ $params['display'] }}" class="img-responsive" />
            </div>
        </div>
    </div>
</div>