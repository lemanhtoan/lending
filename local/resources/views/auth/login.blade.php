@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				@if(session()->has('error'))
					@include('partials/error', ['type' => 'danger', 'message' => session('error')])
				@endif	
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/login.connection') }}</h2>
				<hr>
				<p>{{ trans('front/login.text') }}</p>				
				
				{!! Form::open(['url' => 'auth/login', 'method' => 'post', 'role' => 'form']) !!}	
				
				<div class="row">

					{!! Form::control('text', 6, 'log', $errors, trans('front/login.log')) !!}
					{!! Form::control('password', 6, 'password', $errors, trans('front/login.password')) !!}
					{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
					{!! Form::check('memory', trans('front/login.remind')) !!}
					{!! Form::text('address', '', ['class' => 'hpet']) !!}		  
					<div class="col-lg-12">					
						{!! link_to('password/email', trans('front/login.forget')) !!}
					</div>

				</div>
				
				{!! Form::close() !!}

				<div class="text-center link-login">
					{!! link_to('redirect/facebook', '', ['class' => 'fb-link fa fa-facebook']) !!}
					{!! link_to('redirect/google', '', ['class' => 'gg-link fa fa-google']) !!}
					{!! link_to('auth/register', trans('front/login.registering'), ['class' => 'register-link']) !!}
				</div>

			</div>
		</div>
	</div>
@stop

