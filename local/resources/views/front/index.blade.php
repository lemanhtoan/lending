@extends('front.template')

@section('main')
	<div class="row home-login">

		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		@if (session('warning'))
			<div class="alert alert-warning">
				{{ session('warning') }}
			</div>
		@endif

		<?php  if(isset($okMessage)) : ?>
			<div class="box-info">
				<div class="alert alert-success">
				  <h3>{{ trans('front/site.investIsOk') }} </h3>
				  <p>{{ trans('front/site.youneedtoken') }}: <b><?php echo $dataMoney; ?></b> {{ trans('front/site.toAddress') }} <b><?php echo $dataCCL; ?></b></p>
				  <p>{{ trans('front/site.afterTrans') }} <a href="{{ url('confirmInvest/?id=' . $dataId) }}">{{ trans('front/site.confirm') }} </a> {{ trans('front/site.doneTrans') }}</p>
				</div>
			</div>
		<?php endif; ?>

		<div class="col-md-7 home-login">
			<ul id="owl-homeslider" class="owl-carousel owl-theme">
				<?php if (count($slideshows)) :?>
				<?php foreach ($slideshows as $slide) :?>
				<li class="item"><a href="<?php echo $slide['link']?>" title="<?php echo $slide['title']?>"><img src="{!! asset('uploads/files/' . $slide['image']) !!}"  alt="<?php echo $slide['title']?>"/></a></li>
				<?php endforeach;?>
				<?php endif; ?>
			</ul>
		</div>
		<div class="col-md-5 home-slider">
			<?php if($userType == 'NON') { // not login?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#borrow-tab" data-toggle="tab">{{ trans('front/site.createloan') }} <i class="fa"></i></a></li>
				<li><a href="#invest-tab" data-toggle="tab">{{ trans('front/site.getloan') }} <i class="fa"></i></a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="borrow-tab">
					<form action="{!! url('createALoan') !!}" id="accountForm" class="form-horizontal" method="post">
						<?php $datalaisuat = DB::table('settings')->where('name', 'laisuat')->select('content')->get()[0]; ?>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="uid" value="<?php echo $uid ?>">
						<input type="hidden" name="percentCost" value="<?php echo $datalaisuat->content ?>">
						<div class="tab-content">
							<div class="tab-pane active" id="borrow-tab">
								<div class="form-group">
									<label class="control-label col-sm-6" for="email">{{ trans('front/site.thechap') }}:</label>
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency change-inp" id="sothechap" name="sothechap" />
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-6" for="email">{{ trans('front/site.thechapbang') }}:</label>
									<div class="col-sm-6">
										<select class="form-control  change-inp" id="methodPay" name="methodPay">
											<option value="">{{ trans('front/site.loaithechap') }}</option>
											<option value="BTC">BTC</option>
											<option value="ETH">ETH</option>
											{{--<option value="LTC">LTC</option>--}}
										</select>
									</div>
								</div>

								<div class="form-group max-money" style="display: none;">
									<label class="control-label col-sm-12" for="email">{{ trans('front/site.sotientoida') }} <b class="max-value"></b> USD</label>
									<input type="hidden" name="maxMoney" class="maxMoney" value="0">
								</div>

								<div class="form-group">
									<label class="control-label col-sm-6" for="email">{{ trans('front/site.canvay') }}:</label>
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency change-inp" id="cost" name="cost" />
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-6" for="email">{{ trans('front/site.thoihanvay') }}:</label>
									<div class="col-sm-6">
										<select class="form-control  change-inp" id="month" name="month">
											<option value="">{{ trans('front/site.sothangvay') }}</option>
											<?php for($i=1; $i<36; $i++) { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-6" for="email">{{ trans('front/site.laisuatthang') }}:</label>
									<div class="col-sm-6">
										<input type="text" disabled value="<?php echo $datalaisuat->content;?>" class="form-control" id="costMinus" name="costMinus">
									</div>
								</div>

								<div class="form-group box-per" style="display: none">
									<label class="control-label col-sm-12" for="email">{{ trans('front/site.laithang')}} <b class="permonth"></b> USD</label>
									<input type="hidden" name="permonth" class="permonthValue"/>
								</div>

								<div class="form-group box-per" style="display: none">
									<label class="control-label col-sm-12" for="email">{{ trans('front/site.laiky') }} <b class="pertotal"></b> USD</label>
									<input type="hidden" name="pertotal" class="pertotalValue"/>
								</div>

								<input type="hidden" name="post_type" value="borrow">

								<div class="borrow-button pull-right"><input type="submit" value="{{ trans('front/site.borrownow') }}"/></div>
							</div>
						</div>
					</form>
				</div>

				<div class="tab-pane" id="invest-tab">
					<form action="{!! url('getAloan') !!}" method="get" id="home_search" name="home_search">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<select class="form-control" id="search_sotienvay" name="search_sotienvay">
								<option value="">{{ trans('front/site.sotienvay') }}</option>
								<?php
								foreach ($khoanggia as $kgia => $gia) {?>
								<option <?php if(isset($_GET['search_sotienvay']) && $_GET['search_sotienvay'] == $kgia){echo 'selected';}else{echo '';} ?> value="<?php echo $kgia ?>">
									<?php if($gia =='All') : ?>
										{{ trans('front/site.All') }}
									<?php endif;?>
									<?php if($gia =='U100') : ?>
										{{ trans('front/site.U100') }}
									<?php endif;?>
									<?php if($gia =='F100_T200') : ?>
										{{ trans('front/site.F100_T200') }}
									<?php endif;?>
									<?php if($gia =='F200_T300') : ?>
										{{ trans('front/site.F200_T300') }}
									<?php endif;?>
									<?php if($gia =='F300_T500') : ?>
										{{ trans('front/site.F300_T500') }}
									<?php endif;?>
									<?php if($gia =='T500') : ?>
										{{ trans('front/site.T500') }}
									<?php endif;?>
								</option>
								<?php }
								?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="search_thoigianvay" name="search_thoigianvay">
								<option value="">{{ trans('front/site.thoigianvay') }}</option>
								<?php for($i=1; $i<36; $i++) { ?>
								<option <?php if(isset($_GET['search_thoigianvay']) && $_GET['search_thoigianvay'] == $i){echo 'selected';}else{echo '';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="search_tienthechap" name="search_tienthechap">
								<option value="">{{ trans('front/site.tienthechap') }}</option>
								<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
								<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="search_laisuat" name="search_laisuat">
								<option value="">{{ trans('front/site.laisuat') }}</option>
								<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '2'){echo 'selected';}else{echo '';} ?>  value="2">2 ({{ trans('front/site.thang') }})</option>
								<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '3'){echo 'selected';}else{echo '';} ?>  value="3">3 ({{ trans('front/site.thang') }})</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="search_tiennhan" name="search_tiennhan">
								<option value=""> {{ trans('front/site.loaitiennhan') }}</option>
								<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
								<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
							</select>
						</div>
						<input type="submit" value="{{ trans('front/site.search') }}" name="search_submit" id="search_submit">
					</form>
				</div>
			</div>

			<?php } elseif($userType == '3') { // borrow ?>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#borrow-tab" data-toggle="tab">{{ trans('front/site.createloan') }} <i class="fa"></i></a></li>
				</ul>

				<form action="{!! url('createALoan') !!}" id="accountForm" class="form-horizontal" method="post">
					<?php $datalaisuat = DB::table('settings')->where('name', 'laisuat')->select('content')->get()[0]; ?>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="uid" value="<?php echo $uid ?>">
					<input type="hidden" name="percentCost" value="<?php echo $datalaisuat->content ?>">
					<div class="tab-content">
						<div class="tab-pane active" id="borrow-tab">
							<?php if($uCCL == "") { ?>
								<div class="alert alert-info alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									{!! trans('front/site.cclRequired') !!} <a style="color:red" href="{{ url('manager') }}">{!! trans('front/site.isHere') !!}</a>
								</div>
							<?php } else {  ?>
							<div class="form-group">
								<label class="control-label col-sm-6" for="email">{{ trans('front/site.thechap') }}:</label>
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency change-inp" id="sothechap" name="sothechap" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">{{ trans('front/site.thechapbang') }}:</label>
								<div class="col-sm-6">
									<select class="form-control  change-inp" id="methodPay" name="methodPay">
										<option value="">{{ trans('front/site.loaithechap') }}</option>
										<option value="BTC">BTC</option>
										<option value="ETH">ETH</option>
										{{--<option value="LTC">LTC</option>--}}
									</select>
								</div>
							</div>

							<div class="form-group max-money" style="display: none;">
								<label class="control-label col-sm-12" for="email">{{ trans('front/site.sotientoida') }} <b class="max-value"></b> USD</label>
								<input type="hidden" name="maxMoney" class="maxMoney" value="0">
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">{{ trans('front/site.canvay') }}:</label>
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input type="number"  min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency change-inp" id="cost" name="cost" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">{{ trans('front/site.thoihanvay') }}:</label>
								<div class="col-sm-6">
									<select class="form-control  change-inp" id="month" name="month">
										<option value="">{{ trans('front/site.sothangvay') }}</option>
										<?php for($i=1; $i<36; $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">{{ trans('front/site.laisuatthang') }}:</label>
								<div class="col-sm-6">
									<input type="text" disabled value="<?php echo $datalaisuat->content;?>" class="form-control" id="costMinus" name="costMinus">
								</div>
							</div>

							<div class="form-group box-per" style="display: none">
								<label class="control-label col-sm-12" for="email">{{ trans('front/site.laithang')}} <b class="permonth"></b> USD</label>
								<input type="hidden" name="permonth" class="permonthValue"/>
							</div>

							<div class="form-group box-per" style="display: none">
								<label class="control-label col-sm-12" for="email">{{ trans('front/site.laiky') }} <b class="pertotal"></b> USD</label>
								<input type="hidden" name="pertotal" class="pertotalValue"/>
							</div>

							<input type="hidden" name="post_type" value="borrow">

							<div class="borrow-button pull-right"><input type="submit" value="Borrow now"/></div>
							<?php } ?>
						</div>
					</div>
				</form>
			<?php }else { // invest?>
				<ul class="nav nav-tabs">
					<li  class="active"><a href="#invest-tab" data-toggle="tab">{{ trans('front/site.getloan') }} <i class="fa"></i></a></li>
				</ul>

				<form action="{!! url('getAloan') !!}" method="get" id="home_search" name="home_search">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<select class="form-control" id="search_sotienvay" name="search_sotienvay">
							<option value="">{{ trans('front/site.sotienvay') }}</option>
                            <?php
                            foreach ($khoanggia as $kgia => $gia) {?>
							<option <?php if(isset($_GET['search_sotienvay']) && $_GET['search_sotienvay'] == $kgia){echo 'selected';}else{echo '';} ?> value="<?php echo $kgia ?>">
                                <?php if($gia =='All') : ?>
								{{ trans('front/site.All') }}
                                <?php endif;?>
                                <?php if($gia =='U100') : ?>
								{{ trans('front/site.U100') }}
                                <?php endif;?>
                                <?php if($gia =='F100_T200') : ?>
								{{ trans('front/site.F100_T200') }}
                                <?php endif;?>
                                <?php if($gia =='F200_T300') : ?>
								{{ trans('front/site.F200_T300') }}
                                <?php endif;?>
                                <?php if($gia =='F300_T500') : ?>
								{{ trans('front/site.F300_T500') }}
                                <?php endif;?>
                                <?php if($gia =='T500') : ?>
								{{ trans('front/site.T500') }}
                                <?php endif;?>
							</option>
                            <?php }
                            ?>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="search_thoigianvay" name="search_thoigianvay">
							<option value="">{{ trans('front/site.thoigianvay') }}</option>
                            <?php for($i=1; $i<36; $i++) { ?>
							<option <?php if(isset($_GET['search_thoigianvay']) && $_GET['search_thoigianvay'] == $i){echo 'selected';}else{echo '';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="search_tienthechap" name="search_tienthechap">
							<option value="">{{ trans('front/site.tienthechap') }}</option>
							<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
							<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
							<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'LTC'){echo 'selected';}else{echo '';} ?>  value="LTC">LTC</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="search_laisuat" name="search_laisuat">
							<option value="">{{ trans('front/site.laisuat') }}</option>
							<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '2'){echo 'selected';}else{echo '';} ?>  value="2">2 ({{ trans('front/site.thang') }})</option>
							<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '3'){echo 'selected';}else{echo '';} ?>  value="3">3 ({{ trans('front/site.thang') }})</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="search_tiennhan" name="search_tiennhan">
							<option value=""> {{ trans('front/site.loaitiennhan') }}</option>
							<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
							<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
						</select>
					</div>
					<input type="submit" value="{{ trans('front/site.search') }}" name="search_submit" id="search_submit">
				</form>
			<?php } ?>
		</div>
	</div>

	<script>
		jQuery(document).ready(function(){
		    jQuery('.change-inp').change(function(){
		        var sothechap = jQuery('#sothechap').val();
		        var methodPay = jQuery('#methodPay').val();
		        var cost = jQuery('#cost').val();
		        var month = jQuery('#month').val();
		        if (sothechap!="" && methodPay!="") {
                    var dataString = 'sothechap='+ sothechap+'&methodPay='+ methodPay;
                    jQuery.ajax({
                        type: "GET",
                        url: "{!! url('compare-coinmarketcap') !!}",
                        data: dataString,
                        cache: false,
                        beforeSend: function(html)
                        {
                        },
                        success: function(html)
                        {
                            jQuery('.max-value').html(html);
                            jQuery('#cost').attr('max', html);
                            jQuery('.max-money').show();
                            jQuery('.maxMoney').val(html);
                        }
                    });
				}

                if (sothechap!="" && methodPay!="" && cost!="" && month!="") {
                    var dataString = 'sothechap='+ sothechap+'&methodPay='+ methodPay+'&cost='+ cost+'&month='+month;
                    jQuery.ajax({
                        type: "GET",
                        url: "{!! url('borrow-calc') !!}",
                        data: dataString,
                        cache: false,
                        beforeSend: function(html)
                        {
                        },
                        success: function(html)
                        {
                            jQuery('.permonth').html(html.permonth);
                            jQuery('.permonthValue').val(html.permonth);
                            jQuery('.pertotal').html(html.total);
                            jQuery('.pertotalValue').val(html.total);
							jQuery('.box-per').show();
                        }
                    });
                }
			});
		});
	</script>

    <?php if($userType == 'NON' || $userType == '2') { // not login OR invest ?>
	<div class="row">
		<div class="box filter-box">
			<div class="col-lg-12-">
				<form action="{!! url('homeFilter') !!}" method="get" id="home_search" name="home_search">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-2 first-col">
						<div class="form-group">
							<select class="form-control" id="search_sotienvay" name="search_sotienvay">
								<option value="">{{ trans('front/site.sotienvay') }}</option>
								<?php
									foreach ($khoanggia as $kgia => $gia) {?>
									<option <?php if(isset($_GET['search_sotienvay']) && $_GET['search_sotienvay'] == $kgia){echo 'selected';}else{echo '';} ?> value="<?php echo $kgia ?>">
                                        <?php if($gia =='All') : ?>
										{{ trans('front/site.All') }}
                                        <?php endif;?>
                                        <?php if($gia =='U100') : ?>
										{{ trans('front/site.U100') }}
                                        <?php endif;?>
                                        <?php if($gia =='F100_T200') : ?>
										{{ trans('front/site.F100_T200') }}
                                        <?php endif;?>
                                        <?php if($gia =='F200_T300') : ?>
										{{ trans('front/site.F200_T300') }}
                                        <?php endif;?>
                                        <?php if($gia =='F300_T500') : ?>
										{{ trans('front/site.F300_T500') }}
                                        <?php endif;?>
                                        <?php if($gia =='T500') : ?>
										{{ trans('front/site.T500') }}
                                        <?php endif;?>
									</option>
								<?php }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_thoigianvay" name="search_thoigianvay">
								<option value="">{{ trans('front/site.thoigianvay') }}</option>
                                <?php for($i=1; $i<36; $i++) { ?>
								<option <?php if(isset($_GET['search_thoigianvay']) && $_GET['search_thoigianvay'] == $i){echo 'selected';}else{echo '';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_tienthechap" name="search_tienthechap">
								<option value="">{{ trans('front/site.tienthechap') }}</option>
								<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
								<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_laisuat" name="search_laisuat">
								<option value="">{{ trans('front/site.laisuat') }}</option>
								<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '2'){echo 'selected';}else{echo '';} ?>  value="2">2 ({{ trans('front/site.thang') }})</option>
								<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '3'){echo 'selected';}else{echo '';} ?>  value="3">3 ({{ trans('front/site.thang') }})</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_tiennhan" name="search_tiennhan">
								<option value=""> {{ trans('front/site.loaitiennhan') }}</option>
								<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
								<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<input type="submit" value="{{ trans('front/site.search') }}" name="search_submit" id="search_submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>{{ trans('front/site.borrowed_done') }}</h3>
				<?php if (count($borrows)) { ?>
				<div class="table-responsive">
					<table class="table invest-table">
						<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 20%">{{ trans('front/site.borrowed_date_done') }}</th>
							<th style="width: 15%">{{ trans('front/site.borrowed_date_start') }}</th>
							<th style="width: 15%">{{ trans('front/site.sotiencanvay') }}</th>
							<th style="width: 10%">{{ trans('front/site.laisuat') }}</th>
							<th style="width: 20%">{{ trans('front/site.laidaohan') }}</th>
							<th style="width: 10%">{{ trans('front/site.action') }}</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($borrows as $borrow) : $i++?>
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 20%"><?php echo $borrow->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $borrow->created_at ?></td>
							<td style="width: 15%">{{ trans('front/site.USD') }} <?php echo $borrow->sotiencanvay ?></td>
							<td style="width: 10%"><?php echo $borrow->phantramlai ?> ({{ trans('front/site.thang') }})</td>
							<td style="width: 20%">{{ trans('front/site.USD') }} <?php echo $borrow->dutinhlai ?></td>
							<td style="width: 10%"><a href="{!! url('createInvest',[$borrow->id]) !!}">{{trans('front/site.invest')}}</a></td>
						</tr>
                        <?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php } else { ?>
					<h6>No item.</h6>
				<?php } ?>
			</div>
		</div>
	</div>
    <?php } else { // borrow ?>
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>{{ trans('front/site.borrowed_process') }}</h3>
                <?php if (count($borrowsOfUser)) { ?>
				<div class="table-responsive">
					<table class="table invest-table">
						<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 20%">{{ trans('front/site.borrowed_date_done') }}</th>
							<th style="width: 15%">{{ trans('front/site.borrowed_date_start') }}</th>
							<th style="width: 15%">{{ trans('front/site.sotiencanvay') }}</th>
							<th style="width: 10%">{{ trans('front/site.laisuat') }}</th>
							<th style="width: 20%">{{ trans('front/site.laidaohan') }}</th>
							<th style="width: 10%">{{ trans('front/site.status') }}</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($borrowsOfUser as $borrow) : $i++?>
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 20%"><?php echo $borrow->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $borrow->created_at ?></td>
							<td style="width: 15%">{{ trans('front/site.USD') }} <?php echo $borrow->sotiencanvay ?></td>
							<td style="width: 10%"><?php echo $borrow->phantramlai ?> ({{ trans('front/site.thang') }})</td>
							<td style="width: 20%">{{ trans('front/site.USD') }} <?php echo $borrow->dutinhlai ?></td>
							<td style="width: 10%">
								<?php if($borrow->status =='0') {?>
                                   {{ trans('front/site.borrowInit') }}                         	
                            	<?php  } ?>
                            	<?php if($borrow->status =='1') {?>
                                   {{ trans('front/site.borrowDone') }}                         	
                            	<?php  } ?>
                            	<?php if($borrow->status =='2') {?>
                                   {{ trans('front/site.borrowWork') }}                         	
                            	<?php  } ?>
                            	<?php if($borrow->status =='3') {?>
                                   {{ trans('front/site.borrowPause') }}                         	
                            	<?php  } ?>
                            	<?php if($borrow->status =='4') {?>
                                   {{ trans('front/site.borrowCompleted') }}                         	
                            	<?php  } ?>    
                            	<?php if($borrow->status =='10') {?>
                                   {{ trans('front/site.borrowAdmin') }}                         	
                            	<?php  } ?>    
                            	<?php if($borrow->status =='20') {?>
                                   {{ trans('front/site.borrow1') }}                         	
                            	<?php  } ?>  
                            	<?php if($borrow->status =='30') {?>
                                   {{ trans('front/site.borrow2') }}                         	
                            	<?php  } ?>  
                            	<?php if($borrow->status =='40') {?>
                                   {{ trans('front/site.borrow3') }}                         	
                            	<?php  } ?>   
							</td>
						</tr>
                        <?php endforeach; ?>
						</tbody>
					</table>
				</div>
                <?php } else { ?>
				<h6>No item.</h6>
                <?php } ?>
			</div>
		</div>
	</div>
    <?php } ?>

	<?php if ($userType == '2' || $userType == '1') { // ndt or ndt db ?>
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>{{ trans('front/site.invested_done') }} <?php if ($userType == '1') {echo ' (Nhà đầu tư đặc biệt)';}?></h3>
                <?php if (count($investsOfUser)) { ?>
				<div class="table-responsive">
					<table class="table invest-table">
						<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 20%">{{ trans('front/site.borrowed_date_done') }}</th>
							<th style="width: 15%">{{ trans('front/site.date_invest') }}</th>
							<th style="width: 15%">{{ trans('front/site.sotiencanvay') }}</th>
							<th style="width: 10%">{{ trans('front/site.laisuat') }}</th>
							<th style="width: 20%">{{ trans('front/site.laidaohan') }}</th>
							<th style="width: 10%">{{ trans('front/site.status') }}</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($investsOfUser as $invest) : $i++?>
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 20%"><?php echo $invest->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $invest->created_at ?></td>
							<td style="width: 15%">{{ trans('front/site.USD') }} <?php echo $invest->sotiencanvay ?></td>
							<td style="width: 10%"><?php echo $invest->phantramlai ?> ({{ trans('front/site.thang') }})</td>
							<td style="width: 20%">{{ trans('front/site.USD') }} <?php echo $invest->dutinhlai ?></td>
							<td style="width: 10%">
                                <?php if($invest->status =='0') {?>
                                   {{ trans('front/site.investPending') }}                         	
                            	<?php  } ?>
                            	<?php if($invest->status =='1') {?>
                                   {{ trans('front/site.investDone') }}                         	
                            	<?php  } ?>
                            	<?php if($invest->status =='2') {?>
                                   {{ trans('front/site.investWork') }}                         	
                            	<?php  } ?>
                            	<?php if($invest->status =='3') {?>
                                   {{ trans('front/site.investPause') }}                         	
                            	<?php  } ?>
                            	<?php if($invest->status =='4') {?>
                                   {{ trans('front/site.investCompleted') }}                         	
                            	<?php  } ?>                            	
							</td>
						</tr>
                        <?php endforeach; ?>
						</tbody>
					</table>
				</div>
                <?php } else { ?>
				<h6>No item.</h6>
                <?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
@stop


