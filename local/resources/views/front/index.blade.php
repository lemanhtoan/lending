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

		<div class="col-md-7 home-login">

			<ul id="owl-homeslider" class="owl-carousel owl-theme">
				<li class="item"><img src="{!!url('/img/banner1.jpg') !!}" alt="Banner"></li>
				<li class="item"><img src="{!!url('/img/banner2.jpg') !!}" alt="Banner"></li>
			</ul>
		</div>
		<div class="col-md-5 home-slider">
			<?php if($userType == 'NON') { // not login?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#borrow-tab" data-toggle="tab">Create a loan <i class="fa"></i></a></li>
				<li><a href="#invest-tab" data-toggle="tab">Get a loan <i class="fa"></i></a></li>
			</ul>

			<form id="accountForm" class="form-horizontal" method="post">
				<div class="tab-content">
					<div class="tab-pane active" id="borrow-tab">
						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Bạn cần:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="cost" name="cost">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Bạn muốn thế chấp bằng:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="methodPay" name="methodPay">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Thời hạn vay:</label>
							<div class="col-sm-6">
								<select class="form-control" id="month" name="month">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Lãi suất:</label>
							<div class="col-sm-6">
								<select class="form-control" id="costMinus" name="costMinus">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-12" for="email">Số bitcoin bạn cần thế chấp là 1 bitcoin</label>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-12" for="email">Số tiền cần trả cuối kỳ là 100 USD</label>
						</div>

						<input type="hidden" name="post_type" value="borrow">

						<div class="borrow-button pull-right"><input type="submit" value="Borrow now"/></div>
					</div>

					<div class="tab-pane" id="invest-tab">
						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Số tiền vay:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="invest_cost" name="invest_cost">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Thời gian vay:</label>
							<div class="col-sm-6">
								<select class="form-control" id="invest_month" name="invest_month">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Loại tiền thế chấp:</label>
							<div class="col-sm-6">
								<select class="form-control" id="invest_money_type" name="invest_money_type">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Lãi suất:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="invest_laisuat" name="invest_laisuat">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Loại tiền nhận:</label>
							<div class="col-sm-6">
								<select class="form-control" id="invest_money_received" name="invest_money_received">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>
						</div>

						<input type="hidden" name="post_type" value="invest">
						<div class="invest-button pull-right"><input type="submit" value="Search"/></div>
					</div>
				</div>
			</form>

			<?php } elseif($userType == '3') { // borrow ?>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#borrow-tab" data-toggle="tab">Create a loan <i class="fa"></i></a></li>
				</ul>

				<form id="accountForm" class="form-horizontal" method="post">
					<div class="tab-content">
						<div class="tab-pane active" id="borrow-tab">
							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Bạn thế chấp:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control change-inp" id="sothechap" name="sothechap">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Bạn muốn thế chấp bằng:</label>
								<div class="col-sm-6">
									<select class="form-control  change-inp" id="methodPay" name="methodPay">
										<option value="">Chọn loại thế chấp</option>
										<option value="BTC">BTC</option>
										<option value="ETH">ETH</option>
										<option value="LTC">LTC</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>

							<div class="form-group max-money" style="display: none;">
								<label class="control-label col-sm-12" for="email">Số tiền vay tối đa là <b class="max-value"></b> USD</label>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Bạn cần vay:</label>
								<div class="col-sm-6">
									<input type="number" step="0.01" min="0" max="" class="form-control  change-inp" id="cost" name="cost">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Thời hạn vay:</label>
								<div class="col-sm-6">
									<select class="form-control  change-inp" id="month" name="month">
										<option value="">Số tháng vay</option>
										<?php for($i=1; $i<36; $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Lãi suất:</label>
								<div class="col-sm-6">
									<?php $datalaisuat = DB::table('settings')->where('name', 'laisuat')->select('content')->get()[0]; ?>
									<input type="text" disabled value="<?php echo $datalaisuat->content;?>" class="form-control" id="costMinus" name="costMinus">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-12" for="email">Số lãi hàng tháng là <b class="permonth"></b> USD</label>
								<input type="hidden" name="permonth" class="permonthValue"/>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-12" for="email">Số tiền cần trả cuối kỳ là <b class="pertotal"></b> USD</label>
								<input type="hidden" name="pertotal" class="pertotalValue"/>
							</div>

							<input type="hidden" name="post_type" value="borrow">

							<div class="borrow-button pull-right"><input type="submit" value="Borrow now"/></div>
						</div>
					</div>
				</form>
			<?php }else { // invest?>
				<ul class="nav nav-tabs">
					<li  class="active"><a href="#invest-tab" data-toggle="tab">Get a loan <i class="fa"></i></a></li>
				</ul>

				<form id="accountForm" class="form-horizontal" method="post">
					<div class="tab-content ">

						<div class="tab-pane active" id="invest-tab">
							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Số tiền vay:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="invest_cost" name="invest_cost">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Thời gian vay:</label>
								<div class="col-sm-6">
									<select class="form-control" id="invest_month" name="invest_month">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Loại tiền thế chấp:</label>
								<div class="col-sm-6">
									<select class="form-control" id="invest_money_type" name="invest_money_type">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Lãi suất:</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="invest_laisuat" name="invest_laisuat">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="email">Loại tiền nhận:</label>
								<div class="col-sm-6">
									<select class="form-control" id="invest_money_received" name="invest_money_received">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div>
							</div>

							<input type="hidden" name="post_type" value="invest">
							<div class="invest-button pull-right"><input type="submit" value="Search"/></div>
						</div>
					</div>
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
		        console.log('sothechap: '+ sothechap + ' methodPay: '+ methodPay + ' cost: '+ cost + ' month: '+ month);
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
                        }
                    });
                }
			});
		});
	</script>

	<div class="row">
		<div class="box filter-box">
			<div class="col-lg-12">
				<form action="" id="home_search" name="home_search">
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_sotienvay" name="search_sotienvay">
								<option value="">Số tiền vay</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_thoigianvay" name="search_thoigianvay">
								<option value="">Thời gian vay</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_tienthechap" name="search_tienthechap">
								<option value="">Loại tiền thế chấp</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_laisuat" name="search_laisuat">
								<option value="">Lãi suất</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<select class="form-control" id="search_tiennhan" name="search_tiennhan">
								<option value="">Loại tiền nhận</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<input type="submit" value="Tìm kiếm" name="search_submit" id="search_submit">
						<input type="reset" value="Xóa lọc" name="search_reset" id="search_reset">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>Các khoản vay đã thế chấp</h3>
				<div class="table-responsive">
				<table class="table invest-table">
					<thead>
					<tr>
						<th style="width: 5%">#</th>
						<th style="width: 20%">Ngày kết thúc khoản vay</th>
						<th style="width: 15%">Ngày khởi tạo</th>
						<th style="width: 15%">Số tiền cần vay</th>
						<th style="width: 15%">Lãi suất</th>
						<th style="width: 20%">Số tiền lãi khi đáo hạn khoản vay</th>
						<th style="width: 5%">&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 5%">1</td>
						<td style="width: 20%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 20%">450.000 vnđ</td>
						<td style="width: 5%"><button>Invest</button></td>
					</tr>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
@stop


