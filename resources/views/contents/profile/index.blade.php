@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Profile</h1>
@stop

@section('content')
	<div class="row">
		<!-- /.col -->
		<div class="col-md-12">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-header with-border">
		  			<blockquote><b>{{ $profile->title }} </b></blockquote>
				</div>
				<div class="box-body box-profile">
					{{-- {{ strip_tags($profile->description) }} --}}
					{!! $profile->description !!}
				</div>
				<div class="box-footer box-profile">
					<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default"><b>Edit</b></a>
		            <div class="modal fade" id="modal-default">
		          		<div class="modal-dialog">
		            		<div class="modal-content">
		              			<div class="modal-header">
		                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  			<span aria-hidden="true">&times;</span></button>
		                			<h4 class="modal-title">Profile</h4>
		              			</div>
		              			<div class="modal-body">
		                			<!-- form start -->
						            <form role="form" method="POST" action="{{ url('admin/profile/store') }}">
						            	@csrf
						              	<div class="box-body">
						               		<div class="form-group">
						                  		<label for="exampleInputEmail1">Title</label>
						                  		<input type="text" class="form-control" id="" name="title" value="{{ $profile->title }}">
						                  		<input type="hidden" class="form-control" id="" name="type" value="Profile">
						                	</div>
						                	<div class="form-group">
						                  		<label for="exampleInputPassword1">Description</label>
						                  		<textarea id="editor2" class="form-control" id="" name="description" rows="10" cols="80">{{ $profile->description }}</textarea>
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
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
@stop

@section('css-pages')
@stop

@section('js-pages')
<!-- CK Editor -->
<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  	$(function () {
    	// Replace the <textarea id="editor1"> with a CKEditor
    	// instance, using default configuration.
    	CKEDITOR.replace('editor2')
    	//bootstrap WYSIHTML5 - text editor
    	$('.textarea').wysihtml5()
  	})
</script>
@stop