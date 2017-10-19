@extends('back.template')

@section('main')
    <h3>Thiết lập nhà đầu tư đặc biệt</h3>
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