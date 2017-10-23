@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/register.title') }}</h2>
				<hr>
				<p>{{ trans('front/register.infos') }}</p>		

				<div class="text-center  link-login">

					{!! link_to('redirect/facebook', '', ['class' => 'fb-link fa fa-facebook']) !!}
					{!! link_to('redirect/google', '', ['class' => 'gg-link fa fa-google']) !!}

				</div>

				{!! Form::open(['url' => 'auth/register', 'method' => 'post', 'role' => 'form']) !!}	

					<div class="row">
						{!! Form::control('text', 6, 'username', $errors, trans('front/register.pseudo'), null, [trans('front/register.warning'), trans('front/register.warning-name')]) !!}
						{!! Form::control('email', 6, 'email', $errors, trans('front/register.email')) !!}
					</div>
					<div class="row">	
						{!! Form::control('password', 6, 'password', $errors, trans('front/register.password'), null, [trans('front/register.warning'), trans('front/register.warning-password')]) !!}
						{!! Form::control('password', 6, 'password_confirmation', $errors, trans('front/register.confirm-password')) !!}
					</div>
					{!! Form::text('address', '', ['class' => 'hpet']) !!}	

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label for="sel1">User type:</label>
							  <select class="form-control" id="usertype" name="usertype" required="">
							  	<option value="">Chọn kiểu người dùng</option>
							    <option value="2">Nhà đầu tư</option>
							    <option value="3">Người vay tiền</option>
							  </select>
							</div>
						</div>
					</div>

					<div class="row">	
						{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
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