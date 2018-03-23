@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Danh sách số tiền cho vay' ])

    <?php if (count($data)) {?>
    <div class="settings panel-body" style="float: left;width: 100%; padding: 20px;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Người vay</th>
                <th>Số tài sản</th>
                <th>Loại tài sản</th>
                <th>Người đầu tư</th>
                <th>Số tiền vay</th>
                <th>Dự tính lãi</th>
                <th>Ngày đáo hạn</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;foreach ($data as $item) : $i++;?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td>{!! link_to_route('user.show', $item->uvUsername, [$item->uvId], ['class' => '']) !!}</td>
                <td><?php echo $item->soluongthechap ?></td>
                <td><?php echo $item->kieuthechap ?></td>
                <td>{!! link_to_route('user.show', $item->udUsername, [$item->udId], ['class' => '']) !!}</td>
                <td><?php echo $item->sotiencanvay ?></td>
                <td><?php echo $item->dutinhlai ?></td>
                <td><?php echo $item->ngaydaohan ?></td>
                <td><?php
                  switch ($item->status) {
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
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php } else {?>
    <h5>No item.</h5>
    <?php } ?>

@stop
