@extends('back.template')

@section('main')
    <h3>Thiết lập nhà đầu tư đặc biệt</h3>
    <?php if (isset($ok)) : ?>
        @include('partials/error', ['type' => 'success', 'message' => $ok])
    <?php endif;?>
    <?php if(count($invests)) {?>
    <div class="table-responsive">
        <form action="{!! url('user/setSpecial') !!}" method="post">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Chọn làm nhà đầu tư đặc biệt</th>
                <th>User name</th>
                <th>Email</th>
                <th>Hủy nhà đầu tư đặc biệt</th>
            </tr>
            </thead>
            <tbody>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <?php $i=0; foreach($invests as $invest): $i++ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><input type="radio" <?php if ($invest->usertype == '1') {echo 'checked';} else {echo '';}?> name="uid" value="<?php echo $invest->id; ?>" required></td>
                        <td><?php echo $invest->username; ?></td>
                        <td><?php echo $invest->email; ?></td>
                        <td><?php if ($invest->usertype == '1') {?>
                            <a href="{{ url('cancelSpecial/?id=' . $invest->id) }}" class="btn btn-danger">Huỷ quyền NĐT đặc biệt</a>
                        <?php }else{?> &nbsp;<?php }?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="submit" value="Save">
        </form>
    </div>
    <?php } else { ?>
        <h5>No item.</h5>
    <?php } ?>

@stop