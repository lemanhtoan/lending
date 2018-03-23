@extends('back.template')


@section('main')


	<div class="col-sm-12">
		@yield('form')

		<div class="box-info">
			<div class="alert alert-success">
			  	<p>Khoản vay ID: <?php echo $post['id']; ?></p>
			  	<p>Ngày khởi tạo: <?php echo $post['created_at']; ?></p>
			  	<p>Ngày đáo hạn: <?php echo $post['ngaydaohan']; ?></p>
			  	<p>Số tiền cần vay: <?php echo $post['sotiencanvay']; ?></p>
			  	<p>Lãi suất: <?php echo $post['phantramlai']; ?></p>
			  	<p>Loại thế chấp: <?php echo $post['kieuthechap']; ?></p>
			  	<p>Dự tính lãi: {{$post->dutinhlai}}</p>
			  	<p>Trạng thái: <?php
		switch ($post->status) {
			case 0:
				$label = 'Khởi tạo';break;
			case 1:
				$label = 'Đã thế chấp';break;
			case 2:
				$label = 'Đang hoạt động';break;
			case 3:
				$label = 'Giao dịch tạm khóa';break;
			case 4:
				$label = 'Giao dịch hoàn thành';break;
				case 10:
              $label = 'Chờ admin duyệt khoản vay';break;
          case 20:
              $label = 'Nhắc nhở lần 1';break;
          case 30:
              $label = 'Nhắc nhở lần 2';break;
          case 40:
              $label = 'Đã mất thế chấp';break;
		}
		echo $label;
		?></p>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>Cập nhật thời gian đáo hạn</label>
				<div id="ngaydaohan" class="input-group input-append date">
		            <span class="add-on" style="width: 100%">
					<input value="<?php if(isset($post['ngaydaohan'])) {echo $post['ngaydaohan'];}else{echo '';} ?>" class="form-control" data-format="yyyy-MM-dd hh:mm:ss" type="text" name="ngaydaohan"/>
		            </span>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			{!! Form::submit('Cập nhật') !!}
		</div>
		{!! Form::close() !!}
	</div>

	
	{!! HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
	{!! HTML::style('css/bootstrap-datetimepicker.min.css') !!}
	{!! HTML::script('js/bootstrap-datetimepicker.min.js') !!}

	<script type="text/javascript">
		$('#ngaydaohan').datetimepicker({});
	</script>


@stop


