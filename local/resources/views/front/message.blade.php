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

        @foreach($posts as $post)
            <div class="box">
                <div class="col-lg-12">
                    <?php if ($post->status =='0') {?>
                        <p>{!! $post->message !!} {!! link_to('message/' . $post->id, trans('front/blog.read'), ['class' => '']) !!}</p>
                    <?php } else { ?>
                        <p>{!! $post->message !!}</p>
                    <?php } ?>

                </div>
            </div>
        @endforeach

    </div>

@stop

