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
				<div class="col-md-3">
					<div class="brand-logo">
						<?php $dataLogo = DB::table('settings')->where('name', 'dataLogo')->select('content')->get()[0]; ?>
						<h1><a href="{!! url('/') !!}"><img class="logo" src="{!!url('/uploads/commons/'.$dataLogo->content )!!}" alt="{!! trans('front/site.title') !!}"/></a></h1>
                    </div>
				</div>
				<div class="col-md-9">
					<div class="bottom-header">
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
						</nav>
					</div>
				</div>
			</div>
		</div>		

		<div class="bottom-header">
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
                                    {!! link_to('blog', trans('front/site.redaction')) !!}
                                </li>

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
        @yield('main')
    </main>


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
                                <li class="facebook"><a href="" target="_blank" class="white-text" title="Facebook"><img src="{!!url('/uploads/commons/fb.png')!!}"/></a></li>
                                <li class="youtube"><a href="" target="_blank" class="white-text" title="Youtube"><img src="{!!url('/uploads/commons/yt.png')!!}"/></a></li>
                                <li class="google"><a href="" target="_blank" class="white-text" title="Google"><img src="{!!url('/uploads/commons/gg.png')!!}"/></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</footer>


	<a id="back-to-top" href="#" class="back-to-top" role="button" title="{{ trans('front/site.totop') }}" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

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

            
            var owlSlider = jQuery("#owl-homeslider");
            owlSlider.owlCarousel({
                items : 1,
                rtl:true,
                stopOnHover: true,
                pagination: false,
                navigation: true,
                lazyLoad: true,
                slideSpeed: 800,
                autoPlay: true,
                autoPlaySpeed: 3000,
                autoHeight: true,
                navigationText: [
                    "<i class='fa fa-chevron-left'></i>",
                    "<i class='fa fa-chevron-right'></i>"
                ],
            });

            var owlReview = jQuery("#review_customer");
            owlReview.owlCarousel({
                items : 4,
                rtl:true,
                stopOnHover: true,
                pagination: false,
                navigation: true,
                lazyLoad: true,
                slideSpeed: 800,
                autoPlay: true,
                autoPlaySpeed: 3000,
                autoHeight: true,
                navigationText: [
                    "<i class='fa fa-chevron-left'></i>",
                    "<i class='fa fa-chevron-right'></i>"
                ],
            });

            var owlQA = jQuery("#sliderQA");
            owlQA.owlCarousel({
                items : 4,
                rtl:true,
                stopOnHover: true,
                pagination: false,
                navigation: true,
                lazyLoad: true,
                slideSpeed: 800,
                autoPlay: true,
                autoPlaySpeed: 3000,
                autoHeight: true,
                navigationText: [
                    "<i class='fa fa-chevron-left'></i>",
                    "<i class='fa fa-chevron-right'></i>"
                ],
            });

            jQuery('#accountForm')
            .formValidation({
                framework: 'bootstrap',
                excluded: [':disabled'],
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    cost: {
                        validators: {
                            notEmpty: {
                                message: 'The cost is required'
                            }
                        }
                    },

                    methodPay: {
                        validators: {
                            notEmpty: {
                                message: 'The method Pay is required'
                            }
                        }
                    },

                    invest_cost: {
                        validators: {
                            notEmpty: {
                                message: 'The invest-cost  is required'
                            }
                        }
                    },

                    invest_month: {
                        validators: {
                            notEmpty: {
                                message: 'The invest-month is required'
                            }
                        }
                    }

                }
            })
            .on('err.field.fv', function(e, data) {
                var $invalidFields = data.fv.getInvalidFields().eq(0);

                var $tabPane     = $invalidFields.parents('.tab-pane'),
                    invalidTabId = $tabPane.attr('id');

                if (!$tabPane.hasClass('active')) {
                    $tabPane.parents('.tab-content')
                        .find('.tab-pane')
                        .each(function(index, tab) {
                            var tabId = jQuery(tab).attr('id'),
                                $li   = jQuery('a[href="#' + tabId + '"][data-toggle="tab"]').parent();

                            if (tabId === invalidTabId) {
                                jQuery(tab).addClass('active');
                                $li.addClass('active');
                            } else {
                                jQuery(tab).removeClass('active');
                                $li.removeClass('active');
                            }
                        });

                    $invalidFields.focus();
                }
            });

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