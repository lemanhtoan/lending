@extends('back.template')

@section('head')

	{!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') !!}

@stop

@section('main')

	<!-- Entête de page -->
	@include('back.partials.entete', ['title' => 'Manager slideshow', 'icone' => 'pencil', 'fil' => link_to('slideshow', trans('back/blog.posts')) . ' / ' . trans('back/blog.creation')])

	<div class="col-sm-12">
		@yield('form')

		{!! Form::control('text', 0, 'title', $errors, 'Title') !!}

		{!! Form::control('text', 0, 'link', $errors, 'Link') !!}

		{!! Form::control('file', 0, 'image', $errors, 'Image') !!}

		<?php if (isset($post['image'])) :?>
			<p><img src="{!! asset('uploads/files/' . $post['image']) !!}"  width="400px"/> </p>
		<?php endif; ?>

		{!! Form::control('number',  0, 'position', $errors, 'Position') !!}

		<div class="form-group">
			<label for="input-id">Trạng thái</label>
			<select name="status" class="form-control">
				<option value="1" <?php if (isset($post['status']) && $post['status'] == '1') {echo 'selected';} else {echo '';}?>>Hoạt động</option>
				<option value="0" <?php if (isset($post['status']) && $post['status'] == '0') {echo 'selected';}  else {echo '';}?>>Khoá</option>
			</select>
		</div>

		{!! Form::submit(trans('front/form.send')) !!}

		{!! Form::close() !!}
	</div>

@stop

@section('scripts')

@stop