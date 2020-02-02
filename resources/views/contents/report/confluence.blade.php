@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Report Confluence</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-7">
	  		<div class="box box-info">
	    		<div class="box-header">
	    		</div>
	    		<div class="box-body no-padding">
	    			<form class="form-horizontal" method="get" action="{{ url('admin/report/by-confluence') }}">
	            		<div class="form-group">
	              			<label for="inputEmail3" class="col-sm-2 control-label">Confluence</label>

	              			<div class="col-sm-9">
	                			<select class="form-control" id="inputEmail3" name="confluence_id">
	                				@foreach ($confluences as $element)
	                					<option value="{{ $element->id }}" {{ ($lastId == $element->id) ? 'selected' : '' }}>{{ $element->confluence }}</option>
	                				@endforeach
	                			</select>
	              			</div>
	            		</div>
	            		<div class="form-group">
	            			<div class="col-sm-12">
	            				<button type="submit" class="btn btn-info pull-right"  style="margin-right: 58px;">Filter</button>
	            			</div>
	            		</div>
        			</form>
	  			</div>
			</div>
		</div>
		<div class="col-md-12">
	  		<div class="box box-info">
	    		<div class="box-header">
	      			<h3 class="box-title">Chart Of Questions</h3>
	     			<div class="box-tools">
	      			</div>
	    		</div>
	    		<!-- /.box-header -->
	    		<div class="box-body no-padding">
	      			<div class="chart" id="line-chart" style="height: 300px;"></div>
	    		</div>
	   			<!-- /.box-body -->
	  		</div>
	 		<!-- /.box -->
		</div>
		<div class="col-md-12">
	  		<div class="box box-info">
	    		<div class="box-header">
	      			<h3 class="box-title">List Of Questions</h3>
	     			<div class="box-tools">
	                	<ul class="pagination pagination-sm no-margin pull-right">
	                	</ul>
	      			</div>
	    		</div>
	    		<!-- /.box-header -->
	    		<div class="box-body no-padding">
	      			<table id="example2" class="table table-bordered table-hover">
	      				<thead>
			                <tr>
			                  	<th>ID</th>
			                  	<th>Qustions</th>
			                  	<th>Count</th>
			                </tr>
			            </thead>
	        			<tbody>
	        				@foreach ($listQuestions as $question)
	        					<tr>
	              					<th style="width: 10px">{{ $question->id }}</th>
	              					<th>{!! $question->question !!}</th>
	              					<th>{{ $questions[$question->id] }}</th>
	            				</tr>
	        				@endforeach
	      				</tbody>
	      			</table>
	    		</div>
	   			<!-- /.box-body -->
	  		</div>
	 		<!-- /.box -->
		</div>
	</div>
	
@stop

@section('css-pages')
	<link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
@stop

@section('js-pages')
	<!-- DataTables -->
	<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
	<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<script type="text/javascript">
		$(function () {
    		"use strict";

    		// LINE CHART
    		var line = new Morris.Line({
		      	element: 'line-chart',
		      	resize: true,
		      	data: [
		      		@if (!empty($questions))
	   					@foreach ($questions as $key => $element)
	  						{y: '{{$key}}', total: '{{$element}}' },
	  					@endforeach
  	 				@endif
		      	],
		      	xkey: 'y',
		      	ykeys: ['total'],
		      	labels: ['Total'],
		      	lineColors: ['#3c8dbc'],
		      	hideHover: 'auto'
		    });
    	});
	</script>
	<script type="text/javascript">
	    $('#example2').DataTable({
	      	'paging'      : true,
	      	'lengthChange': false,
	      	'searching'   : false,
	      	'ordering'    : true,
	      	'info'        : true,
	      	'autoWidth'   : false
	    })
	</script>
@stop