@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Duyệt các khoản rút tiền cần verified' ])

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
                <th>Ngày gửi yêu cầu</th>
                <th>Người dùng</th>
                <th>Kiểu tài sản</th>
                <th>Giá trị cần rút</th>
                <th>Nội dung</th>
                <th>{{ trans('front/site.action') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;foreach ($data as $item) : $i++;?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $item->created_at; ?></td>
                <td>{!! link_to_route('user.show', $item->username, [$item->uid], ['class' => '']) !!}</td>
                <td><?php echo $item->type; ?></td>
                <td><?php echo $item->value; ?></td>
                <td>
                    <p>Bạn cần chuyển số tiền: <b><?php echo $item->value,' ', $item->type; ?></b> tới địa chỉ người dùng: <b><?php echo $item->cclAddress ?></b></p>
                </td>
                <td><a href="{{ url('verifiedPay?id=' . $item->id.'&uid=' . $item->uid) }}" class="btn btn-info">Xác nhận đã chuyển</a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php } else {?>
    <h5>No item.</h5>
    <?php } ?>

@stop
