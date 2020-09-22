<?php $allItems = [20, 30, 40, 50, 60, 70, 80, 90, 100]; ?>
<aside class="sidebar col-xs-12 col-sm-3"> 
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Bible Quiz Items</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
              <div id="search">
                <form id="select-items-form">
                  <div class="input-group">
                    <input type="hidden" name="qztype" id="qztype" value="{{ $params['qztype'] }}">
                    <input type="hidden" name="qcategory" id="qcategory" value="{{ $params['qcategory'] }}">
                    <select class="cate-dropdown" id="quiz_items" name="quiz_items">
                      <option value="20">Select quiz items</option>
                      @foreach($allItems as $itm)
                        <option value="{{ $itm }}">&nbsp;{{ $itm }}</option>
                      @endforeach
                    </select>
                    <button class="btn-search" id="choose-items" type="button">Go</button>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
  <div class="block blog-module">
    <div class="sidebar-bar-title">
      <h3>Bible Quiz Levels</h3>
    </div>
    <div class="block_content"> 
      <div class="layered">
        <div class="layered-content">
          <?php
            $qcat = "none";
            if($params['qcategory'] != "") {
                $qcat = str_replace(" ", "@@@", $params['qcategory']);
            }
          ?>
          <ul class="tree-menu">
              <li><a href="{{ route('select.quiz.level', ['level' => 'simple', 'items' => $params['item_count'], 'qcategory' => $qcat]) }}"><i class="fa fa-angle-right"></i>&nbsp; Simple</a></li>
              <li><a href="{{ route('select.quiz.level', ['level' => 'moderate', 'items' => $params['item_count'], 'qcategory' => $qcat]) }}"><i class="fa fa-angle-right"></i>&nbsp; Moderate</a></li>
              <li><a href="{{ route('select.quiz.level', ['level' => 'hard', 'items' => $params['item_count'], 'qcategory' => $qcat]) }}"><i class="fa fa-angle-right"></i>&nbsp; Hard</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @include('partials.front.components.paypal_donation')
  @include('partials.ads.sidebar')
</aside>