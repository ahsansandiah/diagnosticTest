
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">KI and KD</a></li>
      	<li class="active">KD</li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-warning"></i>
            <h3 class="box-title">{!! $kd->title !!}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! $kd->description !!}
        </div>
    <!-- /.box-body -->
    </div>
@stop

@section('css-custom')
@stop

@section('js-custom')
@stop