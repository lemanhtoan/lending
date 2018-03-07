@foreach ($slideshow as $post)
  <tr >
    <td class="text-primary"><strong>{{ $post->title }}</strong></td>
    <td><img src="{!! asset('uploads/files/' . $post['image']) !!}"  width="400px"/></td>
    <td>{{ $post->link }}</td>
    <td>{{ $post->position }}</td>
    <td><?php if($post->status == '1') { echo 'Hoạt động'; } else {echo 'Khóa';} ?></td>
    <td>{!! link_to_route('slideshow.edit', 'Edit', [$post->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
    <td>
    {!! Form::open(['method' => 'DELETE', 'route' => ['slideshow.destroy', $post->id]]) !!}
      {!! Form::destroy('Delete', 'Are you sure delete?') !!}
    {!! Form::close() !!}
    </td>
  </tr>
@endforeach