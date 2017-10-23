@extends('back.template')

@section('main')

  @include('back.partials.entete', ['title' => 'Quản lý vay' ])

	@if(session()->has('ok'))
    @include('partials/error', ['type' => 'success', 'message' => session('ok')])
	@endif

  <div class="row col-lg-12">
    <div class="pull-right link">{!! $links !!}</div>
  </div>

  <div class="row col-lg-12">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Người vay</th>
            <th>Ngày khởi tạo</th>
            <th>Ngày kết thúc</th>
            <th>Số tiền cần vay</th>
            <th>Lãi suất</th>
            <th>Loại thế chấp</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @include('back.borrow.table')
        </tbody>
      </table>
    </div>
  </div>

  <div class="row col-lg-12">
    <div class="pull-right link">{!! $links !!}</div>
  </div>

@stop

@section('scripts')

@stop
