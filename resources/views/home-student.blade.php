
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
				<div class="widget-user-header bg-blue">
					<h3 class="widget-user-username" align="center" style="text-shadow: 0 2px 0px rgba(21, 20, 20, 0.2);">Diagnostic Online Website of Physics</h3>
					<h3 class="widget-user-username" align="center" style="text-shadow: 0 2px 0px rgba(21, 20, 20, 0.2);">(DOW)</h3>
				</div>
				<div class="box-footer" style="background: url({{ asset('bg1.jpg') }}) center center;">
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
