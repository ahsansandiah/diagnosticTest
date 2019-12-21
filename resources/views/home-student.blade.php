
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
          	<!-- Widget: user widget style 1 -->
          	<div class="box box-widget widget-user">
            	<!-- Add the bg color to the header using any of the bg-* classes -->
            	<div class="widget-user-header bg-black" style="background: url({{ asset('bg1.jpg') }}) center center;">
              		<h3 class="widget-user-username">SYSTEM DIAGNOSTIC AND FORMATIVE TEST</h3>
              		<h5 class="widget-user-desc">TEAM A</h5>
            	</div>
            	<div class="widget-user-image">
              		{{-- <img class="img-circle" src="../dist/img/user3-128x128.jpg" alt="User Avatar"> --}}
            	</div>
            	<div class="box-footer">
              		<div class="row">
              		</div>
              		<!-- /.row -->
            	</div>
          	</div>
          	<!-- /.widget-user -->
        </div>
	</div>
@stop

@section('css-custom')
@stop

@section('js-custom')
@stop
