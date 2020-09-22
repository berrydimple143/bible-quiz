<?php 
    $loggedIn = Illuminate\Support\Facades\Auth::check(); 
    $rk = 1;
?>
@extends('layouts.games')
@section('title', $title)
@section('content')
<div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Quiz Result</h4>
      </div>
      <div class="modal-body">  
        <h1 id="percentage" style="text-align: center;"></h1>
		<p id="passed">Congratulations! You've successfully passed the quiz. You can now download this quiz with verses by clicking the download button below.</p>
		<p id="addInfo">If you want to save your rating for the ranking you must first login for the discussion below before taking the quiz.</p>
		<p id="failed">Sorry! You've failed to pass the quiz and you can't make any download. Please try again by clicking the reset button below.</p>
		<div class="table-responsive">
            <table class="table table-bordered cart_summary">
              <thead>
                <tr>
                  <th colspan="4" style="text-align: center;"><strong>Ranking for {{ $params['qztype'] }} level in {{ $params['item_count'] }} items</strong></th>
                </tr>
                <tr>
                  <th style="text-align: center;">Rank #</th>
                  <th class="cart_product" style="text-align: center; width: 20px;">Avatar</th>
                  <th style="text-align: center;">Username</th>
                  <th style="text-align: center;">Score</th>
                </tr>
              </thead>
              <tbody>
                @forelse($params['rankings'] as $rank)
                <?php $img = asset('uploads/profiles/'. $rank->user->picture); ?>
                <tr>
                  <th style="text-align: center;">{{ $rk }}</th>
                  <td class="cart_product" style="text-align: center; width: 20px;"><a href="#"><img src="{{ $img }}" alt="{{ $rank->user->firstname }}"></a></td>
                  <td class="price"><span>{{ $rank->user->username }}</span></td>
                  <td class="availability in-stock" style="text-align: center;"><span class="label">{{ $rank->score }}</span></td>
                </tr>
                @empty
                    <tr><td colspan="4">No rankings yet for this level ...</td></tr>
                @endforelse
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        @if($loggedIn)
            <button type="button" class="btn btn-primary" id="saveQuiz" data-dismiss="modal">Save & Download</button>
        @endif
        <button type="button" class="btn btn-primary" id="downloadQuiz" data-dismiss="modal"><i class="fa fa-download"></i> Download Quiz</button>
        <button type="button" class="btn btn-success" id="resetTest2" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="timesUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Time's Up</h4>
      </div>
      <div class="modal-body">
        <h2 style="text-align: center;">Sorry! You lose. You're running out of time. Please try again.</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="resetTest" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<section class="blog_post">
    <div class="container"> 
      <div class="row">
        <div class="col-xs-12 col-sm-9">
            @include('partials.ads.header')
            @if(session('pgstatus'))
                <div class="alert alert-success" id="success-signup">
                    <strong>Well done!</strong> {{ session('pgstatus') }}
                </div>
            @endif
            <div class="entry-detail">
                <div class="content-text clearfix" id="app">
                    <span class="badge badge-green pull-right">Category: {{ $params['qcategory'] }}</span>
                    <span class="pull-right">&nbsp;</span>
                    <span class="badge badge-green pull-right">Items: {{ $params['item_count'] }}</span>
                    <span class="pull-right">&nbsp;</span>
                    <span class="badge badge-green pull-right">Level: {{ $params['qztype'] }}</span>
                    <h2>Test your Bible knowledge.</h2>
                    <span id="imageLayout" class="pull-right"> 
                        <span class="image{h10}"></span> 
                        <span class="image{h1}"></span> 
                        <span class="imageSep"></span> 
                        <span class="image{m10}"></span> 
                        <span class="image{m1}"></span> 
                        <span class="imageSep"></span> 
                        <span class="image{s10}"></span> 
                        <span class="image{s1}"></span> 
                    </span>
                    <em>Complete, pass and download the quiz.</em><br/><br/>
                    <ul class="menu-items col-xs-12">
                        <?php $i=1; ?>
                        @forelse ($model as $quiz)
                            <input type="hidden" id="answerq{{ $quiz->id }}" value="{{ $quiz->answer }}">
                            <input type="hidden" id="answerc{{ $quiz->id }}" value="">
                            <div class="title title_font"><strong>{{ $i }}. {{ $quiz->question }}</strong><span class="question-{{ $quiz->id }}"><span class="required">&nbsp;<i class="fa fa-asterisk"></i></span>&nbsp;&nbsp;<i></i></span></div>
                            @forelse($quiz->choices as $ch)
                                <li class="menu-item depth-1 menucol-1-2" style="list-style: none;">
                                    <ul class="submenu">
                                      <li class="menu-item" style="list-style: none;">
                                        <input type="hidden" id="answer{{ $quiz->id }}{{ $ch->id }}" value="{{ $ch->label }}">
                                        <div class="title"><a style="cursor: pointer;" class="answer" id="answer-{{ $quiz->id }}-{{ $ch->id }}"><i class="fa fa-circle-thin"></i> &nbsp;&nbsp;{{ $ch->label }}</a></div>
                                      </li>
                                    </ul>
                                </li>
                            @empty
                                <li>No choices yet ...</li>
                            @endforelse
                            <?php $i++; ?>
                            <li style="list-style: none;">&nbsp;</li>
                        @empty
                            <li style="list-style: none;"><h3>No quizzes yet for this level ...</h3></li>
                        @endforelse
                        <input type="hidden" id="items" value="{{ $i }}">
                        <input type="hidden" id="itms" value="{{ $params['item_count'] }}">
                        <input type="hidden" id="level" value="{{ $params['qztype'] }}">
                        <input type="hidden" id="category" value="{{ $params['qcategory'] }}">
                        <input type="hidden" id="loggedIn" value="{{ $loggedIn }}">
                    </ul>
                    @if($model->count() > 0)
                    <br/>
                    <div>
                        <a href="{{ route('site') }}" class="btn btn-md btn-primary" id="resetQuiz"><i class="fa fa-refresh"></i> Reset Quiz</a>&nbsp;
                        <span class="pull-right"><h3>Total Score: <input type="text" style="width: 60px;" id="totScore" disabled></h3></span>
                    </div>
                    @endif
                </div>
            </div>
            @include('partials.front.components.quiz_comments')
            @if($loggedIn)
                @include('partials.front.components.quiz_comment_form')
            @else
                <div class="single-box comment-box">
                    <a href="{{ route('quiz.login') }}" class="btn btn-md btn-success" id="quizLogin"><i class="fa fa-lock"></i> Login</a>&nbsp;OR&nbsp;No account yet?&nbsp;
                    <a href="{{ route('quiz.signup') }}" class="btn btn-md btn-danger" id="quizRegister"><i class="fa fa-edit"></i> Sign up for free</a>&nbsp;&nbsp;to participate in a discussion
                </div>
            @endif
            @include('partials.ads.footer')
        </div>
        @include('partials.front.components.game_sidebar')
      </div> 
    </div>
</section>
@endsection