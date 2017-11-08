@extends('front.template')

@section('main')
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<?php
    	if (Auth::user()) {
    		$uMethod = Auth::user()->userReceived;
		} else {
            $uMethod = '';
		}
	?>
	<?php if (isset($ok)):?>
		@include('partials/error', ['type' => 'success', 'message' => $ok])
	<?php endif;?>

    <?php if (isset($error)):?>
		@include('partials/error', ['type' => 'danger', 'message' => $error])
    <?php endif;?>

	<!-- setup user money received method -->
	<div class="row">
		<h3>Cấu hình loại tiền nhận</h3>
        <?php $moneyReceived = Config::get('constants.moneyReceived');?>
		<form action="moneyReceived" method="POST" role="form">
			{{ csrf_field() }}
			<div class="form-group">
				Phương thức nhận tiền:
				<select name="methodPayment" id="methodPayment" required>
					<option value="">Chọn phương thức nhận tiền</option>
					<?php foreach($moneyReceived as $key=>$value) :?>
					<option <?php if ($uMethod  == $key) {echo 'selected';}else{echo '';}?> value="<?php echo $key;?>"><?php echo $value ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<input type="submit"  class="btn btn-primary" value="Lưu" class="button" />
		</form>
	</div>
	<!-- setup user money received method -->

	<!-- setup user bank -->
	<div class="row">
		<h3>Thiết lập tài khoản ngân hàng</h3>

	</div>
	<!-- setup user bank -->

    <?php if($userType == 'NON' || $userType == '2') { // not login OR invest ?>
    <?php } else { // borrow ?>
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>Các khoản vay đã thực hiện</h3>
                <?php if (count($borrowsOfUser)) { ?>
				<div class="table-responsive">
					<table class="table invest-table">
						<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 20%">Ngày kết thúc khoản vay</th>
							<th style="width: 15%">Ngày khởi tạo</th>
							<th style="width: 15%">Số tiền cần vay</th>
							<th style="width: 15%">Lãi suất</th>
							<th style="width: 15%">Số tiền lãi khi đáo hạn khoản vay</th>
							<th style="width: 5%">Trạng thái</th>
							<th style="width: 5%">Hành động</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($borrowsOfUser as $borrow) : $i++?>
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 20%"><?php echo $borrow->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $borrow->created_at ?></td>
							<td style="width: 15%"><?php echo $borrow->sotiencanvay ?></td>
							<td style="width: 15%"><?php echo $borrow->phantramlai ?> (%/tháng)</td>
							<td style="width: 20%"><?php echo $borrow->dutinhlai ?></td>
							<td style="width: 5%">
								<?php
									switch ($borrow->status) {
										case 0:
										    $label = 'Khởi tạo';break;
										case 1:
										    $label = 'Đã thế chấp tài sản, chờ nhà đầu tư';break;
										case 2:
										    $label = 'Đang hoạt động';break;
										case 3:
										    $label = 'Giao dịch tạm khóa';break;
										case 4:
										    $label = 'Giao dịch hoàn thành';break;
                                        case 10:
                                            $label = 'Chờ admin duyệt';break;
									}
									echo $label;
								?>
							</td>
							<td style="width: 5%"><?php if ($borrow->status == '0' || $borrow->status == '10'  ) :?>
								<a href="{{ url('deleteitem/?id=' . $borrow->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a>
							<?php endif; ?></td>
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
				<h3>Các khoản đầu tư đã thực hiện <?php if ($userType == '1') {echo ' (Nhà đầu tư đặc biệt)';}?></h3>
				<div class="row">
					<form action="{!! url('filterBorrow') !!}" id="filterBorrow" class="form-horizontal" method="get">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="uid" value="<?php echo $uid ?>">
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label('Bắt đầu') !!} <em>*</em>
							<div id="start_time" class="input-group input-append date">
                        <span class="add-on" style="width: 100%">
						<input value="<?php if(isset($_GET['start_time'])) {echo $_GET['start_time'];}else{echo '';} ?>" class="form-control" data-format="yyyy-MM-dd hh:mm:ss" type="text" name="start_time"/>
                        </span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label('Kết thúc') !!} <em>*</em>
							<div id="end_time" class="input-group input-append date">
                        <span class="add-on" style="width: 100%">
						<input value="<?php if(isset($_GET['end_time'])) {echo $_GET['end_time'];}else{echo '';} ?>" class="form-control" data-format="yyyy-MM-dd hh:mm:ss" type="text" name="end_time"/>
					    </span>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<input type="submit" value="Filter"/>
					</div>
					</form>
				</div>

				<div class="row chartData">
					<script type="text/javascript">
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("chartTransction", {
                                title:{
                                    text: "Thống kê khoản đầu tư - " + <?php echo date('m')?> + '/' +  <?php echo date('Y')?>
                                },
                                data: [
                                    {
                                        type: "column",
                                        dataPoints: [
                                            { label: "Tuần 1",  y: <?php echo 10; ?>  },
                                            { label: "Tuần 2", y: <?php echo 5; ?> },
                                            { label: "Tuần 3", y: <?php echo 20; ?>  },
                                            { label: "Tuần 4",  y: <?php echo 50; ?>  }
                                        ]
                                    }
                                ]
                            });
                            chart.render();

                        }
					</script>
					<div id="chartTransction" style="height: 300px; width: 100%;"></div>

				</div>

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
							<td style="width: 15%"><?php echo $invest->phantramlai ?> (%/tháng)</td>
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

	{!! HTML::style('css/bootstrap-datetimepicker.min.css') !!}
	{!! HTML::script('js/bootstrap-datetimepicker.min.js') !!}

	<script type="text/javascript">
		$('#start_time, #end_time').datetimepicker({});
	</script>


@stop

