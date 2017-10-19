@foreach ($admin_ip as $post)
  <tr >
    <td class="text-primary"><strong>{{ $post->ip }}</strong></td>
    <td>{{ $post->created_at }}</td>
    <td><?php if($post->status == '1') { echo 'Hoạt động'; } else {echo 'Khóa';} ?></td>
    <td>{!! link_to_route('IPAdmin.edit', trans('back/IPAdmin.edit'), [$post->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
    <td>
    {!! Form::open(['method' => 'DELETE', 'route' => ['IPAdmin.destroy', $post->id]]) !!}
      {!! Form::destroy(trans('back/IPAdmin.destroy'), trans('back/IPAdmin.destroy-warning')) !!}
    {!! Form::close() !!}
    </td>
  </tr>
@endforeach