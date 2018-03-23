@extends('back.template')

@section('main')

	@include('back.partials.entete', ['title' => 'Khoản vay', 'icone' => 'user', 'fil' => link_to('borrow', 'Khoản vay') . ' / ' . ''])

	<p>ID: {{ $post->id }}</p>
	<p>Số lượng thế chấp: {{$post->soluongthechap}}</p>
	<p>Kiểu thế chấp: {{$post->kieuthechap}}</p>
	<p>Thời gian thế chấp: {{$post->thoigianthechap}} (tháng)</p>
	<p>Phần trăm lãi: {{$post->phantramlai}}%</p>
	<p>{{ trans('front/site.sotiencanvay') }}: {{$post->sotiencanvay}}</p>
	<p>Dự tính lãi: {{$post->dutinhlai}}</p>
	<p>Ngày giải ngân: {{$post->ngaygiaingan}}</p>
	<p>Ngày đáo hạn: {{$post->ngaydaohan}}</p>
	<p>{{ trans('front/site.status') }}:
		<?php
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
		?>
	</p>
@stop