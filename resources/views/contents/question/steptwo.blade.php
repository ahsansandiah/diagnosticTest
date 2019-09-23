@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
		<h1>Answer</h1>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Form Answer</h3>
			@yield('message')
			<div class="box-tools">
			</div>
		</div>
			<!-- /.box-header -->
		<div class="box-body">
			<!-- form start -->
			<form role="form" method="POST" action="{{ url('admin/question/store-step-two') }}">
				@csrf
				<div class="box-body">
					<input type="hidden" class="form-control" id="" name="question_id" value="{{ $question->id }}">
					<div class="form-group">
						<label>Answer</label>
						<textarea id="editor1" class="form-control" id="" name="answer[]"  rows="10" cols="80"></textarea>
					</div>
					<div class="form-group" id="more_answer">
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="button" name="add" id="add_more" class="btn btn-success"><span class="fa fa-plus"></span> Add More</button>
					<button type="" class="btn btn-primary">Submit</button>
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
	<script type="text/javascript">
		$(document).ready(function() {
			var i = 1;
			$('#add_more').click(function() {
                i++;
                $('#more_answer').append(
                	'<div id="inputAnswer'+i+'">'+
	                	'<label>Answer '+ i +'</label>'+
						'<textarea id="editor'+i+'" class="form-control" name="answer[]"  rows="10" cols="80"></textarea>' +	
						'<p></p><button type="button" id="' + i + '" class="btn btn-danger btn-remove">Remove</button>'+
					'</div>'
                );
                $(document).on('click', '.btn-remove', function() {
					var button_id = $(this).attr("id");
					$('#inputAnswer' + button_id + '').remove();
				});
            });
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
	</script>
@stop