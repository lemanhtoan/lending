@extends('back.templateLogin')

@section('main')
    <div class="row">
        <div class="col-lg-12" style="background-color: #fff;">
            @if(session()->has('error'))
                @include('partials/error', ['type' => 'danger', 'message' => session('error')])
            @endif
            <hr>
            <h2 class="intro-text text-center">Login Admin</h2>
            <hr>

            {!! Form::open(['url' => 'administrator', 'method' => 'post', 'role' => 'form']) !!}

            <div class="row">
                <?php
                // Function to get the client IP address
                function get_client_ip() {
                    $ipaddress = '';
                    if (isset($_SERVER['HTTP_CLIENT_IP']))
                        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                    else if(isset($_SERVER['REMOTE_ADDR']))
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                    else
                        $ipaddress = 'UNKNOWN';
                    return $ipaddress;
                }
                $user_ip = get_client_ip();
                ?>
                {!! Form::control('text', 12, 'log', $errors, trans('front/login.log')) !!}
                {!! Form::control('password', 12, 'password', $errors, trans('front/login.password')) !!}
                <input type="hidden" name="ipaddress" value="<?php echo $user_ip;?>">
                {!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop


