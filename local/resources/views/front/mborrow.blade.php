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
		<h3>{{ trans('front/site.chtiennhan') }}</h3>
        <?php $moneyReceived = Config::get('constants.moneyReceived');?>
		<form action="moneyReceived" method="POST" role="form">
			{{ csrf_field() }}
			<div class="form-group">
				{{ trans('front/site.ptnhantien') }}:
				<select name="methodPayment" id="methodPayment" required>
					<option value="">{{ trans('front/site.ptnhantien') }}</option>
					<?php foreach($moneyReceived as $key=>$value) :?>
					<option <?php if ($uMethod  == $key) {echo 'selected';}else{echo '';}?> value="<?php echo $key;?>"><?php echo $value ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<input type="submit"  class="btn btn-primary" value="{{ trans('front/site.save') }}" class="button" />
		</form>
	</div>
	<!-- setup user money received method -->

	<!-- setup user money received address token -->
	<div class="row">
		<h3>{{ trans('front/site.addccl') }}</h3>
		<form action="saveAccount" method="POST" role="form">
			{{ csrf_field() }}
			<div class="form-group">
				 <label for="cclAddress">{{ trans('front/site.yourCCL') }}</label>
   				 <input type="text" class="form-control" id="cclAddress" name="cclAddress" value="<?php echo $uCCL;?>" <?php if($uCCL && $uCCL!="") {echo 'readonly';}?>>
			</div>
			<?php if($uCCL=="") : ?>
				<input type="submit"  class="btn btn-primary" value="{{ trans('front/site.save') }}" class="button" />
			<?php endif; ?>
		</form>
	</div>
	<!-- setup user money received  address token -->

	<!-- setup user bank -->
	<div class="row">
		<h3>{{ trans('front/site.banksetting') }}</h3>

	</div>
	<!-- setup user bank -->

    <?php if($userType == 'NON' || $userType == '2') { // not login OR invest ?>
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
							<th style="width: 15%">{{ trans('front/site.laisuat') }}</th>
							<th style="width: 15%">{{ trans('front/site.laidaohan') }}</th>
							<th style="width: 5%">{{ trans('front/site.status') }}</th>
							<th style="width: 5%">{{ trans('front/site.action') }}</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($borrowsOfUser as $borrow) : $i++?>
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 20%"><?php echo $borrow->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $borrow->created_at ?></td>
							<td style="width: 15%"><?php echo $borrow->sotiencanvay ?></td>
							<td style="width: 15%"><?php echo $borrow->phantramlai ?> ({{ trans('front/site.thang') }})</td>
							<td style="width: 20%"><?php echo $borrow->dutinhlai ?></td>
							<td style="width: 5%">
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
							<td style="width: 5%"><?php if ($borrow->status == '0' || $borrow->status == '10'  ) :?>
								<a href="{{ url('deleteitem/?id=' . $borrow->id) }}" class="btn btn-danger" onclick="return confirm('{{ trans('front/site.areSure') }}')">{{ trans('front/site.delete') }}</a>
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
				<h3>{{ trans('front/site.invested_done') }} <?php if ($userType == '1') { ?>
					({{ trans('front/site.dddb') }})
					<?php }?></h3>
				<div class="row">
					<form action="{!! url('filterBorrow') !!}" id="filterBorrow" class="form-horizontal" method="get">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="uid" value="<?php echo $uid ?>">
					<div class="col-md-3">
						<div class="form-group">
							<label>{{ trans('front/site.start') }} <em>*</em></label>
							<div id="start_time" class="input-group input-append date">
                        <span class="add-on" style="width: 100%">
						<input value="<?php if(isset($_GET['start_time'])) {echo $_GET['start_time'];}else{echo '';} ?>" class="form-control" data-format="yyyy-MM-dd hh:mm:ss" type="text" name="start_time"/>
                        </span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>{{ trans('front/site.end') }} <em>*</em></label>
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
                                    text: <?php echo date('m')?> + '/' +  <?php echo date('Y')?>
                                },
                                data: [
                                    {
                                        type: "column",
                                        dataPoints: [
                                            { label: "w1",  y: <?php echo 10; ?>  },
                                            { label: "w2", y: <?php echo 5; ?> },
                                            { label: "w3", y: <?php echo 20; ?>  },
                                            { label: "w4",  y: <?php echo 50; ?>  }
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
							<th style="width: 10%">{{ trans('front/site.borrowed_date_done') }}</th>
							<th style="width: 15%">{{ trans('front/site.date_invest') }}</th>
							<th style="width: 15%">{{ trans('front/site.sotiencanvay') }}</th>
							<th style="width: 15%">{{ trans('front/site.laisuat') }}</th>
							<th style="width: 15%">{{ trans('front/site.laidaohan') }}</th>
							<th style="width: 10%">{{ trans('front/site.status') }}</th>
							<th style="width: 15%">{{ trans('front/site.action') }}</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i = 0; foreach ($investsOfUser as $invest) : $i++ ?>
						
						<tr>
							<td style="width: 5%"><?php echo $i;?></td>
							<td style="width: 10%"><?php echo $invest->ngaygiaingan ?></td>
							<td style="width: 15%"><?php echo $invest->created_at ?></td>
							<td style="width: 15%"><?php echo $invest->sotiencanvay ?></td>
							<td style="width: 15%"><?php echo $invest->phantramlai ?> ({{ trans('front/site.thang') }})</td>
							<td style="width: 15%"><?php echo $invest->dutinhlai ?></td>
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
							<td style="width: 15%"><a href="{{ url('confirmInvest/?id=' . $invest->borrowId) }}" class="btn btn-default">{{ trans('front/site.confirm_invest') }}</a></td>
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

