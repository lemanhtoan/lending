<?php $i=0;?>
@foreach ($posts as $post)
  <?php $i++;?>
  <tr>
    <td><?php echo $i;?></td>
    <td><strong>{{ $post->username }}</strong></td>
    <td>{{ $post->created_at }}</td>
    <td>{{ $post->ngaydaohan }}</td>
    <td>{{ $post->sotiencanvay }}</td>
    <td>{{ $post->phantramlai }}%</td>
    <td>{{ $post->kieuthechap }}</td>
    <td>
      <?php
      switch ($post->status) {
        case 0:
          $label = 'Chờ nhà đầu tư chuyển tiền';break;
        case 1:
          $label = 'Đã chuyển tiền';break;
        case 2:
          $label = 'Đang hoạt động';break;
        case 3:
          $label = 'Giao dịch tạm khóa';break;
        case 4:
          $label = 'Giao dịch hoàn thành';break;
      }
      echo $label;
      ?>
    </td>
    <td>{!! link_to('invest/' . $post->id, trans('back/blog.see'), ['class' => 'btn btn-success btn-block btn']) !!}</td>
    <td>
    {!! Form::open(['method' => 'DELETE', 'route' => ['invest.destroy', $post->id]]) !!}
      {!! Form::destroy(trans('back/blog.destroy'), trans('back/blog.destroy-warning')) !!}
    {!! Form::close() !!}
    </td>
  </tr>
@endforeach