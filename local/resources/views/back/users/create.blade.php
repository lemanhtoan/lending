@extends('back.template')

@section('main')

 <!-- Entête de page -->
  @include('back.partials.entete', ['title' => trans('back/users.dashboard'), 'icone' => 'user', 'fil' => link_to('user', trans('back/users.Users')) . ' / ' . trans('back/users.creation')])

	<div class="col-sm-12">
		{!! Form::open(['url' => 'user', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}	
			{!! Form::control('text', 0, 'username', $errors, trans('back/users.name')) !!}
			{!! Form::control('email', 0, 'email', $errors, trans('back/users.email')) !!}
			{!! Form::control('password', 0, 'password', $errors, trans('back/users.password')) !!}
			{!! Form::control('password', 0, 'password_confirmation', $errors, trans('back/users.confirm-password')) !!}
			{!! Form::selection('role', $select, null, trans('back/users.role')) !!}

			<div class="form-group">
				<label for="role" class="control-label">Kiểu người dùng</label>

				<select class="form-control"  name="usertype" id="usertype" required>
					<option value="">Kiểu người dùng</option>
					<option value="0">Administrator</option>
					<option value="1">NĐT đặc biệt </option>
					<option value="2">Nhà đầu tư</option>
					<option value="3">Người đi vay</option>
				</select>

			</div>

			<div class="form-group">
				<label for="role" class="control-label">Trạng thái</label>

				<select class="form-control"  name="activated" id="activated" required>
					<option value="">Trạng thái</option>
					<option value="1">Hoạt động</option>
					<option value="0">Khóa</option>
				</select>

			</div>

			{!! Form::submit(trans('front/form.send')) !!}
		{!! Form::close() !!}
	</div>

@stop