<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ trans('front/site.title') }}</title>
		<meta name="description" content="">	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		@yield('head')
		{!! HTML::style('css/bootstrap.min.css') !!}
		{!! HTML::style('css/main_front.css') !!}
		<!-- Owl Carousel Assets -->
		{!! HTML::style('owl-carousel/owl.carousel.css') !!}
  		{!! HTML::style('owl-carousel/owl.theme.css') !!}
		{!! HTML::style('css/formValidation.min.css') !!}

		<!--[if (lt IE 9) & (!IEMobile)]>
			{!! HTML::script('js/vendor/respond.min.js') !!}
		<![endif]-->
		<!--[if lt IE 9]>
			{!! HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') !!}
			{!! HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
		<![endif]-->

		{!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') !!}
		{!! HTML::style('http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic') !!}

		{!! HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

		{!! HTML::script('js/formValidation.min.js') !!}
		{!! HTML::script('js/bootstrap.min.js') !!}
		{!! HTML::script('owl-carousel/owl.carousel.min.js') !!}
		{!! HTML::script('http://www.jasny.net/bootstrap/dist/js/jasny-bootstrap.min.js') !!}

	</head>

  <body data-spy="scroll" data-target="#myNavbar" data-offset="70">

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header role="banner">
		<div class="top-header" id="myNavbar">
			<div class="container">
				<div class="col-md-3">
					<div class="brand-logo">
						<?php $dataLogo = DB::table('settings')->where('name', 'dataLogo')->select('content')->get()[0]; ?>
						<h1><a href="{!! url('/') !!}"><img class="logo" src="{!!url('/uploads/commons/'.$dataLogo->content )!!}" alt="{!! trans('front/site.title') !!}"/></a></h1>
                    </div>
				</div>
				<div class="col-md-9">
					<div class="bottom-header-">
						<nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                {!! link_to('/', trans('front/site.title')) !!}
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li {!! classActivePath('/') !!}>
                                        {!! link_to('#home', trans('front/site.home')) !!}
                                    </li>
                                    <li>
                                        {!! link_to('#howwork', 'How it work') !!}
                                    </li>
                                    <li>
                                        {!! link_to('#resume', 'Resume') !!}
                                    </li>
                                    <li>
                                        {!! link_to('#qna', trans('front/site.QA')) !!}
                                    </li>
                                    <li>
                                        {!! link_to('#contact', trans('front/site.contact')) !!}
                                    </li>
                                </ul>
                            </div>
						</nav>
					</div>
				</div>
			</div>
		</div>		

		<div class="bottom-header wow fadeIn" id="home" >
            <div class="container">
                <div class="row">
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="box-left">
                            <ul>
                                <?php if(!Auth::check())  {?>
                                <li>
                                    {!! link_to('auth/register', trans('front/site.register')) !!}
                                </li>

                                <li>
                                    {!! link_to('password/email', trans('front/site.forget-password')) !!}
                                </li>

                                <li>
                                    {!! link_to('auth/login', trans('front/site.connection')) !!}
                                </li>
                                <?php } else {?>

                                <li>
                                    {!! link_to('auth/logout', trans('front/site.logout')) !!}
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="collapse navbar-collapse language-box">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" /></a>
                                    <ul class="dropdown-menu">
                                        @foreach ( config('app.languages') as $user)
                                            @if($user !== config('app.locale'))
                                                <li><a href="{!! url('language') !!}/{{ $user }}"><img width="32" height="32" alt="{{ $user }}" src="{!! asset('img/' . $user . '-flag.png') !!}"></a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
		</div>
	</header>

	<main role="main" class="container">
		@if(session()->has('ok'))
			@include('partials/error', ['type' => 'success', 'message' => session('ok')])
		@endif	
		@if(isset($info))
			@include('partials/error', ['type' => 'info', 'message' => $info])
		@endif
		@yield('main')
	</main>

	<!-- How it works -->
	<section class="info-section how-it-works text-center wow fadeIn" data-wow-delay="0.4s" id="howwork">
	    <div class="container">
	        <h2 class="highlight">How it works?</h2>
	        <div class="row text-center">
	            <div class="col-sm-4">
	                <div class="step step-1">
	                    <h3>Choose a country</h3>
						<p>We are growing constantly. At this time we are present in over  104 000 locations worldwide in 69 countries.</p>
	                </div>
	            </div>
	            <div class="col-sm-4">
	                <div class="step step-2">
	                    <h3>Sign in</h3>
						<p>We are always open to new ideas when it concerns your money. One time registration to profit from long term benefits.</p>
	                </div>
	            </div>
	            <div class="col-sm-4">
	                <div class="step step-3 last">
	                    <h3>Transfer money</h3>
						<p>Easy money transfer via your credit card to a bank or to a pay out station.</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	<section class="video">
	    <div class="youtube-video-container">
	        <iframe src="https://www.youtube.com/embed/ezR7xa3LAH4?rel=0&amp;controls=0&amp;modestbranding=1&amp;showinfo=0" frameborder="0" allowfullscreen=""></iframe>
	    </div>
	</section>

	<!-- TAB REALTIME COST -->
    <div class="box-realtime  box-center">
        <div class="container">
            <div class="row">
                <h4>TAB REALTIME COST</h4>
            </div>
        </div>
    </div>
	<!-- TAB REALTIME COST -->
	
	<!-- Resume -->
	<section id="resume" class="front-sections section-padding wow fadeIn" data-wow-delay="0.5s">
	   <div class="skt-page-overlay"></div>
	   <div class="skt-page-content">
	      <div class="container">
	         <div class="row">
	            <h2 id="title-page-59" class="section-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">Resume</h2>
	         </div>
	      </div>
	      <div class="container">
	         <div class="row">
	            <div class="resume-section">
	               <div class="row no-margin">
	                  <div class="col-md-12">
	                     <div class="resume-title">
	                        <h3>experience</h3>
	                     </div>
	                     <div class="resume">
	                        <ul class="timeline">
	                           <li>
	                              <div class="posted-date">
	                                 <span class="month">2015 - 2016</span>
	                              </div>
	                              <!-- /posted-date -->
	                              <div class="timeline-panel wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	                                 <div class="timeline-content">
	                                    <div class="timeline-heading">
	                                       <h3>LEAD UX CONSULTANT</h3>
	                                       <span>Lucky8 Designing Firm, California
	                                       </span>
	                                    </div>
	                                    <!-- /timeline-heading -->
	                                    <div class="timeline-body">
	                                       <p>Completely provide access to seamless manufactured products before functionalized synergy. Progressively redefine competitive.</p>
	                                    </div>
	                                    <!-- /timeline-body -->
	                                 </div>
	                                 <!-- /timeline-content -->
	                              </div>
	                              <!-- /timeline-panel -->
	                           </li>
	                           <li class="timeline-inverted">
	                              <div class="posted-date">
	                                 <span class="month">2013 - 2015</span>
	                              </div>
	                              <!-- /posted-date -->
	                              <div class="timeline-panel wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	                                 <div class="timeline-content">
	                                    <div class="timeline-heading">
	                                       <h3>JUNIOR UI DESIGNER</h3>
	                                       <span>XYZ Design Home, One Street, Boston</span>
	                                    </div>
	                                    <!-- /timeline-heading -->
	                                    <div class="timeline-body">
	                                       <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend.</p>
	                                    </div>
	                                    <!-- /timeline-body -->
	                                 </div>
	                                 <!-- /timeline-content -->
	                              </div>
	                              <!-- /timeline-panel -->
	                           </li>
	                        </ul>
	                     </div>
	                  </div>
	               </div>
	               <div class="row no-margin">
	                  <div class="col-md-12">
	                     <div class="resume-title">
	                        <h3>education</h3>
	                     </div>
	                     <div class="resume">
	                        <ul class="timeline">
	                           <li>
	                              <div class="posted-date">
	                                 <span class="month">2009 - 13</span>
	                              </div>
	                              <!-- /posted-date -->
	                              <div class="timeline-panel wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	                                 <div class="timeline-content">
	                                    <div class="timeline-heading">
	                                       <h3>BACHELOR DEGREE CERTIFICATE</h3>
	                                       <span>BA(Hons) in UI Engineering, Arts University, Pabna, USA
	                                       </span>
	                                    </div>
	                                    <!-- /timeline-heading -->
	                                    <div class="timeline-body">
	                                       <p>I have completed UI Engineering degree from ABC University, Boston, USA at feel the charm of existence in this spot, which was creat.</p>
	                                    </div>
	                                    <!-- /timeline-body -->
	                                 </div>
	                                 <!-- /timeline-content -->
	                              </div>
	                              <!-- /timeline-panel -->
	                           </li>
	                           <li class="timeline-inverted">
	                              <div class="posted-date">
	                                 <span class="month">2008 - 2009</span>
	                              </div>
	                              <!-- /posted-date -->
	                              <div class="timeline-panel wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	                                 <div class="timeline-content">
	                                    <div class="timeline-heading">
	                                       <h3>HIGHER SECONDARY CERTIFICATE</h3>
	                                       <span>Typography Arts, FA College, New York, USA</span>
	                                    </div>
	                                    <!-- /timeline-heading -->
	                                    <div class="timeline-body">
	                                       <p>From this college of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend.</p>
	                                    </div>
	                                    <!-- /timeline-body -->
	                                 </div>
	                                 <!-- /timeline-content -->
	                              </div>
	                              <!-- /timeline-panel -->
	                           </li>
	                           <li>
	                              <div class="posted-date">
	                                 <span class="month">2006 - 2007</span>
	                              </div>
	                              <!-- /posted-date -->
	                              <div class="timeline-panel wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	                                 <div class="timeline-content">
	                                    <div class="timeline-heading">
	                                       <h3>SECONDARY SCHOOL CERTIFICATE</h3>
	                                       <span>Creative Arts, Julius Jr. school, USA</span>
	                                    </div>
	                                    <!-- /timeline-heading -->
	                                    <div class="timeline-body">
	                                       <p>I was awesome at arts, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy.</p>
	                                    </div>
	                                    <!-- /timeline-body -->
	                                 </div>
	                                 <!-- /timeline-content -->
	                              </div>
	                              <!-- /timeline-panel -->
	                           </li>
	                        </ul>
	                     </div>
	                  </div>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</section>

    <?php  if(isset($blogs)) : if (count($blogs)) :?>
    <!-- Q&A -->
    <section id="qna" class="wow bounceInLeft" data-wow-delay="0.8s">
        <div class="container">
            <h2 class="highlight">Q&A</h2>
            <div id="sliderQA" class="row owl-carousel owl-theme">
                <?php foreach ($blogs as $blog) : ?>
                <div class="item item-padding">
                    <h4 class="blog-title">
                        {!! link_to('blog/' . $blog['slug'], $blog['title'], ['class' => '']) !!}
                    </h4>
                    <p><?php echo $blog['summary']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- end qa -->
    <?php endif; endif; ?>

	<!-- OUR CUSTOMERS LOVE US -->
    <div class="box-customer box-center">
        <div class="container">
            <div class="row">
	            <h2>OUR CUSTOMERS LOVE US</h2>
                <div class="col-md-2">
                    <div class="tp-widget-review">
                        <h4>Great</h4>
                        <div class="tp-widget-stars clearfix">
                            <div class="star-rating small star-5">
                                <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                            </div>
                        </div>
                        <div class="text"> Based on 3,151 reviews
                            See some of the reviews here.</div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div id="review_customer"  class="owl-carousel owl-theme">
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                        <div class="tp-widget-review item">
                            <div class="tp-widget-stars clearfix">
                                <div class="star-rating small star-5">
                                    <div class="star-1"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-2"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-3"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-4"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                    <div class="star-5"><img src="{!!url('/uploads/commons/sprite_star.png')!!}" width="9" height="9"></div>
                                </div>
                            </div>
                            <div class="date">42 hours ago</div>
                            <div class="header">Highly recommend!</div>
                            <div class="text"> Prompt, cost effective and trustworthy!</div>
                            <div class="name">P Mcdonnell</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- OUR CUSTOMERS LOVE US -->


	<footer id="footer">
        <div class="container">
            <div id="footer-links">
                <div class="row">
                    <section  class="col-md-3">
                        <h3 class="blue-text">Company</h3>
                        <div class="content">
                            <ul class="menu">
                                <li class="first leaf"><a href="" title="How Xendpay Works">How Xendpay Works</a></li>
                                <li class="leaf"><a href="" title="About Us">About Us</a></li>
                                <li class="leaf"><a href="" title="Customer Reviews">Customer Reviews</a></li>
                                <li class="leaf"><a href="" title="Security">Security</a></li>
                                <li class="last leaf"><a href="" title="Compare Our Rates">Compare Our Rates</a></li>
                            </ul>
                        </div>
                        <!-- /.content -->
                    </section>
                    <!-- /.block -->
                    <section  class="col-md-3">
                        <h3 class="blue-text">Transfers</h3>
                        <div class="content">
                            <ul class="menu">
                                <li class="first leaf"><a href="" title="Destinations">Destinations</a></li>
                                <li class="leaf"><a href="" title="Delivery Times">Delivery Times</a></li>
                                <li class="leaf"><a href="" title="Payment methods">Payment methods</a></li>
                                <li class="leaf"><a href="" title="Required Bank Details">Required Bank Details</a></li>
                                <li class="last leaf"><a href="" title="">Refer a Friend</a></li>
                            </ul>
                        </div>
                        <!-- /.content -->
                    </section>
                    <!-- /.block -->
                    <section  class="col-md-3">
                        <h3 class="blue-text">Contact Us</h3>
                        <div class="content">
                            <ul class="menu">
                                <li class="first leaf"><a href="" title="General Enquiries">General Enquiries</a></li>
                                <li class="leaf"><a href="" title="Your Feedback">Your Feedback</a></li>
                                <li class="last leaf"><a href="" title="affiliates">Affiliates</a></li>
                            </ul>
                        </div>
                        <!-- /.content -->
                    </section>
                    <!-- /.block -->
                    <section  class="col-md-3">
                        <h3 class="blue-text">Legal</h3>
                        <div class="content">
                            <ul class="menu">
                                <li class="first leaf"><a href="" title="Regulatory Information">Regulatory Information</a></li>
                                <li class="leaf"><a href="" title="Privacy Policy">Privacy Policy</a></li>
                                <li class="last leaf"><a href="" title="Terms of Use">Terms of Use</a></li>
                            </ul>
                        </div>
                        <!-- /.content -->
                    </section>
                </div>
            </div>
            <div id="footer-copyright-social">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="footer-copyright-text" class="white-text">©<?php echo date('Y') ?> Copyright Rational Foreign Exchange.</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="footer-text-1" class="white-text">Xendpay is an agent of Rational Foreign Exchange Limited, authorised and regulated by the Financial Conduct Authority (FCA) under the Payment Services Regulations 2008 - FRN No. 507958</div>
                                <div id="footer-text-2" class="white-text">Rational Foreign Exchange is a registered money services business with HM Revenue and Customs - No. 12206957</div>
                                <div id="footer-text-2" class="white-text">Xendpay, Level 32, One Canada Square, Canary Wharf, London, E14 5AB, U.K</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="social-box">
                            <ul class="social-icons pull-right">
                                <li class="facebook"><a href="" target="_blank" class="white-text" title="Facebook">facebook</a></li>
                                <li class="youtube"><a href="" target="_blank" class="white-text" title="Youtube">Youtube</a></li>
                                <li class="google"><a href="" target="_blank" class="white-text" title="Google">Google</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</footer>


	<a id="back-to-top" href="#" class="back-to-top" role="button" title="Click lên đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

	{!! HTML::script('js/plugins.js') !!}
	{!! HTML::script('js/main.js') !!}

    {!! HTML::script('https://nadiaschutz.github.io/landing_page-1/js/wow.min.js') !!}
    <script>
        new WOW().init();
    </script>

	<script>
        $(document).ready(function(){
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('#back-to-top').tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

            $('#back-to-top').tooltip('show');

        });
	</script>
	@yield('scripts')
  </body>
</html>