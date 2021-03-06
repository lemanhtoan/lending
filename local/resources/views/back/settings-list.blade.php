@extends('back.template')
@section('main')

    @include('back.partials.entete', ['title' => 'Cài đặt khác' ])

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (Session()->has('flash_level'))
        <div class="alert alert-success">
            <ul>
                {!! Session::get('flash_massage') !!}
            </ul>
        </div>
    @endif

    <div class="settings panel-body" style="float: left;width: 100%; padding: 20px;">
        <div class="row">
            <form action="settings" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group"> <?php $dataLogoGet = $dataLogo[0]['content']; ?>
                    Ảnh hiện tại: <br><?php if ( isset($dataLogoGet)) {?><img src="{!!url('uploads/commons/'.$dataLogoGet)!!}" alt="" width="120"> <?php } ?>
                </div>
                <div class="form-group">
                    Logo: <input type="file" name="value"   class="form-control">
                </div>
                <input type="hidden" name="stype" value="dataLogo">
                <input type="submit" class="btn btn-primary" value="Lưu logo" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $dataHotline = $dataHotline[0]['content']; ?>
                        Hotline : <input type="text" name="value" class="form-control" value="<?php if ( isset($dataHotline)) { echo $dataHotline;} ?>">
                </div>
                <input type="hidden" name="stype" value="dataHotline">
                <input type="submit"  class="btn btn-primary" value="Lưu Hotline" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $emailadmin = $emailadmin[0]['content']; ?>
                    Email admin : <input type="email" name="value" class="form-control" value="<?php if ( isset($emailadmin)) { echo $emailadmin;} ?>">
                </div>
                <input type="hidden" name="stype" value="emailadmin">
                <input type="submit"  class="btn btn-primary" value="Lưu Email admin" class="button" />
            </form>
        </div>


        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $emailsupport = $emailsupport[0]['content']; ?>
                        Email support : <input type="email" name="value" class="form-control" value="<?php if ( isset($emailsupport)) { echo $emailsupport;} ?>">
                </div>
                <input type="hidden" name="stype" value="emailsupport">
                <input type="submit"  class="btn btn-primary" value="Lưu Email support" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $mainbg = $mainbg[0]['content']; ?>
                        Main background : <input type="color" name="value" class="form-control" value="<?php if ( isset($mainbg)) { echo $mainbg;} ?>">
                </div>
                <input type="hidden" name="stype" value="mainbg">
                <input type="submit" class="btn btn-primary" value="Lưu Main background" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $maincolor = $maincolor[0]['content']; ?>
                        Main color : <input type="color" name="value" class="form-control" value="<?php if ( isset($maincolor)) { echo $maincolor;} ?>">
                </div>
                <input type="hidden" name="stype" value="maincolor">
                <input type="submit" class="btn btn-primary" value="Lưu Main color" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    Số tiền khởi tạo : <input type="text" name="value" class="form-control" value="">
                </div>
                <input type="hidden" name="stype" value="khoitao">
                <input type="submit"  class="btn btn-primary" value="Lưu khởi tạo tiền cho NĐT đặc biệt" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $laisuat = $laisuat[0]['content']; ?>
                        Lãi suất : <input type="text" name="value" class="form-control" value="<?php if ( isset($laisuat)) { echo $laisuat;} ?>">
                </div>
                <input type="hidden" name="stype" value="laisuat">
                <input type="submit"  class="btn btn-primary" value="Lưu Lãi suất" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $minday = $minday[0]['content']; ?>
                    Số ngày vay tiền tối thiểu : <input type="text" name="value" class="form-control" value="<?php if ( isset($minday)) { echo $minday;} ?>">
                </div>
                <input type="hidden" name="stype" value="minday">
                <input type="submit"  class="btn btn-primary" value="Lưu số ngày vay tiền tối thiểu" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $tygiaUV = $tygiaUV[0]['content']; ?>
                        Tỷ giá USD/VNĐ : <input type="text" name="value" class="form-control" value="<?php if ( isset($tygiaUV)) { echo $tygiaUV;} ?>">
                </div>
                <input type="hidden" name="stype" value="tygiaUV">
                <input type="submit"  class="btn btn-primary" value="Lưu Tỷ giá USD/VNĐ" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $daylost = $daylost[0]['content']; ?>
                        Số ngày mất thế chấp : <input type="text" name="value" class="form-control" value="<?php if ( isset($daylost)) { echo $daylost;} ?>">
                </div>
                <input type="hidden" name="stype" value="daylost">
                <input type="submit"  class="btn btn-primary" value="Lưu Số ngày mất thế chấp" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $dayredm = $dayredm[0]['content']; ?>
                        Số ngày nhắc nhở : <input type="text" name="value" class="form-control" value="<?php if ( isset($dayredm)) { echo $dayredm;} ?>">
                </div>
                <input type="hidden" name="stype" value="dayredm">
                <input type="submit"  class="btn btn-primary" value="Lưu Số ngày nhắc nhở" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $maxqty = $maxqty[0]['content']; ?>
                        Số lần vay tối đa : <input type="text" name="value" class="form-control" value="<?php if ( isset($maxqty)) { echo $maxqty;} ?>">
                </div>
                <input type="hidden" name="stype" value="maxqty">
                <input type="submit"  class="btn btn-primary" value="Lưu Số lần vay tối đa" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $maxverified = $maxverified[0]['content']; ?>
                        Số tiền vần admin duyệt : <input type="text" name="value" class="form-control" value="<?php if ( isset($maxverified)) { echo $maxverified;} ?>">
                </div>
                <input type="hidden" name="stype" value="maxverified">
                <input type="submit"  class="btn btn-primary" value="Lưu Số tiền vần admin duyệ" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $ccl = $ccl[0]['content']; ?>
                        Tỷ giá CCL : <input type="text" name="value" class="form-control" value="<?php if ( isset($ccl)) { echo $ccl;} ?>">
                </div>
                <input type="hidden" name="stype" value="ccl">
                <input type="submit"  class="btn btn-primary" value="Lưu Tỷ giá CCL" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $adminrate = $adminrate[0]['content']; ?>
                    Admin rate : <input type="text" name="value" class="form-control" value="<?php if ( isset($adminrate)) { echo $adminrate;} ?>">
                </div>
                <input type="hidden" name="stype" value="adminrate">
                <input type="submit" class="btn btn-primary" value="Lưu Admin rate" class="button" />
            </form>
        </div>

        <div class="row">
            <form action="settings" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <?php $crate = $crate[0]['content']; ?>
                    % rate : <input type="text" name="value" class="form-control" value="<?php if ( isset($crate)) { echo $crate;} ?>">
                </div>
                <input type="hidden" name="stype" value="crate">
                <input type="submit" class="btn btn-primary" value="Lưu % rate" class="button" />
            </form>
        </div>


        <div class="row">
            <form action="settings" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    Footer:
                    <textarea name="value" id="footer" class="form-control" rows="4"  >
										<?php $footer = $footer[0]['content']; ?>
                        <?php if ( isset($footer)) {echo $footer;} ?>
									</textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace('footer',{
                            language:'vi',
                            filebrowserImageBrowseUrl : '../../plugin/ckfinder/ckfinder.html?Type=Images',
                            filebrowserFlashBrowseUrl : '../../plugin/ckfinder/ckfinder.html?Type=Flash',
                            filebrowserImageUploadUrl : '../../plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserFlashUploadUrl : '../../plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                        });
                    </script>
                </div>
                <input type="hidden" name="stype" value="footer">
                <input type="submit" class="btn btn-primary" value="Lưu footer" class="button" />
            </form>
        </div>

    </div>

    <style>
        .settings .row {
            margin: 10px 0;
            border-bottom: 2px dotted #dadada;
            padding: 10px 0;
        }
    </style>
@stop
