@extends('front.template')

@section('main')
	<div class="row">
		<div class="col-lg-12">
			<hr>
			<h2 class="intro-text text-center">{!! trans('front/site.message') !!}</h2>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<p>{{ $post->message }}</p>
			</div>
		</div>
	</div>


</div>

@stop

