<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coin Cash Loan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! HTML::style('css/main_back.css') !!}

		<!--[if (lt IE 9) & (!IEMobile)]>
    {!! HTML::script('js/vendor/respond.min.js') !!}
    <![endif]-->
    <!--[if lt IE 9]>
    {{ HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
    {{ HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->

    {!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') !!}
    {!! HTML::style('http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic') !!}

    @yield('head')

    <script type="text/javascript" src="{!! url('plugin/ckeditor/ckeditor.js') !!}"></script>
</head>

<body>

<!--[if lte IE 7]>
<p class="browsehappy">Vous utilisez un navigateur <strong>obsolète</strong>. S'il vous plaît <a href="http://browsehappy.com/">Mettez le à jour</a> pour améliorer votre navigation.</p>
<![endif]-->

<div class="container">

        @yield('main')

</div>

{!! HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
{!! HTML::script('js/plugins.js') !!}
{!! HTML::script('js/main.js') !!}

@yield('scripts')

</body>
</html>