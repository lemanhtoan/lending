@extends('front.template')

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center">{{ trans('front/site.confirmInvest') }}</h2>
				<hr>
                <?php if(isset($mess)): ?>
				<div class="alert alert-success">
					<h3>
						<?php if($mess =='TRAN_INVALID_BEFORE') { ?>
						{{ trans('front/site.TRAN_INVALID_BEFORE') }}
						<?php } ?>
						<?php if($mess =='TRAN_INVALID') { ?>
						{{ trans('front/site.TRAN_INVALID') }}
						<?php } ?>
						<?php if($mess =='TRAN_COMPLETED') { ?>
						{{ trans('front/site.TRAN_COMPLETED') }}
						<?php } ?>
					</h3>
				</div>
                <?php endif;?>

				<p>{{ trans('front/site.confirmInvestText') }}</p>				
				
				{!! Form::open(['url' => 'confirmInvest', 'method' => 'post', 'role' => 'form']) !!}	
				
					<div class="row">

						{!! Form::control('text', 12, 'keyHash', $errors, trans('front/site.hashKey') ) !!}
						<input type="hidden" name="investId" value="<?php echo $id;?>">

					  	{!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}

					</div>
					
				{!! Form::close() !!}

			</div>
		</div>
	</div>
@stop