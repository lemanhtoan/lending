@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Confirm borrow</h2>
                <hr>

                <?php if(isset($mess)): ?>
                <div class="alert alert-success">
                    <h3><?php echo $mess; ?></h3>
                </div>
                <?php endif;?>

                <p>Please enter hash key to confirm borrow</p>

                {!! Form::open(['url' => 'confirmBorrow', 'method' => 'post', 'role' => 'form']) !!}

                <div class="row">

                    {!! Form::control('text', 12, 'keyHash', $errors, 'Hash key') !!}
                    <input type="hidden" name="borrowId" value="<?php echo $id;?>">

                    {!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop