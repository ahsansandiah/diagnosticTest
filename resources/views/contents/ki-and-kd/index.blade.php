@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
	<h1>KI and KD</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
          	<!-- Custom Tabs -->
          	<div class="nav-tabs-custom">
            	<ul class="nav nav-tabs">
              		<li class="active"><a href="#tab_1" data-toggle="tab">KI</a></li>
              		<li><a href="#tab_2" data-toggle="tab">KD</a></li>
            	</ul>
            	<div class="tab-content">
              		<div class="tab-pane active" id="tab_1">
                		<b>{{ $ki->title }}</b>
                		<hr>
		                <p>{!! $ki->description !!}<hr>
		                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default-ki"><b>Edit</b></a>
			            <div class="modal fade" id="modal-default-ki">
			          		<div class="modal-dialog">
			            		<div class="modal-content">
			              			<div class="modal-header">
			                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  			<span aria-hidden="true">&times;</span></button>
			                			<h4 class="modal-title">KI</h4>
			              			</div>
			              			<div class="modal-body">
			                			<!-- form start -->
							            <form role="form" method="POST" action="{{ url('admin/ki-and-kd/store/ki') }}">
							            	@csrf
							              	<div class="box-body">
							               		<div class="form-group">
							                  		<label for="exampleInputEmail1">Title</label>
							                  		<input type="text" class="form-control" id="" name="title" value="{{ $ki->title }}">
							                  		<input type="hidden" class="form-control" id="" name="type" value="KI">
							                	</div>
							                	<div class="form-group">
							                  		<label for="exampleInputPassword1">Description</label>
							                  		<textarea id="editor-ki" class="form-control" id="" name="description" rows="10" cols="80">{{ $ki->description }}</textarea>
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
              		<!-- /.tab-pane -->
              		<div class="tab-pane" id="tab_2">
		                <b>{{ $kd->title }}</b>
		                <hr>
		                <p>{!! $kd->description !!}
		                <hr>
		                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default-kd"><b>Edit</b></a>
			            <div class="modal fade" id="modal-default-kd">
			          		<div class="modal-dialog">
			            		<div class="modal-content">
			              			<div class="modal-header">
			                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  			<span aria-hidden="true">&times;</span></button>
			                			<h4 class="modal-title">KD</h4>
			              			</div>
			              			<div class="modal-body">
			                			<!-- form start -->
							            <form role="form" method="POST" action="{{ url('admin/ki-and-kd/store/kd') }}">
							            	@csrf
							              	<div class="box-body">
							               		<div class="form-group">
							                  		<label for="exampleInputEmail1">Title</label>
							                  		<input type="text" class="form-control" id="" name="title" value="{{ $kd->title }}">
							                  		<input type="hidden" class="form-control" id="" name="type" value="KD">
							                	</div>
							                	<div class="form-group">
							                  		<label for="exampleInputPassword1">Description</label>
							                  		<textarea id="editor-kd" class="form-control" id="" name="description" rows="10" cols="80">{{ $kd->description }}</textarea>
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
              		<!-- /.tab-pane -->
            	</div>
            	<!-- /.tab-content -->
          	</div>
          <!-- nav-tabs-custom -->
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
    	CKEDITOR.replace('editor-ki')
    	//bootstrap WYSIHTML5 - text editor
    	$('.textarea').wysihtml5()
  	})
  	$(function () {
    	// Replace the <textarea id="editor1"> with a CKEditor
    	// instance, using default configuration.
    	CKEDITOR.replace('editor-kd')
    	//bootstrap WYSIHTML5 - text editor
    	$('.textarea').wysihtml5()
  	})
</script>
@stop