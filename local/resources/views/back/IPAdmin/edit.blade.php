@extends('back.IPAdmin.template')

@section('form')
	{!! Form::model($post, ['route' => ['IPAdmin.update', $post->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
@stop
