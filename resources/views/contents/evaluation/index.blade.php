@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Evaluation : {{ $package }}</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header">
          	<h3 class="box-title"></h3>
          	<div class="col-md-6">
          		<form role="form" method="GET" action="{{ url('admin/evaluation/'.$package) }}">
		          	<div class="form-group">
		          		<label for="inputStudent">Student</label>
		        		<select class="form-control" name="student_id">
		        			@foreach($students as $student)
		        				<option value="{{ $student->id }}" {{ ($student->id == $student_selected) ? 'selected' : ''}}>{{ $student->name }}</option>
		        			@endforeach
		        		</select>
		        	</div>
		        	<div class="form-group">
		          		<label for="inputConfluence">Confluence</label>
		        		<select class="form-control" name="confluence_id">
		        			@foreach ($confluences as $confluence)
		        				<option value="{{ $confluence->id }}">{{ $confluence->confluence }}</option>
		        			@endforeach
		        		</select>
		        	</div>
		        	<div class="form-group">
		          		<button type="submit" class="btn btn-primary pull-right">Search</button>
		        	</div>
	          	</form>
          	</div>

    		<div class="col-md-6">
	          	<div class="box box-solid">
	            	<!-- /.box-header -->
	            	<div class="box-body">
			            <dl class="dl-horizontal">
			                <dt>Total Question : </dt>
			                <dd>{{ $totalQuestion }}</dd>
			                <dt>Total Answer (Correct)</dt>
			                <dd>{{ $totalCorrectAnswer }}</dd>
			                <dt>Score</dt>
			                <dd>{{ $totalScore }}</dd>
			            </dl>
	            	</div>
	            <!-- /.box-body -->
	         	</div>
	          	<!-- /.box -->
	        </div>
          
          	@yield('message')
          	<div class="box-tools">
            {{-- <a href="{{ url('admin/question/create') }}" class="btn btn-primary">
                Create
            </a> --}}
          	</div>
        </div>
        <!-- /.box-header -->
    	<div class="box-body">
	        <div class="col-md-12">
	        	<div class="box box-solid">
	            	<!-- /.box-header -->
	            	<div class="box-body">
	            		<table id="example1" class="table table-bordered table-striped">
			    			<thead>
				                <tr>
					                <th>No</th>
					                <th>Name</th>
					                <th>Confluence</th>
					                <th>Score</th>
					                <th>Time</th>
					                <th>Date</th>
					                <th>Action</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@foreach($evaluations as $index => $evaluation)
			                		<tr>
					                	<td>{{ $index+1 }}</td>
					                	<td>{{ $evaluation->student['name'] }}</td>
					                	<td>{{ $evaluation->confluence['confluence'] }}</td>
					                	<td>{{ $evaluation->score }}</td>
					                	<td>{{ $evaluation->time }}</td>
					                	<td>{{ $evaluation->created_at }}</td>
					                	<td>
					                		<a href="{{ url('admin/evaluation/detail/'.$evaluation->id.'/'.$evaluation->student_id) }}" class="btn btn-app">
			                                    <i class="fa fa-list-ul"></i> Detail
			                                </a>
					                	</td>
					                </tr>
			                	@endforeach
			                </tbody>
			    		</table>
	            	</div>
	            </div>
	        </div>
    		
    	</div>
    </div>
@stop

@section('css-pages')
@stop

@section('js-pages')
	<!-- DataTables -->
	<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<script>
	  $(function () {
	    $('#example1').DataTable()
	  })
	</script>
@stop