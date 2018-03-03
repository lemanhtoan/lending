@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center"><?php echo $ok?></h2>
                <hr>
                <p>
                    You need pay <?php echo $data['soluongthechap'];?> <?php echo $moneyType; ?> to admin address: <?php echo $addReceived;?>
                </p>
                <p>
                    After your pay, please <a href="{{ url('confirmBorrow/?id=' . $data['id']) }}">confirm transaction </a></p>
                </p>
            </div>
        </div>
    </div>
@stop