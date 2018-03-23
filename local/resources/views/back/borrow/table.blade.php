<?php $i=0;?>
@foreach ($posts as $post)
  <?php $i++;?>
  <tr>
    <td><?php echo $i;?></td>
    <td><strong>{{ $post->username }}</strong></td>
    <td>{{ $post->created_at }}</td>
    <td>{{ $post->ngaydaohan }}</td>
    <td>{{ $post->sotiencanvay }}</td>
    <td>{{ $post->phantramlai }} ({{ trans('front/site.thang') }})</td>
    <td>{{ $post->kieuthechap }}</td>
    <td>
      <?php
      switch ($post->status) {
        case 0:
          $label = 'Khởi tạo';break;
        case 1:
          $label = 'Đã thế chấp';break;
        case 2:
          $label = 'Đang hoạt động';break;
        case 3:
          $label = 'Giao dịch tạm khóa';break;
        case 4:
          $label = 'Giao dịch hoàn thành';break;
          case 10:
              $label = 'Chờ admin duyệt khoản vay';break;
          case 20:
              $label = 'Nhắc nhở lần 1';break;
          case 30:
              $label = 'Nhắc nhở lần 2';break;
          case 40:
              $label = 'Đã mất thế chấp';break;
      }
      echo $label;
      ?>
    </td>
    <td>{!! link_to('borrow/' . $post->id, trans('back/blog.see'), ['class' => 'btn btn-success btn-block btn']) !!}</td>
    <td>{!! link_to_route('borrow.edit', 'Edit', [$post->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
    <td>
    {!! Form::open(['method' => 'DELETE', 'route' => ['borrow.destroy', $post->id]]) !!}
      {!! Form::destroy(trans('back/blog.destroy'), trans('back/blog.destroy-warning')) !!}
    {!! Form::close() !!}
    </td>
  </tr>
@endforeach