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

  <body>

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header role="banner">
		<div class="top-header">
			<div class="container">
				<div class="col-md-2">
					<div class="brand">{!! link_to('/', trans('front/site.title')) !!}</div>
				</div>
				<div class="col-md-10">
					<div class="bottom-header">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container">
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
											{!! link_to('/', trans('front/site.home')) !!}
										</li>
										<li>
											{!! link_to('/', trans('front/site.about-us')) !!}
										</li>
										<li>
											{!! link_to('/', trans('front/site.loan-payment')) !!}
										</li>
										<li {!! classActiveSegment(1, ['articles', 'blog']) !!}>
											{!! link_to('articles', trans('front/site.QA')) !!}
										</li>
										<li {!! classActivePath('contact/create') !!}>
											{!! link_to('contact/create', trans('front/site.contact')) !!}
										</li>
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>		

		<div class="bottom-header">
			<div class="box-left">
				<ul>
					<?php if(!Auth::check())  {?>
						<li class="">
							{!! link_to('auth/register', trans('front/site.register')) !!}
						</li>
				
						<li class="">
							{!! link_to('password/email', trans('front/site.forget-password')) !!}
						</li>
					
						<li {!! classActivePath('auth/login') !!}>
							{!! link_to('auth/login', trans('front/site.connection')) !!}
						</li>
					<?php } else {  //echo "<pre>"; var_dump(Auth::user()->usertype); ?>
						<!-- 1: ndt dacbiet, 2: ndt, 3: nguoivay-->
						<li>
							{!! link_to_route('admin', trans('front/site.administration')) !!}
						</li>
					
						<li>
							{!! link_to('blog', trans('front/site.redaction')) !!}
						</li>
						
						<li>
							{!! link_to('auth/logout', trans('front/site.logout')) !!}
						</li>
					<?php } ?>
				</ul>
			</div>
		
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" />&nbsp; <b class="caret"></b></a>
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
	<section class="info-section how-it-works text-center">
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
	<h4>TAB REALTIME COST</h4>
	<!-- TAB REALTIME COST -->
	
	<!-- Resume -->
	<section id="page-59" class="front-sections section-padding ">
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

	<!-- OUR CUSTOMERS LOVE US -->
	<h4>OUR CUSTOMERS LOVE US</h4>
	<!-- OUR CUSTOMERS LOVE US -->


	<div id="homeStatics">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="item-statics">
						<h4>999.999 +</h4>
						<p>Borrower</p>
					</div>

					<div class="item-statics">
						<h4>999.999 +</h4>
						<p>Investor</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="item-statics">
						<h4><img src="https://remitano.com/playstore.png" alt=""></h4>
						<p>Download Android App</p>
					</div>

					<div class="item-statics">
						<h4><img src="https://remitano.com/appstore.png" alt=""></h4>
						<p>Download IOS App</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer role="contentinfo">
		 @yield('footer')
		<p class="text-center"><small>Copyright &copy;2017 - Coin Cash Loan</small></p>
	</footer>


	<a id="back-to-top" href="#" class="back-to-top" role="button" title="Click lên đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

	{!! HTML::script('js/plugins.js') !!}
	{!! HTML::script('js/main.js') !!}

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
	<style>
		/* ========================back to top button ==================*/
		.back-to-top {
			cursor: pointer;
			position: fixed;
			bottom: 20px;
			right: 20px;
			display:none;
			font-style: normal;
			border-radius: 50%;
			height: 50px;
			width: 50px;
			font-size: 22px;
			padding: 11px 15px;
			color: #fff;
			background: #434345;
			border: none;
			box-shadow: 4px 4px 8px 0 rgba(0,0,0,0.4);
		}
		.back-to-top:hover {
			background: #ff7e00;
		}
	</style>
  </body>
</html>