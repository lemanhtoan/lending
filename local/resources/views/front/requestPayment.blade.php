@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">{{ trans('front/site.requestPayment') }}</h2>
                <hr>
                <?php if(isset($ok)) :?>
                <p >
                    <?php if($ok =='REQUEST_OK') {?>
                    {!! trans('front/site.REQUEST_OK') !!}
                    <?php } elseif($ok =='REQUEST_OVER'){ ?>
                        {!! trans('front/site.REQUEST_OVER') !!}
                        <?php } elseif($ok =='REQUEST_REQ'){ ?>
                        {!! trans('front/site.REQUEST_REQ') !!}
                        <?php }else {  echo $ok;}?>
                </p>
                <?php endif; ?>
                <h3>{{ trans('front/site.borrowed_save') }}</h3>
                <p><?php echo $saveBTC . ' BTC';?></p>
                <p><?php echo $saveETH . ' ETH';?></p>
                {!! Form::open(['url' => 'requestPaymentPost', 'method' => 'post', 'role' => 'form']) !!}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">{!! trans('front/site.value') !!}</label>
                            <input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" placeholder="0" class="form-control currency" id="cost" name="cost" />
                        </div>
                        <div class="form-group">
                            <select class="form-control required" id="tiennhan" name="tiennhan">
                                <option value=""> {{ trans('front/site.loaitiennhan') }}</option>
                                <option  value="BTC">BTC</option>
                                <option  value="ETH">ETH</option>
                            </select>
                        </div>
                        {!! Form::submit(trans('front/form.send'), ['l-btn']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop