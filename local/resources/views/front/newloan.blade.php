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
		<div class="row">
			<div class="box filter-box">
				<div class="col-lg-12">
					<form action="{!! url('getAloan') !!}" method="get" id="home_search" name="home_search">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-2">
							<div class="form-group">
								<select class="form-control" id="search_sotienvay" name="search_sotienvay">
									<option value="">Số tiền vay</option>
									<?php
									foreach ($khoanggia as $kgia => $gia) {?>
									<option <?php if(isset($_GET['search_sotienvay']) && $_GET['search_sotienvay'] == $kgia){echo 'selected';}else{echo '';} ?> value="<?php echo $kgia ?>"><?php echo $gia ?></option>
									<?php }
									?>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<select class="form-control" id="search_thoigianvay" name="search_thoigianvay">
									<option value="">Thời gian vay</option>
									<?php for($i=1; $i<36; $i++) { ?>
									<option <?php if(isset($_GET['search_thoigianvay']) && $_GET['search_thoigianvay'] == $i){echo 'selected';}else{echo '';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<select class="form-control" id="search_tienthechap" name="search_tienthechap">
									<option value="">Loại tiền thế chấp</option>
									<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
									<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
									<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'LTC'){echo 'selected';}else{echo '';} ?>  value="LTC">LTC</option>
									<option <?php if(isset($_GET['search_tienthechap']) && $_GET['search_tienthechap'] == 'Other'){echo 'selected';}else{echo '';} ?>  value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<select class="form-control" id="search_laisuat" name="search_laisuat">
									<option value="">Lãi suất</option>
									<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '2'){echo 'selected';}else{echo '';} ?>  value="2">2%</option>
									<option <?php if(isset($_GET['search_laisuat']) && $_GET['search_laisuat'] == '3'){echo 'selected';}else{echo '';} ?>  value="3">3%</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<select class="form-control" id="search_tiennhan" name="search_tiennhan">
									<option value="">Loại tiền nhận</option>
									<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'BTC'){echo 'selected';}else{echo '';} ?>  value="BTC">BTC</option>
									<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'ETH'){echo 'selected';}else{echo '';} ?>  value="ETH">ETH</option>
									<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'LTC'){echo 'selected';}else{echo '';} ?>  value="LTC">LTC</option>
									<option <?php if(isset($_GET['search_tiennhan']) && $_GET['search_tiennhan'] == 'Other'){echo 'selected';}else{echo '';} ?>  value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<input type="submit" value="Tìm kiếm" name="search_submit" id="search_submit">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="box result-box">
				<div class="col-lg-12">
					<h3>Các khoản vay đã thế chấp</h3>
					<?php if (count($borrows)) { ?>
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
							<?php $i = 0; foreach ($borrows as $borrow) : $i++?>
							<tr>
								<td style="width: 5%"><?php echo $i;?></td>
								<td style="width: 20%"><?php echo $borrow->ngaygiaingan ?></td>
								<td style="width: 15%"><?php echo $borrow->created_at ?></td>
								<td style="width: 15%"><?php echo $borrow->sotiencanvay ?></td>
								<td style="width: 15%"><?php echo $borrow->phantramlai ?>%</td>
								<td style="width: 20%"><?php echo $borrow->dutinhlai ?></td>
								<td style="width: 5%"><a href="{!! url('createInvest',[$borrow->id]) !!}">Invest</a></td>
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

		<!-- invest list -->
		<?php if ($userType == '2' || $userType == '1') { // ndt or ndt db ?>
			<div class="row">
				<div class="box result-box">
					<div class="col-lg-12">
						<h3>Các khoản đầu tư đã thực hiện <?php if ($userType == '1') {echo ' (Nhà đầu tư đặc biệt)';}?></h3>
						<?php if (count($investsOfUser)) { ?>
						<div class="table-responsive">
							<table class="table invest-table">
								<thead>
								<tr>
									<th style="width: 5%">#</th>
									<th style="width: 20%">Ngày kết thúc khoản vay</th>
									<th style="width: 15%">Ngày thực hiện đầu tư</th>
									<th style="width: 15%">Số tiền cần vay</th>
									<th style="width: 15%">Lãi suất</th>
									<th style="width: 20%">Số tiền lãi khi đáo hạn khoản vay</th>
									<th style="width: 5%">Trạng thái</th>
								</tr>
								</thead>
								<tbody>
								<?php $i = 0; foreach ($investsOfUser as $invest) : $i++?>
								<tr>
									<td style="width: 5%"><?php echo $i;?></td>
									<td style="width: 20%"><?php echo $invest->ngaygiaingan ?></td>
									<td style="width: 15%"><?php echo $invest->created_at ?></td>
									<td style="width: 15%"><?php echo $invest->sotiencanvay ?></td>
									<td style="width: 15%"><?php echo $invest->phantramlai ?>%</td>
									<td style="width: 20%"><?php echo $invest->dutinhlai ?></td>
									<td style="width: 5%">
										<?php
										switch ($invest->status) {
											case 0:
												$label = 'Chờ nhà đầu tư chuyển tiền';break;
											case 1:
												$label = 'Đã chuyển tiền';break;
											case 2:
												$label = 'Đang hoạt động';break;
											case 3:
												$label = 'Giao dịch tạm khóa';break;
											case 4:
												$label = 'Giao dịch hoàn thành';break;
										}
										echo $label;
										?>
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


