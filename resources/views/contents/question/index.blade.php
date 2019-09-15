@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Question</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Question Data</h3>
          @yield('message')
          <div class="box-tools">
            <a href="{{ url('admin/question/create') }}" class="btn btn-primary">
                Create
            </a>
          </div>
        </div>
        <!-- /.box-header -->
    	<div class="box-body">
    		<table id="example1" class="table table-bordered table-striped">
    			<thead>
	                <tr>
		                <th>No</th>
		                <th>Title</th>
		                <th>Created At</th>
		                <th>Updated At</th>
		                <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach ($questions as $index => $question)
	                	<tr>
		                	<td>{{ $index+1 }}</td>
		                	<td>{{ $question->question }}</td>
		                	<td>{{ $question->created_at }}</td>
		                	<td>{{ $question->updated_at }}</td>
		                	<td>
		                		<a class="btn btn-app" data-toggle="modal" data-target="#modal-edit{{ $question->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
		                		<a href="{{ url('admin/confluence/delete'.'/'.$question->id) }}" class="btn btn-app">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
		                </tr>
                	@endforeach
                </tbody>
    		</table>
    	</div>
    </div>
@stop

@section('css-pages')
	<link rel="stylesheet" src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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


	<!-- CK Editor -->
	<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<script>
	  	$(function () {
	    	// Replace the <textarea id="editor1"> with a CKEditor
	    	// instance, using default configuration.
	    	CKEDITOR.replace('editor1')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})
	</script>
@stop