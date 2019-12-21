
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li class="active"><a href="#">Profile</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $profile->title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! $profile->description !!}
        </div>
    <!-- /.box-body -->
    </div>
@stop

@section('css-custom')
@stop

@section('js-custom')
@stop