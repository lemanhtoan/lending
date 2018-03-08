@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/site.confirmAccount') }}</h2>
				<hr>
				<?php
					if(isset($mess) && $mess=='INVALID_DATA') {?>
					<div class="alert alert-warning">
						<strong>{{ trans('front/site.INVALID_DATA') }}</strong>
					</div>
				<?php }
				?>
				{!! Form::open(['url' => 'confirmUser', 'method' => 'post', 'role' => 'form']) !!}
				
					<div class="row">
						<div class="form-group col-lg-12 ">
							<label for="email" class="control-label">{!! trans('front/site.emailUser') !!}</label>
							<input class="form-control user-success" placeholder="" name="email" type="text" id="email" required="">
						</div>
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
						<input type="hidden" name="uId" value="<?php echo $userData->id;?>">
					  	{!! Form::submit(trans('front/form.send'), ['col-lg-12 l-btn']) !!}

					</div>
					
				{!! Form::close() !!}

			</div>
		</div>
	</div>
@stop