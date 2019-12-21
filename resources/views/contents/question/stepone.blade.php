@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
		<h1>Question</h1>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Form Question</h3>
			@yield('message')
			<div class="box-tools">
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<!-- form start -->
			<form role="form" method="POST" action="{{ url('admin/question/store') }}">
				@csrf
				<div class="box-body">
					<div class="form-group">
						<label>Question</label>
						<textarea id="editor1" class="form-control" id="" name="question"  rows="10" cols="80" required></textarea>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea id="editor2" class="form-control" id="" name="description"  rows="10" cols="80" required></textarea>
					</div>
					<div class="form-group">
						<label>Suggestion</label>
						<textarea id="editor3" class="form-control" id="" name="suggestion"  rows="10" cols="80" required></textarea>
					</div>
					<div class="form-group">
						<label for="exampleInputConfluence">Confluence</label>
						<select class="form-control" name="confluence_id">
							@foreach($confluences as $confluence)
								<option value="{{ $confluence->id }}">{{ $confluence->confluence }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Package</label>
						<input type="text" class="form-control" id="" name="package" required>
					</div>
					<div class="form-group">
						<label>Score</label>
						<input type="numeric" class="form-control" id="" name="score" required>
					</div>
					<div class="form-group">
						<label>Order</label>
						<input type="numeric" class="form-control" name="order" id="" placeholder="Enter" required>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="{{ url('admin/question') }}" class="btn btn-default">Close</a>
				</div>
			</form>
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
			$(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor2')
				//bootstrap WYSIHTML5 - text editor
				$('.textarea').wysihtml5()
			})
			$(function () {
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('editor3')
				//bootstrap WYSIHTML5 - text editor
				$('.textarea').wysihtml5()
			})
	</script>
@stop