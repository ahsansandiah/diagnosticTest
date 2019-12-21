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
		                			<h4 class="modal-title">Add New Media</h4>
		              			</div>
		              			<div class="modal-body">
		                			<!-- form start -->
						            <form role="form" method="POST" action="{{ url('admin/theory/media/store/'.$id) }}" enctype="multipart/form-data">
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
		                	@foreach ($medias as $key => $file)
				                <tr>
				                  	<td>{{ $key+1 }}</td>
				                  	<td>{{ $file->media->title }}</td>
				                  	<td>{{ $file->media->description}}</td>
				                  	@if($file->media->file_type == "pdf")
				                  		<td><iframe src ="{{ $path.'/files/'.$file->media->file_name}}" width="30%" height="70%"></iframe></td>
				                  	@elseif(in_array($file->media->file_type, ["jpg", "jpeg", "png"]))
				                  		<td><img src="{{ $path.'/images/'.$file->media->file_name}}" width="30%"></td>
				                  	@else
				                  		<td>
				                  			@php($url = "https://docs.google.com/gview?url=".$path.'/files/'.$file->media->file_name."&embedded=true")
				                  			<iframe class="doc" src="{{ $url }}"></iframe>
				                  	@endif
				                  	<td>
				                  		<a href="{{ url('admin/theory/media/delete/'.$file->media->id.'/'.$id )}}" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete</a>
				                  	</td>
				                </tr>
			                @endforeach
		             	</tbody>
		             </table>
				</div>

				<div class="box-footer box-profile">
					{{ $medias->links() }}
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