@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">Media</a></li>
      	<li class="active">{{ $type }}</li>
    </ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>

				<div class="box-body box-profile">
					<!-- Post -->
	                <div class="post">
	                  	<!-- /.user-block -->
	                  	<div class="row margin-bottom">
	                    	<div class="col-sm-12">
	                      		<div class="row">
	                      			@if ($type == "image")
		                        		@foreach ($images as $image)
		                        		<div class="col-sm-4">
		                          			<img src="{{ $path.'/'.$image->file_name }}" width="100%" height="100%">
		                          			<p>{{ $image->title .' | '.  $image->description}}</p>
		                        		</div>
		                          		@endforeach
	                          		@else
		                        		<!-- /.col -->
		                        		@foreach ($files as $file)
		                        		<div class="col-sm-4">
		                          			<a href="{{ $path.'/'.$file->file_name}}">{{ $file->title }}</a>
		                          			<p>{{ $file->title .' | '.  $file->description}}</p>
		                        		</div>
		                          		@endforeach
	                          		@endif
	                        		<!-- /.col -->
	                        	<!-- /.col -->
	                      		</div>
	                      	<!-- /.row -->
	                    	</div>
	                    <!-- /.col -->
	                  	</div>
	                </div>
	                <!-- /.post -->
				</div>

				<div class="box-footer box-profile">
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