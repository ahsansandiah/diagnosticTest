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
	    			<form class="form-horizontal" method="get" action="{{ url('admin/report/diagnostic') }}">
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
	              			<label for="inputEmail3" class="col-sm-2 control-label">Questions</label>
	              			<div class="col-sm-9">
	                			<select class="form-control" id="inputEmail3" name="question_id">
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
	      			<div class="chart" id="bar-chart" style="height: 300px;"></div>
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
			                  	<th>Number</th>
			                  	<th>Qustions</th>
			                  	<th>Total</th>
			                  	<th>Percentage</th>
			                </tr>
			            </thead>
	        			<tbody>
	        				@foreach ($listAnswers as $key => $answer)
	        					<tr>
	              					<th style="width: 10px">{{ $answer->id }}</th>
	        						<th>{{ $answerSort[$key] }}</th>
	              					<th>{!! $answer->answer !!}</th>
	              					@if (!empty($answers[$answer->id]))
	              						<th>{{ $answers[$answer->id] }}</th>
	              						<th>{{ ($answers[$answer->id]/$totalStudents)*100 }}%</th>
	              					@else
	              						<th>0</th>
	              						<th>{{ (0/$totalStudents)*100 }}%</th>
	              					@endif
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
    		// LINE CHART
    		var line = new Morris.Bar({
		      	element: 'bar-chart',
		      	resize: true,
		      	data: [
		      		@if (!empty($listAnswers))
	  					@foreach ($listAnswers as $key => $answer)
	  						@if (!empty($answers[$answer->id]))
	  							{y: '{{$answerSort[$key]}}', total: '{{$answers[$answer->id]}}' },
	  						@else
	  							{y: '{{$answerSort[$key]}}', total: '0' },
	  						@endif
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
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('select[name="confluence_id"]').on('change', function() {
	            var confluenceId = $(this).val();
	            var baseUrl = '{{ url('admin/confluence/') }}';
	            console.log(confluenceId);
	            if(confluenceId) {
	                $.ajax({
	                    url: baseUrl+'/'+confluenceId+'/questions',
	                    type: "GET",
	                    dataType: "json",
	                    success:function(data) {
	                       	console.log(data);
	                        $('select[name="question_id"]').empty();
	                        $.each(data, function(key, value) {
	                        	console.log(value)
	                            $('select[name="question_id"]').append('<option value="'+ value['id'] +'"> Soal No.'+value['order']+' | '+ value['question'] +'</option>');
	                        });


	                    }
	                });
	            }else{
	                $('select[name="question_id"]').empty();
	            }
	        });
	    });
	</script>
@stop