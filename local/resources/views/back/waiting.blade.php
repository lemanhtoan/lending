@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Duyệt các khoản vay cần verified' ])

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
                <th>STT</th>
                <th>{{ trans('front/site.borrowed_date_start') }}</th>
                <th>{{ trans('front/site.sotiencanvay') }}</th>
                <th>{{ trans('front/site.laisuat') }}</th>
                <th>Kiểu thế chấp</th>
                <th>Dự tính lãi</th>
                <th>Kiểu verified</th>
                <th>Ảnh mặt trước</th>
                <th>Ảnh mặt sau</th>
                <th>{{ trans('front/site.action') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;foreach ($data as $item) : $i++; //echo "<pre>";var_dump($item)?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $item->created_at; ?></td>
                <td><?php echo $item->sotiencanvay; ?></td>
                <td><?php echo $item->phantramlai; ?></td>
                <td><?php echo $item->kieuthechap; ?></td>
                <td><?php echo $item->dutinhlai; ?></td>
                <td><?php if ($item->type == '0') {
                        $lt = 'Hình thức CMTND';
                    } else {$lt = 'Hình thức Postcode';} echo $lt ?></td>
                <td>
                    <a rel="popover" data-img="uploads/verified/<?php echo $item->front; ?>"><img class="pro-img" src="uploads/verified/<?php echo $item->front; ?>" width="200px"/></a>
                </td>
                <td><a rel="popover" data-img="uploads/verified/<?php echo $item->back; ?>"><img class="pro-img" src="uploads/verified/<?php echo $item->back; ?>" width="200px"/></a></td>
                <td><a href="{{ url('verifiedItem?id=' . $item->id.'&uid=' . $item->uid) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Đồng ý</a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php } else {?>
    <h5>No item.</h5>
    <?php } ?>

@stop
