@extends('front.template-blog')

@section('head')

  {!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css') !!}

@stop

@section('main')
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>
				<h2 class="text-center">{{ $post->title }}
				</h2>
				<hr>
				{!! $post->summary !!}<br>
				{!! $post->content !!}
			</div>
		</div>
	</div>


</div>

@stop

@section('scripts')


@stop
