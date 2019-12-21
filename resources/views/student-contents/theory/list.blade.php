@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">Theory</a></li>
    </ol>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>

				<div class="box-body box-profile">
					<table class="table table-bordered">
		                <tbody>
		                	<tr>
			                  	<th style="width: 10px">#</th>
			                  	<th>Title</th>
			                  	<th>Description</th>
			                  	<th>preview</th>
			                  	<th></th>
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