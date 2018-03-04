@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center"><?php echo $ok?></h2>
                <hr>
                <p>
                    {!! trans('front/site.YOU_NEED_PAY') !!} <?php echo $data['soluongthechap'];?> <?php echo $moneyType; ?> {!! trans('front/site.TO_ADMIN') !!}: <?php echo $addReceived;?>
                </p>
                <p>
                    {!! trans('front/site.AFTER_PAY') !!} <a href="{{ url('confirmBorrow/?id=' . $data['id']) }}">{!! trans('front/site.CONFIRM_TRAN') !!} </a></p>
                </p>
            </div>
        </div>
    </div>
@stop