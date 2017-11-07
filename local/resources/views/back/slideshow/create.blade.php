@extends('back.slideshow.template')

@section('form')
	{!! Form::open(['url' => 'slideshow', 'method' => 'post', 'class' => 'form-horizontal panel', 'files' => true]) !!}
@stop
