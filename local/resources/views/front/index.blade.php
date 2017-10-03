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

		<div class="col-md-4 home-login">

			<style type="text/css">
				#accountForm {
					margin-top: 15px;
				}
			</style>

			<ul class="nav nav-tabs">
				<li class="active"><a href="#info-tab" data-toggle="tab">Information <i class="fa"></i></a></li>
				<li><a href="#address-tab" data-toggle="tab">Address <i class="fa"></i></a></li>
			</ul>

			<form id="accountForm" class="form-horizontal">
				<div class="tab-content">
					<div class="tab-pane active" id="info-tab">
						<div class="form-group">
							<label class="col-xs-3 control-label">Full name</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="fullName" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Company</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="company" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Job title</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="jobTitle" />
							</div>
						</div>
					</div>

					<div class="tab-pane" id="address-tab">
						<div class="form-group">
							<label class="col-xs-3 control-label">Address</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="address" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">City</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="city" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Country</label>
							<div class="col-xs-5">
								<select class="form-control" name="country">
									<option value="">Select a country</option>
									<option value="FR">France</option>
									<option value="DE">Germany</option>
									<option value="IT">Italy</option>
									<option value="JP">Japan</option>
									<option value="RU">Russian</option>
									<option value="US">United State</option>
									<option value="GB">United Kingdom</option>
									<option value="other">Other</option>
								</select>
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
                                company: {
                                    validators: {
                                        notEmpty: {
                                            message: 'The company name is required'
                                        }
                                    }
                                },
                                address: {
                                    validators: {
                                        notEmpty: {
                                            message: 'The address is required'
                                        }
                                    }
                                },
                                city: {
                                    validators: {
                                        notEmpty: {
                                            message: 'The city is required'
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
		<div class="col-md-8 home-slider">
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
	</div>

	<div class="row home-feature">
		<div class="col-md-6 invest">
			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>Ngày kết thúc khoản vay</th>
						<th>Ngày khởi tạo</th>
						<th>Số tiền cần vay</th>
						<th>Lãi suất</th>
						<th>Số tiền lãi khi đáo hạn khoản vay</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="radio" name="invest" value="1"></td>
						<td>10/10/2017</td>
						<td>10/04/2017</td>
						<td>10.000.000 vnđ</td>
						<td>2%</td>
						<td>450.000 vnđ</td>
					</tr>
					<tr>
						<td><input type="radio" name="invest" value="2"></td>
						<td>10/10/2017</td>
						<td>10/04/2017</td>
						<td>10.000.000 vnđ</td>
						<td>2%</td>
						<td>450.000 vnđ</td>
					</tr>
					<tr>
						<td><input type="radio" name="invest" value="3"></td>
						<td>10/10/2017</td>
						<td>10/04/2017</td>
						<td>10.000.000 vnđ</td>
						<td>2%</td>
						<td>450.000 vnđ</td>
					</tr>
					</tbody>
				</table>
			</div>

			<div class="invest-button"><button>Invest now</button></div>
		</div>
		<div class="col-md-6 borrow">
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
	</div>
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>
				<h2 class="intro-text text-center"><strong>Comitem</strong></h2>
				<hr>
				<img class="img-responsive img-left" src="img/laravel-l-slant.png" alt="">
				<p>Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris.</p>
				<p>Quo cognito Constantius ultra mortalem modum exarsit ac nequo casu idem Gallus de futuris incertus agitare quaedam conducentia saluti suae per itinera conaretur, remoti sunt omnes.</p>
				<p>Eminuit autem inter humilia supergressa iam impotentia fines mediocrium delictorum nefanda Clematii cuiusdam Alexandrini nobilis mors repentina; cuius socrus cum misceri sibi generum, flagrans eius amore, non impetraret, ut ferebatur, per palatii pseudothyrum introducta, oblato pretioso reginae monili id adsecuta est, ut ad Honoratum tum comitem orientis formula missa letali omnino scelere nullo contactus idem Clematius nec hiscere nec loqui permissus occideretur.</p>
				<p>Cuius acerbitati uxor grave accesserat incentivum, germanitate Augusti turgida supra modum, quam Hannibaliano regi fratris filio antehac Constantinus iunxerat pater, Megaera quaedam mortalis, inflammatrix saevientis adsidua, humani cruoris avida nihil mitius quam maritus; qui paulatim eruditiores facti processu temporis ad nocendum per clandestinos versutosque rumigerulos conpertis leviter addere quaedam male suetos falsa et placentia sibi discentes, adfectati regni vel artium nefandarum calumnias insontibus adfligebant.</p>
				<p>Montius nos tumore inusitato quodam et novo ut rebellis et maiestati recalcitrantes Augustae per haec quae strepit incusat iratus nimirum quod contumacem praefectum, quid rerum ordo postulat ignorare dissimulantem formidine tenus iusserim custodiri.</p>
			</div>
		</div>
	</div>

@stop


