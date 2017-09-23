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
					<div class="brand">{!! link_to('/', trans('front/site.title')) !!}</div>
				</div>
				<div class="col-md-7">
					<div class="box-inline">
						<div class="box-left">
							<span>email: abcdef@gmail.com</span>
						</div>
						<div class="box-left">
							<span>hotline: 9999.9999</span>
						</div>
						<div class="box-left">
							@if(Request::is('auth/register'))
								<li class="active">
									{!! link_to('auth/register', trans('front/site.register')) !!}
								</li>
							@elseif(Request::is('password/email'))
								<li class="active">
									{!! link_to('password/email', trans('front/site.forget-password')) !!}
								</li>
							@else
								@if(session('statut') == 'visitor')
									<li {!! classActivePath('auth/login') !!}>
										{!! link_to('auth/login', trans('front/site.connection')) !!}
									</li>
								@else
									@if(session('statut') == 'admin')
										<li>
											{!! link_to_route('admin', trans('front/site.administration')) !!}
										</li>
									@elseif(session('statut') == 'redac')
										<li>
											{!! link_to('blog', trans('front/site.redaction')) !!}
										</li>
									@endif
									<li>
										{!! link_to('auth/logout', trans('front/site.logout')) !!}
									</li>
								@endif
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-2">
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
			</div>
		</div>

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

		{{--@yield('header')	--}}
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

	<div id="knowladge">
		<div class="container">
			<h3>Kiến thức tài chính</h3>
			<ul id="owl-knowladge" class="owl-carousel owl-theme">
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARgAAACgCAMAAADgvoMSAAAAgVBMVEX///8AAADo6Oj8/Pz39/fs7Oz6+vrm5uZ3d3fNzc3v7++kpKTQ0NDZ2dkcHBw0NDQ6Ojq9vb2RkZG3t7eBgYETExO/v7/Y2NhZWVkrKytoaGggICBtbW1eXl6Li4uvr69ERERLS0uZmZlQUFCfn5+EhIQLCwslJSU+Pj57e3sQEBAACWA3AAALRElEQVR4nO1c6ZqiOhAlEojsCIIsyube7/+AN1UVXMae0fnuTOvYOX9cmgg5qdSeNgwNDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDY23ghWYj17qBtbffJInYhJMbr7zjvyxwemyj7rK+z/3t2cP3usrwZ2CAcrpTLhnIXFZ+tBwK2KE/cyWo+xHxpjXb2yfLV+PGPfIzlgN6cKCZ3SdaPvQcKc8j5476eDeH2LPcnVrT8BLMGds+nLEuFN2jbg6NkNTfXTcsO7PclGWw1Dt1NgwXty/o9iygcZOmbxcJAf2isR4jEWHiN0gEobfOfdG864SpsmtlRr1AC+5vBnqoybC6z0c+HLE5OUctILteMdDmZ1o2R25mbBdcG94z3x6k+KOmt29n7+G6zzDpAFwg/YVieHHLek/07csJ52yMmK7LFq19kIKQXaPGId9jFw4MWPJXftubzIixt2ykRjxisRYU1px61hJPegsszbdtY5vmRtY0HvEcGnO1kJ98NnqAcXL50SM4a5PxNQvSIyJJkiq0D4w7HnNYrFg4KvZDfsZMRczyPegjMaLvPxn111a8TQkYgxkCFi9JeZhx/JvI2W1VLMg3PHEZ+jqoTpFYniTXjxosGRnudiQQkpuJcX2i/D8iQ9sjWrZmrgtEDO4ExepdyzBRXhNjDiyu0r/a5DWLJEv7JIYe07E8FyKfDM+tRjk6lZq9a3AU6p6/aPSDcA3SsZPOZC89zhISfiBur3OQjTxWcha94oY4ck/FH93wg/Cl+oEts8VMSYSI8QRlSX5Ha7Xo7OiaJjM/JNzl1zGSmJA81+S+uJNrdw/IfdejEPqLjqEeE25mkwuiOF0C9Z+2ex/Aelf9fB6S8yu6tb4/AweOz2wcgEfCoqr+NwfRUb+wln6NxGr0pOlkfbZy4maIpAuI20lbvEtbSXXuNhKTs96HHoQPz7l16NVyvATYtjBVS5/btiwH2pSmcos+6XwwhM1KuScgB+7NCpad1DitVTK5BuDHMxG5ZucrNJIDIcNuDbxD4/FI38TvMd5G58SI5/bLIgYAdsjMwRcHpJ4mF648KsTMxWaJwcsVYX7U9o4NyZiTAw8ICpNf06MAAu+di24RT17tmlCMUeT0d8QE8JzV0QMSkImBWx31qtmylqRnrcT/AxKWGXQuuduJ38F+XiEGFiD3jVS0GvJsx2bgY3ELG+IyS6IEYoYY3ppn53oEFinMLRzT8SAA5e1NhIDSjj/eJwYQ+6/7QPO4l+FiToQ7cf2IWImxVVoKV2Uyg3G/dSdiVnEUtcaVhQWAkKx6DckZlLtn+/IcFxuNMDJfWL2RhpNf1jLxbIeJl5MzDhEzFSapgZ/PoGfFsdu+qjEFPasqF7AJhExG3gLT3pwf0oMTH3fdO1Nis7Oi9gJKAtYETHFvFfxAahQL96Kx7dSw9pnqxcAmkjyNI+04tee7zUxbPXpWvJUeiaYkultMu/zs1gFXSljinT3IDGsfwFxAeDzgQPHWbgE5Yle8C+UL2IUGxEIpIAXS/uAGgLt9Er92TSElMi5FJtrYjbGT4mJFKXms8WGnFfPcLoKpd/5lblmqpbgkHLkXsTqIgUmeTOAV9xzJKYkJ8Ty0EuCSZ+IQQdvbihi4HcwuoY1saqThZS3mH8hCZ8hQHvRLxq1sy+3ElorRQzH/Ak5MAFZDXsgjYuM8q2oQFRQsshjNIYDh0lDymYGOmZjqlRFbCg/ATT0BKg8yDWwUd8RIaLPjCeD0rXDKLlqK6HxxvlVamVRGZXAiF/Tw+djKjQ8yk9BvkXzhoqiA1lL9oGL+a5cCWbBIfXDUHbQv2WRb+QWjpgaZo6LgTf1s+a20PXFEDS5sYhEEjMEuKBrQxEjlO8qv9qWKrXLz9EAi30TFhyUOCkt1q9AUlykfZcsKZheb3xT5c13jRo6N5TgsRbDCbhFzP5X+e4PgZ4wa0kvADHcqwX65RAuwvQj+MtBPf9K5b8X7ALZIMQhBjmxRjmCNTfHXJZY0qtrzPBNNCPGd1vb8KlI0Z6p7p/v4Em4SzURVHv+joujjBKtAwk4bjVULWo9mzH1MrBVMsz7kZqiiGg6JFo1rXnQAWueaTg1vMJXoElgSwYwFHJgJgT4Owi9BeUnti9iscdgp1xuHCkpyxqceZzfkqPSVdkRR04yyk8O3sbhtsldMS7zblzmXKqRtT9+2JNiklqmJpUMJT4MxCUzRxLTdExNAVlZ+uzA+oxZfC4phWvltCYZuBtBzPbjJM30U6eUQqXwnDnn7UWuk7dKxGbnn1GXTjbjRc6YSDdz79kOzBWs9lhEdVh3VZOP62U78IjS7/DuraCbKHv1jrCF7zjOTZ+L2bDhgQaG42tkab8QQf1QknHSvIi+/CqIvnn2I7wkrH77UqrwZbAYNC+fwnwdj+Jfg/vspPULgE+EdSNB3ncz0zcINtNVUW2H9Ko1xFrnPxvwTbAZ2/TCeN04J5VcLp/5UC+AJbtGv/VmTpqwtTX7Zp7dNTwpKIfog/2IWARl5Hxfkx7sj85i4efD9HDFS7GALFf8fQ1Tsh6tkeV401O3UDOBvGj5fXkJeoq5+bB3oUSXeUk2TTA107HpN/YB3ZRaO1fxwuBeydaThdo+AUseOlQB4BcMWo4PP/AenPpxmBv2sGNsZTmR6jZzRKt20kTl9f0xeRdcZyid5SmTZebVPlrmRnu38fxfgBOzrUlncM7EGIs15MsN7J5DZrwyo0RFfviYnrNeltRMK0WUScdd6r56eunoD8AvGRRHxO6CGFNgFj0wzAn2KXBzgZX/rSQMi2jFKE1Ua6LeT172CSrw+B0EBnoZQDTExwUx1EIiJYU6HWov6dA/3rdeTP0yGC8IL2IJlmGhPjMpavkCrXv3T2T8A4C6GYSL2JN72kqTtRIEgSY8TAKHHJ1j4Ku6q9xkcJGJJdqtDWcJdtBe5x5Xv77jP4KQUS3IKq90DBa4oRo3VW+oFwCarrAE2RmqxOsShzOsd+9AC/G3cH+wuAgzwfrkmZhmJAb06c4bS7JQLsI+mM5QYZZFdcwDHU56H6cQ28TBqLj958RMSdkoYsC5mdXXxECxv09V5fqyoPlPoxolhi8fIsZU/cOdcSamZdMAdC8xEz69j/dPgJqGIL+A57CKR4i5lhjXGJiHQhKModY7KF86jQYdNEjMyv1tYhZFNOZteKHq5NVT5vJHcW4zg62UpcZvE1Ne1GHMtqfd9AZZUdQx0CgmzXXvmHeJsX/UMdccCOpVeoWuqf8J9E5K37A75kEAdIeY4UZiVAA59gyY6ZsQQ01SR7FWleyfEkNNiM2luU7O+sSMZzzpVjMXGxvfonGEzumdSicjMcM4aWSoAUGBKLPiqm0VWlKR1Bo0t6gKOp0r/Rn7yN6iXYB6DE/d7EiM6bs5Trp1AnwTOy5HBzeb2RaZ5Za7E/LoGhliLl1H2eqED+FbeL9Wh/OJVUoFiUnXAZ6KY7vMt9TRz4BiorBLSWFnpWcolw4bEcf/AcG6t9hIBhw/wvnUOR3qjC2+gXAbQx9IOOEbbAEHiqKF6nY9SHMkqFaHPZ1svayoDPM2pV2nU25Z6gdiVno9Hryxt3C6XL5xIZ2Am2PDdpS6azNW4N6DFEQ2xU5QaFsL2mPJ5u8QERCCsRpZ9kXM9gOpXzdR5yOtrephNJsNTdpsE5W7nGym1O5pqdPV/vyB/6fyz4A7px75sD0VZvkYJp+qAPb4jXmKoG/O2PD3KBCc4bfD4H3jmqyGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhsaD+A/IQ6rd28bSdAAAAABJRU5ErkJggg==" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
				<li class="item">
					<div class="box-blog">
						<img src="data:image/png;base64,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" alt="">
						<h4><a href="">Postremo ad id indignitatis est ventum</a></h4>
					</div>
				</li>
			</ul>
			<script>
                jQuery(document).ready(function(){
                    var owlSlider = jQuery("#owl-knowladge");
                    owlSlider.owlCarousel({
                        items : 5,
                        rtl:true,
                        stopOnHover: true,
                        pagination: true,
                        navigation: true,
                        lazyLoad: true,
                        slideSpeed: 500,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        autoHeight: true,
                        navigationText: [
                            "<i class='fa fa-chevron-left'></i>",
                            "<i class='fa fa-chevron-right'></i>"
                        ],
                    });
                });
			</script>
		</div>
	</div>

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