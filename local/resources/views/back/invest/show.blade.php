@extends('back.template')

@section('main')

	@include('back.partials.entete', ['title' => 'Khoản đầu tư', 'icone' => 'user', 'fil' => link_to('borrow', 'Khoản đầu tư') . ' / ' . ''])

	<p>ID: {{ $post->id }}</p>
	<p>Số lượng thế chấp: {{$post->soluongthechap}}</p>
	<p>Kiểu thế chấp: {{$post->kieuthechap}}</p>
	<p>Thời gian thế chấp: {{$post->thoigianthechap}} (tháng)</p>
	<p>Phần trăm lãi: {{$post->phantramlai}}%</p>
	<p>Số tiền cần đầu tư: {{$post->sotiencanvay}}</p>
	<p>Dự tính lãi: {{$post->dutinhlai}}</p>
	<p>Ngày giải ngân: {{$post->ngaygiaingan}}</p>
	<p>Ngày đáo hạn: {{$post->ngaydaohan}}</p>
	<p>Trạng thái:
		<?php
		switch ($post->status) {
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
	</p>
@stop