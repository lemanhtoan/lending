	@foreach ($users as $user)
		<tr {!! !$user->seen? 'class="warning"' : '' !!}>
			<td class="text-primary"><strong>{{ $user->username }}</strong></td>
			<td>{{$user->email}}</td>
			<td>{{ $user->role->title }}</td>
			<td>
				<?php
					switch ($user->usertype) {
						case 0: $lbl = 'Administrator';
							break;
						case 1: $lbl = 'Nhà đầu tư đặc biệt';
							break;
						case 2: $lbl = 'Nhà đầu tư';
							break;
						case 3: $lbl = 'Người đi vay';
							break;
					}
					echo $lbl;
				?>
			</td>
			<td><?php if ($user->activated == '1') {echo 'Hoạt động';}else{echo 'Khóa';}?></td>
			<td>{!! link_to_route('user.show', trans('back/users.see'), [$user->id], ['class' => 'btn btn-success btn-block btn']) !!}</td>
			<td>{!! link_to_route('user.edit', trans('back/users.edit'), [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
			<td>
				{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
				{!! Form::destroy(trans('back/users.destroy'), trans('back/users.destroy-warning')) !!}
				{!! Form::close() !!}
			</td>
		</tr>
	@endforeach