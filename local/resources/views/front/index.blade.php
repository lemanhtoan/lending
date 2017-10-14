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
				<li class="item"><img src="https://www.prudentialfinance.com.vn/export/sites/default/desktop_hotline_viet.jpg" alt=""></li>
				<li class="item"><img src="https://www.prudentialfinance.com.vn/export/sites/default/.galleries/prudential/desktop_personal-loan_viet.jpg" alt=""></li>
			</ul>
			<script>
				jQuery(document).ready(function(){
                    var owlSlider = jQuery("#owl-homeslider");
                    owlSlider.owlCarousel({
                        items : 1,
                        rtl:true,
                        stopOnHover: true,
                        pagination: true,
                        navigation: true,
                        lazyLoad: true,
                        slideSpeed: 500,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        autoHeight: true,
                        navigationText: [
                            "<i class='fa fa-chevron-left'></i>",
                            "<i class='fa fa-chevron-right'></i>"
                        ],
                    });
				});
			</script>
			
		</div>
		<div class="col-md-5 home-slider">

			<style type="text/css">
				#accountForm {
					margin-top: 15px;
				}
			</style>

			<ul class="nav nav-tabs">
				<li class="active"><a href="#borrow-tab" data-toggle="tab">Create a loan <i class="fa"></i></a></li>
				<li><a href="#invest-tab" data-toggle="tab">Get a loan <i class="fa"></i></a></li>
			</ul>

			<form id="accountForm" class="form-horizontal">
				<div class="tab-content">
					<div class="tab-pane active" id="borrow-tab">
						<form action="" class="form-horizontal">
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

							<div class="borrow-button pull-right"><button>Borrow now</button></div>
						</form>			
					</div>

					<div class="tab-pane" id="invest-tab">
						<div class="form-group">
							<label class="col-xs-3 control-label">Address</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="address" />
							</div>
						</div>
					</div>
				</div>

				<div class="form-group" style="margin-top: 15px;">
					<div class="col-xs-5 col-xs-offset-3">
						<button type="submit" class="btn btn-default">Validate</button>
					</div>
				</div>
			</form>

			<script>
                $(document).ready(function() {
                    $('#accountForm')
                        .formValidation({
                            framework: 'bootstrap',
                            // Only disabled elements are excluded
                            // The invisible elements belonging to inactive tabs must be validated
                            excluded: [':disabled'],
                            icon: {
                                valid: 'glyphicon glyphicon-ok',
                                invalid: 'glyphicon glyphicon-remove',
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            fields: {
                                fullName: {
                                    validators: {
                                        notEmpty: {
                                            message: 'The full name is required'
                                        }
                                    }
                                },
       
                                address: {
                                    validators: {
                                        notEmpty: {
                                            message: 'The address is required'
                                        }
                                    }
                                }
                               
                            }
                        })
                        .on('err.field.fv', function(e, data) {
                            // data.fv --> The FormValidation instance

                            // Get the first invalid field
                            var $invalidFields = data.fv.getInvalidFields().eq(0);

                            // Get the tab that contains the first invalid field
                            var $tabPane     = $invalidFields.parents('.tab-pane'),
                                invalidTabId = $tabPane.attr('id');

                            // If the tab is not active
                            if (!$tabPane.hasClass('active')) {
                                // Then activate it
                                $tabPane.parents('.tab-content')
                                    .find('.tab-pane')
                                    .each(function(index, tab) {
                                        var tabId = $(tab).attr('id'),
                                            $li   = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent();

                                        if (tabId === invalidTabId) {
                                            // activate the tab pane
                                            $(tab).addClass('active');
                                            // and the associated <li> element
                                            $li.addClass('active');
                                        } else {
                                            $(tab).removeClass('active');
                                            $li.removeClass('active');
                                        }
                                    });

                                // Focus on the field
                                $invalidFields.focus();
                            }
                        });
                });
			</script>
			
		</div>
	</div>

	<div class="row">
		<div class="box filter-box">
			<div class="col-lg-12">
				<div class="col-md-2">So tien vay</div>
				<div class="col-md-2">Thoi gian vay</div>
				<div class="col-md-2">Loai tien the chap</div>
				<div class="col-md-2">Lai suat</div>
				<div class="col-md-2">Loai tien nhan</div>
				<div class="col-md-2"><button>Search</button></div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>cac khoan vay da the chap</h3>
				<div class="table-responsive">
				<table class="table invest-table">
					<thead>
					<tr>
						<th style="width: 10%">#</th>
						<th style="width: 15%">Ngày kết thúc khoản vay</th>
						<th style="width: 15%">Ngày khởi tạo</th>
						<th style="width: 15%">Số tiền cần vay</th>
						<th style="width: 15%">Lãi suất</th>
						<th style="width: 15%">Số tiền lãi khi đáo hạn khoản vay</th>
						<th style="width: 15%">&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					<tr>
						<td style="width: 10%">1</td>
						<td style="width: 15%">10/10/2017</td>
						<td style="width: 15%">10/04/2017</td>
						<td style="width: 15%">10.000.000 vnđ</td>
						<td style="width: 15%">2%</td>
						<td style="width: 15%">450.000 vnđ</td>
						<td style="width: 15%"><button>Invest</button></td>
					</tr>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
@stop


