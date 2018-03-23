@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Các khoản vay hết hạn' ])

    <?php if (isset($ok)):?>
        @include('partials/error', ['type' => 'success', 'message' => $ok])
    <?php endif;?>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (Session()->has('flash_level'))
        <div class="alert alert-success">
            <ul>
                {!! Session::get('flash_massage') !!}
            </ul>
        </div>
    @endif
    <?php if (count($data)) {?>
    <div class="settings panel-body" style="float: left;width: 100%; padding: 20px;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Người vay</th>
                <th>Số tiền vay</th>
                <th>Dự tính lãi</th>
                <th>Ngày đáo hạn</th>
                <th>Người nhận</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;foreach ($data as $item) : $i++;?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td>{!! link_to_route('user.show', $item->uBorrowName, [$item->uid], ['class' => '']) !!}</td>
                <td><?php echo $item->sotiencanvay ?></td>
                <th><?php echo $item->dutinhlai ?></th>
                <td><?php echo $item->ngaydaohan ?></td>
                <td>{!! link_to_route('user.show', $item->uInversName, [$item->uInvest], ['class' => '']) !!}</td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php } else {?>
    <h5>No item.</h5>
    <?php } ?>

@stop
