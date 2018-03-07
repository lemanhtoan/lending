@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/register.title') }}</h2>
				<hr>
				{!! Form::open(['url' => 'auth/register', 'method' => 'post', 'role' => 'form']) !!}	

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							{!! Form::control('text', 12, 'username', $errors, trans('front/register.pseudo'), null, [trans('front/register.warning'), trans('front/register.warning-name')]) !!}
							{!! Form::control('email', 12, 'email', $errors, trans('front/register.email')) !!}
							{!! Form::control('password', 12, 'password', $errors, trans('front/register.password'), null, [trans('front/register.warning'), trans('front/register.warning-password')]) !!}
							{!! Form::control('password', 12, 'password_confirmation', $errors, trans('front/register.confirm-password')) !!}
							{!! Form::text('address', '', ['class' => 'hpet']) !!}
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="sel1">{{ trans('front/site.usertype') }}</label>
									<select class="form-control" id="usertype" name="usertype" required="">
										<option value="">{{ trans('front/site.choiceusertype') }}</option>
										<option value="2">{{ trans('front/site.investee') }}</option>
										<option value="3">{{ trans('front/site.borrower') }}</option>
									</select>
								</div>
							</div>
							{!! Form::submit(trans('front/form.send'), ['col-lg-12 l-btn']) !!}
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="text-center  link-login">
								<h5>{{ trans('front/login.or') }}</h5>
								{!! link_to('redirect/facebook', '', ['class' => 'fb-link fa fa-facebook']) !!}
								{!! link_to('redirect/google', '', ['class' => 'gg-link fa fa-google']) !!}
							</div>
						</div>
					</div>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
@stop

@section('scripts')

	<script>
		$(function() { $('.badge').popover();	});
	</script>

@stop