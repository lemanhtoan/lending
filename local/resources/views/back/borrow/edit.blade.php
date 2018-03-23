@extends('back.borrow.template')

@section('form')
	{!! Form::model($post, ['route' => ['borrow.update', $post->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
@stop
