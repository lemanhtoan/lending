@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center">Confirm invest</h2>
				<hr>
				<p>Please enter hash key to confirm invest</p>				
				
				{!! Form::open(['url' => 'confirmInvest', 'method' => 'post', 'role' => 'form']) !!}	
				
					<div class="row">

						{!! Form::control('text', 12, 'keyHash', $errors, 'Hash key') !!}
						<input type="hidden" name="investId" value="<?php echo $id;?>">

					  	{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}

					</div>
					
				{!! Form::close() !!}

			</div>
		</div>
	</div>
@stop