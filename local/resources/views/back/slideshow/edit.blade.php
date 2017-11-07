@extends('back.slideshow.template')

@section('form')
	{!! Form::model($post, ['route' => ['slideshow.update', $post->id], 'method' => 'put', 'class' => 'form-horizontal panel', 'files' => true]) !!}
@stop
