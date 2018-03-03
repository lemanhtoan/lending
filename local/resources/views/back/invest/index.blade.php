@extends('back.template')

@section('main')

  @include('back.partials.entete', ['title' => 'Quản lý đầu tư' ])

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
            <th>Người đầu tư</th>
            <th>{{ trans('front/site.borrowed_date_start') }}</th>
            <th>Ngày kết thúc</th>
            <th>Số tiền cần đầu tư</th>
            <th>{{ trans('front/site.laisuat') }}</th>
            <th>Loại thế chấp</th>
            <th>{{ trans('front/site.status') }}</th>
          </tr>
        </thead>
        <tbody>
          @include('back.invest.table')
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
