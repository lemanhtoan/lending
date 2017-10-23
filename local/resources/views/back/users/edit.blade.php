@extends('back.template')

@section('main')

	<!-- Entête de page -->
	@include('back.partials.entete', ['title' => trans('back/users.dashboard'), 'icone' => 'user', 'fil' => link_to('user', trans('back/users.Users')) . ' / ' . trans('back/users.edition')])

	<div class="col-sm-12">
		{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
			{!! Form::control('text', 0, 'username', $errors, trans('back/users.name')) !!}
			{!! Form::control('email', 0, 'email', $errors, trans('back/users.email')) !!}
			{!! Form::selection('role', $select, $user->role_id, trans('back/users.role')) !!}
			{!! Form::checkHorizontal('confirmed', trans('back/users.confirmed'), $user->confirmed) !!}

			<div class="form-group">
				<label for="role" class="control-label">Kiểu người dùng</label>

				<select class="form-control"  name="usertype" id="usertype" required>
					<option value="">Kiểu người dùng</option>
					<option <?php if($user->usertype == '0') {echo 'selected';}else{echo '';}?> value="0">Administrator</option>
					<option <?php if($user->usertype == '1') {echo 'selected';}else{echo '';}?> value="1">NĐT đặc biệt </option>
					<option <?php if($user->usertype == '2') {echo 'selected';}else{echo '';}?> value="2">Nhà đầu tư</option>
					<option <?php if($user->usertype == '3') {echo 'selected';}else{echo '';}?> value="3">Người đi vay</option>
				</select>

			</div>

			<div class="form-group">
				<label for="role" class="control-label">Trạng thái</label>

				<select class="form-control"  name="activated" id="activated" required>
					<option value="">Trạng thái</option>
					<option <?php if($user->activated == '1') {echo 'selected';}else{echo '';}?>  value="1">Hoạt động</option>
					<option <?php if($user->activated == '0') {echo 'selected';}else{echo '';}?>  value="0">Khóa</option>
				</select>

			</div>

			{!! Form::submit(trans('front/form.send')) !!}
		{!! Form::close() !!}
	</div>

@stop