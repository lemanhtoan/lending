@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">{{ trans('front/site.checkout') }}</h2>
                <hr>

                <?php if(isset($mess)): ?>
                <div class="alert alert-success">
                    <h3>
                        <?php if($mess =='TRAN_INVALID_BEFORE') { ?>
                        {{ trans('front/site.TRAN_INVALID_BEFORE') }}
                        <?php } ?>
                        <?php if($mess =='TRAN_INVALID') { ?>
                        {{ trans('front/site.TRAN_INVALID') }}
                        <?php } ?>
                        <?php if($mess =='TRAN_COMPLETED') { ?>
                        {{ trans('front/site.TRAN_COMPLETED') }}
                        <?php } ?>
                    </h3>
                </div>
                <?php endif;?>

                <p>{{ trans('front/site.introCheckout') }}</p>
                <div class="box-info">
                    <div class="alert alert-info">
                        <p>{{ trans('front/site.introInvest') }} <?php echo $borrow->sotiencanvay;?></p>
                        <p>{{ trans('front/site.introInvestPay') }}: <?php echo $lai?>,{{ trans('front/site.introInvestRoot') }} <?php echo $borrow->sotiencanvay;?>.</p>
                        <p>{{ trans('front/site.introInvestTotal') }} <b><?php echo $tong; ?></b></p>
                    </div>
                </div>

                <div class="box-info-success" style="display: none">
                    <div class="alert alert-success">
                        <p>{{ trans('front/site.introInvestSuccess') }} <b class="money_new"></b></p>
                        <p>{{ trans('front/site.introInvestPaySuccess') }} <b class="total_new"></b></p>
                        <p>{{ trans('front/site.introInvestTotalSuccess') }} <b class="rate_new"></b> {{ trans('front/site.introInvestTotalSuccessDate') }} <b class="rate_date"></b></p>
                    </div>
                </div>

                <div class="box-info-noti" style="display: none">
                    <div class="alert alert-danger">
                        <p>{{ trans('front/site.introInvestOver') }}</p>
                    </div>
                </div>

                {!! Form::open(['url' => 'confirmCheckout', 'method' => 'post', 'role' => 'form']) !!}

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label class="radio-inline"><input type="radio" value="0" class="checkoutradio" name="checkoutradio">{{ trans('front/site.fullCheckout') }}</label>
                        <label class="radio-inline"><input type="radio" value="1" class="checkoutradio" name="checkoutradio">{{ trans('front/site.limitCheckout') }}</label>
                    </div>
                    <div class="form-group checkoutFull" style="display: none">
                        {{ trans('front/site.addressRec') }}: <?php echo $ccl;?>, {{ trans('front/site.valueRec') }}:  <?php echo $tong; ?>
                    </div>
                    <div class="form-group checkoutLimit" style="display: none">
                        <label for="usr">{{ trans('front/site.value') }}:</label>
                        <input type="number" min="0" step="0.01" max="<?php echo $tong; ?>" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control" id="moneyValue" name="moneyValue">
                        <p><b>{{ trans('front/site.addressRec') }}: <?php echo $ccl;?></b></p>
                    </div>
                    <input type="hidden" class="borrowId" name="borrowId" value="<?php echo $borrow->id;?>">

                    {!! Form::submit(trans('front/site.CONFIRM_TRAN'), ['col-lg-12 l-btn']) !!}

                </div>

                {!! Form::close() !!}
                <script>
                    jQuery(document).ready(function(){
                        jQuery('.checkoutradio').on('change', function() {
                            if(jQuery(this).val() == '1') {
                                jQuery('.checkoutFull').hide();
                                jQuery('.checkoutLimit').show();
                                if(jQuery('.money_new').text()!='') {
                                    jQuery('.box-info-success').show();
                                }
                                jQuery('.box-info-noti').hide();
                            } else {
                                jQuery('.checkoutLimit').hide();
                                jQuery('.checkoutFull').show();
                                jQuery('.box-info-success').hide();
                                jQuery('.box-info-noti').hide();
                            }
                        });
                        jQuery('#moneyValue').on('change', function() {
                            var sotien = jQuery(this).val();
                            var borrowId = jQuery('.borrowId').val();
                            if (sotien!="" && borrowId!="") {
                                var dataString = 'sotien='+ sotien+'&borrowId='+ borrowId;
                                jQuery.ajax({
                                    type: "GET",
                                    url: "{!! url('compare-checkout') !!}",
                                    data: dataString,
                                    cache: false,
                                    beforeSend: function(html)
                                    {
                                    },
                                    success: function(html)
                                    {
                                       if(html.mess =='OVER') {
                                           jQuery('.box-info-success').hide();
                                           jQuery('.box-info-noti').show();
                                       } else if(html.mess=='OK') {
                                            jQuery('.money_new').text(html.sotien);
                                            jQuery('.total_new').text(html.tongmoi);
                                            jQuery('.rate_new').text(html.laimoi);
                                            jQuery('.rate_date').text(html.ngaydaohan);
                                            jQuery('.box-info-success').show();
                                           jQuery('.box-info-noti').hide();
                                       } else {
                                           jQuery('.box-info-success').hide();
                                           jQuery('.box-info-noti').hide();
                                       }
                                    }
                                });
                            }
                        });

                    });
                </script>
            </div>
        </div>
    </div>
@stop