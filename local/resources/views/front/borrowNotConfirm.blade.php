@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center"><?php if($ok =='IS_LOAN_CREATED') {?>
                    {!! trans('front/site.IS_LOAN_CREATED') !!}
                <?php } else {  echo $ok;}?></h2>
                <hr>
            </div>
        </div>
    </div>
@stop