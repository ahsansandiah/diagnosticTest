@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Media</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-default"><b>Add New</b></a>
		            </div>
		            <div class="modal fade" id="modal-default">
		          		<div class="modal-dialog">
		            		<div class="modal-content">
		              			<div class="modal-header">
		                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  			<span aria-hidden="true">&times;</span></button>
		                			<h4 class="modal-title">Add New FILE</h4>
		              			</div>
		              			<div class="modal-body">
		                			<!-- form start -->
						            <form role="form" method="POST" action="{{ url('admin/media/store') }}" enctype="multipart/form-data">
						            	@csrf
						              	<div class="box-body">
						               		<div class="form-group">
						                  		<label for="">Title</label>
						                  		<input type="text" class="form-control" id="" name="title" value="">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">Description</label>
						                  		<input type="text" class="form-control" id="" name="description">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">FILE</label>
						                  		<input type="file" class="form-control" id="" name="file">
						                	</div>
						              	</div>
						              	<!-- /.box-body -->
						              	<div class="box-footer">
						                	<button type="submit" class="btn btn-primary">Submit</button>
						                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						              	</div>
						            </form>
		              			</div>
			              		<div class="modal-footer">
			              		</div>
		            		</div>
		            		<!-- /.modal-content -->
		          		</div>
		          		<!-- /.modal-dialog -->
		        	</div>
		        	<!-- /.modal -->
				</div>

				<div class="box-body box-profile">
					<table class="table table-bordered">
		                <tbody>
		                	<tr>
			                  	<th style="width: 10px">#</th>
			                  	<th>Title</th>
			                  	<th>Description</th>
			                  	<th>preview</th>
			                  	<th>Action</th>
		                	</tr>
		                	@foreach ($files as $key => $file)
				                <tr>
				                  	<td>{{ $key+1 }}</td>
				                  	<td>{{ $file->title }}</td>
				                  	<td>{{ $file->description}}</td>
				                  	@if($file->file_type == "pdf")
				                  		<td><iframe src ="{{ $path.'/'.$file->file_name}}" width="30%" height="70%"></iframe></td>
				                  	@else
				                  		<td>
				                  			@php($url = "https://docs.google.com/gview?url=".$path.'/'.$file->file_name."&embedded=true")
				                  			<iframe class="doc" src="{{ $url }}"></iframe>
				                  	@endif
				                  	<td>
				                  		<a href="{{ $path.'/'.$file->file_name }}" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-download"></i> Download</a>
				                  		<a href="{{ url('admin/media/delete/'.$file->id.'/file' )}}" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete</a>
				                  	</td>
				                </tr>
			                @endforeach
		             	</tbody>
		             </table>
				</div>

				<div class="box-footer box-profile">
					{{ $files->links() }}
				</div>
			</div>
        </div>
        <!-- /.col -->
	</div>
@stop

@section('css-pages')
@stop

@section('js-pages')
@stop