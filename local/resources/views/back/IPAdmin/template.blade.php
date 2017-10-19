@extends('back.template')

@section('head')

	{!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') !!}

@stop

@section('main')

	<!-- Entête de page -->
	@include('back.partials.entete', ['title' => 'List IP address', 'icone' => 'pencil', 'fil' => link_to('IPAdmin', trans('back/blog.posts')) . ' / ' . trans('back/blog.creation')])

	<div class="col-sm-12">
		@yield('form')

		{!! Form::control('text', 0, 'ip', $errors, 'IP address') !!}

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