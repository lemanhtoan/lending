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
	<p>{{ trans('front/site.status') }}:
		<?php if($post->status =='0') {?>
           {{ trans('front/site.investPending') }}                         	
    	<?php  } ?>
    	<?php if($post->status =='1') {?>
           {{ trans('front/site.investDone') }}                         	
    	<?php  } ?>
    	<?php if($post->status =='2') {?>
           {{ trans('front/site.investWork') }}                         	
    	<?php  } ?>
    	<?php if($post->status =='3') {?>
           {{ trans('front/site.investPause') }}                         	
    	<?php  } ?>
    	<?php if($post->status =='4') {?>
           {{ trans('front/site.investCompleted') }}                         	
    	<?php  } ?>          
	</p>
@stop