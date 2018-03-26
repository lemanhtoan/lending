@extends('front.template')

@section('main')

    <div class="row">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">{!! trans('front/site.message') !!}</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <?php if (count($posts)) {  $i=0;?>
        @foreach($posts as $post)
            <?php $i++;?>
            <div class="box">
                <div class="col-lg-12">
                    <?php if ($post->status =='0') {?>
                        <p>#<?php echo $i; ?>: {!! $post->message !!} {!! link_to('message/' . $post->id, trans('front/blog.read'), ['class' => '']) !!}</p>
                    <?php } else { ?>
                        <p>#<?php echo $i; ?>: {!! $post->message !!}</p>
                    <?php } ?>

                </div>
            </div>
        @endforeach
        <?php } else { ?>
            <h6 style="text-align: center">No item.</h6>
        <?php } ?>

    </div>

@stop

