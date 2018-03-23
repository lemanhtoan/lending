@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Danh sách tài khoản đảm bảo' ])

    <?php if (count($data)) {?>
    <div class="settings panel-body" style="float: left;width: 100%; padding: 20px;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Người vay</th>
                <th>Số tài sản</th>
                <th>Loại tài sản</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;foreach ($data as $item) : $i++;?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td>{!! link_to_route('user.show', $item->username, [$item->uid], ['class' => '']) !!}</td>
                <td><?php echo $item->soluongthechap ?></td>
                <td><?php echo $item->kieuthechap ?></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php } else {?>
    <h5>No item.</h5>
    <?php } ?>

@stop
