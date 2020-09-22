@extends('layouts.filtered')
@section('title', $title)
@section('content')
<div class="main-container col1-layout">
    <div class="container">
        <div class="row">
            <div class="col-main col-sm-12 col-xs-12">
                <div class="shop-inner">
                    <div class="page-title">
                      <h4>Please choose your subscription below</h4>
                    </div>
                    <div class="toolbar column">
                        <div class="sorter">
                        </div>
                    </div>
                    <div class="product-grid-area">
                      <section id="pricePlans">
                		<ul id="plans">
                		    <li class="plan platinum">
                				<ul class="planContainer">
                					<li class="title"><h2 class="bestPlanTitle">Free</h2></li>
                					<li class="price"><p class="bestPlanPrice">${{ $params['regular']->price }}</p></li>
                					<li>
                						<ul class="options">
                							<li>Create {{ $params['regular']->article }} article/post</li>
                							<li>Upload {{ $params['regular']->image }} image <span>to be used in your article</span></li>
                							<li><span>Add Youtube video links and other links such as external images in your content</span></li>
                							<li><span>Your article links can be posted/shared with facebook, followed on twitter, shared with all your referrals, etc.</span></li>
                							<li>Note: <span>Free membership account and article will expire after 1 month</span></li>
                						</ul>
                					</li>
                					<li class="button"><a class="bestPlanButton3" href="{{ route('premium.pay', ['stype' => 'free', 'amt' => '0.00']) }}">Register Now</a></li>
                				</ul>
                			</li>
                			<li class="plan silver">
                				<ul class="planContainer">
                					<li class="title"><h2 class="bestPlanTitle">Silver</h2></li>
                					<li class="price"><p class="bestPlanPrice">${{ $params['silver']->price }}/month</p></li>
                					<li>
                						<ul class="options">
                							<li>Create up to {{ $params['silver']->article }} articles/posts</li>
                							<li>Upload up to {{ $params['silver']->image }} images <span>to be used in your articles</span></li>
                							<li><span>Add Youtube video links and other links such as external images in your content</span></li>
                							<li><span>Your article links can be posted/shared with facebook, followed on twitter, shared with all your referrals, etc.</span></li>
                						</ul>
                					</li>
                					<li class="button"><a class="bestPlanButton1" href="{{ route('premium.pay', ['stype' => 'silver', 'amt' => $params['silver']->price]) }}">Subscribe Now</a></li>
                				</ul>
                			</li>
                			<li class="plan gold">
                				<ul class="planContainer">
                					<li class="title"><h2 class="bestPlanTitle">Gold</h2></li>
                					<li class="price"><p class="bestPlanPrice">${{ $params['gold']->price }}/month</p></li>
                					<li>
                						<ul class="options">
                							<li>Create up to {{ $params['gold']->article }} articles/posts</li>
                							<li>Upload up to {{ $params['gold']->image }} images <span>to be used in your articles</span></li>
                							<li><span>Add Youtube video links and other links such as external images in your content</span></li>
                							<li><span>Your article links can be posted/shared with facebook, followed on twitter, shared with all your referrals, etc.</span></li>
                						</ul>
                					</li>
                					<li class="button"><a class="bestPlanButton2" href="{{ route('premium.pay', ['stype' => 'gold', 'amt' => $params['gold']->price]) }}">Subscribe Now</a></li>
                				</ul>
                			</li>
                		</ul>
                	</section>
                    </div>
                    <div class="pagination-area ">
                        <h3 id="hurry">Hurry up! Subscribe now! This is a limited offer.</h3>
                    </div>
                </div>
            </div>
    </div>
  </div>
</div>
@endsection