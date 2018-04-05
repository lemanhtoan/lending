@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<!--
				@if(session()->has('error'))
					@include('partials/error', ['type' => 'danger', 'message' => session('error')])
				@endif	
				-->
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/login.connection') }}</h2>
				<hr>
				{!! Form::open(['url' => 'auth/login', 'method' => 'post', 'role' => 'form']) !!}
				
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						{!! Form::control('text', 12, 'log', $errors, trans('front/login.log')) !!}
						{!! Form::control('password', 12, 'password', $errors, trans('front/login.password')) !!}
						<div class="col-md-6 pl15">{!! Form::check('memory', trans('front/login.remind')) !!}</div>
						<div class="col-md-6 box-right">
							{!! link_to('password/email', trans('front/login.forget')) !!}
							{!! link_to('auth/register', trans('front/login.registering'), ['class' => 'register-link']) !!}
						</div>
						{!! Form::submit(trans('front/form.send'), ['col-lg-12 l-btn box-center']) !!}
						{!! Form::text('address', '', ['class' => 'hpet']) !!}
					</div>
					<p>&nbsp;</p>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="text-center link-login">
							<h5>{{ trans('front/login.or') }}</h5>
							{!! link_to('redirect/facebook', '', ['class' => 'fb-link fa fa-facebook']) !!}
							{!! link_to('redirect/google', '', ['class' => 'gg-link fa fa-google']) !!}
						</div>
					</div>
				</div>
				
				{!! Form::close() !!}


			</div>
			<div class="col-md-3 col-lg-3"></div>
		</div>
	</div>
@stop

