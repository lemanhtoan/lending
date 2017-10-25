@extends('front.template')

@section('main')

	<?php if (isset($ok)):?>
		@include('partials/error', ['type' => 'success', 'message' => $ok])
	<?php endif;?>

    <?php if (isset($warning)):?>
	@include('partials/error', ['type' => 'warning', 'message' => $warning])
    <?php endif;?>

    <?php if (isset($error)):?>
		@include('partials/error', ['type' => 'danger', 'message' => $error])
    <?php endif;?>

	<div class="row">
		<div class="box result-box">
			<div class="col-lg-12">
				<h3>Xác thực người vay</h3>
				<h5>Xác thực qua CMTND hoặc Passport</h5>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#verifiedCode">CMTND</a></li>
					<li><a data-toggle="tab" href="#verifiedPassport">Passport</a></li>
				</ul>

				<div class="tab-content">
					<div id="verifiedCode" class="tab-pane fade in active">
						<h3>CMTND</h3>
						<div class="tab-item">
							<form action="{!! url('uploadVerified') !!}" id="uploadVerified" class="form-horizontal" enctype="multipart/form-data" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="isType" value="0">
								<div class="form-group">
									<label class="control-label col-sm-6" for="email">Front-end:</label>
									<div class="col-sm-6">
										<input type="file" required class="form-control" id="front_end" name="front_end">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-6" for="email">Backend-end:</label>
									<div class="col-sm-6">
										<input type="file" required class="form-control" id="back_end" name="back_end">
									</div>
								</div>
								<div class="borrow-button pull-right"><input type="submit" value="Upload CMTND"/></div>
							</form>
						</div>
					</div>
					<div id="verifiedPassport" class="tab-pane fade">
						<h3>Passport</h3>
						<div class="tab-item">
							<form action="{!! url('uploadVerified') !!}" id="uploadVerified" class="form-horizontal" enctype="multipart/form-data" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="isType" value="1">
								<div class="form-group">
									<label class="control-label col-sm-6" for="email">Front-end:</label>
									<div class="col-sm-6">
										<input type="file"  required class="form-control" id="front_end" name="front_end">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-6" for="email">Backend-end:</label>
									<div class="col-sm-6">
										<input type="file" required class="form-control" id="back_end" name="back_end">
									</div>
								</div>
								<div class="borrow-button pull-right"><input type="submit" value="Upload passport"/></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop


