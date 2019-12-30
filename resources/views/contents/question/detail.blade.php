@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Question</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header with-border">
  			<blockquote><h3 class="box-title">{!! $question->question !!}</h3></blockquote>
		</div>
        <!-- /.box-header -->
    	<div class="box-body box-profile">
    		<div class="col-md-2">
    			<h4><b>Detail</b></h4>
    			<ul class="list-group list-group-unbordered">
	            	<li class="list-group-item" style="margin-bottom: 20px; margin-top: 21px;">
	              		<b>Time</b> <a class="pull-right">02:00</a>
	            	</li>
	            	<li class="list-group-item" style="margin-bottom: 20px; margin-top: 21px;">
	              		<b>Score</b> <a class="pull-right">{{ $question->score }}</a>
	            	</li>
	          	</ul>
    		</div>
    		<div class="col-md-10">
    			{{-- <h4><b>Answer</b></h4> --}}
				<div class="nav-tabs-custom">
        			<ul class="nav nav-tabs">
        				@foreach($question->answers as $key => $answer)
	          				<li><a href="#{{$key}}" data-toggle="tab" aria-expanded="true">Answer {{ $answerSort[$key] }}</a></li>
          				@endforeach
        			</ul>
        			<div class="tab-content">
        				@foreach($question->answers as $key => $answer)
	          				<div class="tab-pane" id="{{$key}}">
	          					<b>
			              			Answer
			    					<blockquote><h4 class="box-title">{!! $answer->answer !!}</h4></blockquote>
			              		</b>
			              		<b>
			              			Diagnosa
			    					<blockquote><h4 class="box-title">{!! $answer->diagnosa !!}</h4></blockquote>
			              		</b> 
			              		<b>
			              			Suggestion
			    					<blockquote><h4 class="box-title">{!! $answer->suggestion !!}</h4></blockquote>
			              		</b>
			                  	@if ($answer->correct == 1) 
			                  		<a href="{{ url('admin/question/'.$question->id.'/'.$answer->id.'/incorrect') }}" class="btn btn-success btn-flat"><i class="fa fa-check"></i></a>
			                  	@else 
			                  		<a href="{{ url('admin/question/'.$question->id.'/'.$answer->id.'/correct') }}" class="btn btn-danger btn-flat"><i class="fa fa-ban"></i></a>
			                  	@endif
			                  	<a data-toggle="modal" data-target="#modal-default{{ $answer->id }}" class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></a>
			                  	<div class="modal fade" id="modal-default{{ $answer->id }}">
						          	<div class="modal-dialog">
						            	<div class="modal-content">
						              		<div class="modal-header">
						                		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                  		<span aria-hidden="true">&times;</span></button>
						                		<h4 class="modal-title">Edit Answer</h4>
						              		</div>
						              		<div class="modal-body">
						                		<!-- form start -->
												<form role="form" method="POST" action="{{ url('admin/question/answer/'.$answer->id.'/update') }}">
													@csrf
													<input type="hidden" name="question_id" value="{{ $question->id }}">
													<div class="box-body">
														<div class="form-group">
															<label>Answer</label>
															<textarea id="editAnswer{{ $answer->id }}" class="form-control" id="" name="answer"  rows="10" cols="80">{{ $answer->answer }}</textarea>
														</div>
														<div class="form-group">
															<label>Suggestion</label>
															<textarea id="editSuggestion{{ $answer->id }}" class="form-control" id="" name="suggestion"  rows="10" cols="80">{{ $answer->suggestion }}</textarea>
														</div>
														<div class="form-group">
															<label>Diagnosa</label>
															<textarea id="editDiagnosa{{ $answer->id }}" class="form-control" id="" name="diagnosa"  rows="10" cols="80">{{ $answer->diagnosa }}</textarea>
														</div>
														<div class="form-group" id="more_answer">
														</div>
													</div>
													<!-- /.box-body -->
													<div class="box-footer">
														<button type="Submit" class="btn btn-primary">Submit</button>
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

			                  	<a href="{{ url('admin/question/'.$question->id.'/answer/'.$answer->id.'/delete') }}" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
	          				</div>
	         				<!-- /.tab-pane -->
         				 @endforeach
        			</div>
       				 <!-- /.tab-content -->
      			</div>
    		</div>
    	</div>
    	<div class="box-footer">
    		<a data-toggle="modal" data-target="#modal-add-answer" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus"></i> Add Answer</a>
			<div class="modal fade" id="modal-add-answer">
				<div class="modal-dialog">
					<div class="modal-content">
				    	<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true">&times;</span></button>
				            <h4 class="modal-title">Add Answer</h4>
				        </div>
	              		<div class="modal-body">
	                		<!-- form start -->
							<form role="form" method="POST" action="{{ url('admin/question/answer/store') }}">
								@csrf
								<input type="hidden" name="question_id" value="{{ $question->id }}">
								<div class="box-body">
									<div class="form-group">
										<label>Answer</label>
										<textarea id="addAnswer" class="form-control" id="" name="answer"  rows="10" cols="80"></textarea>
									</div>
									<div class="form-group">
										<label>Suggestion</label>
										<textarea id="addSuggestion" class="form-control" id="" name="suggestion"  rows="10" cols="80"></textarea>
									</div>
									<div class="form-group">
										<label>Diagnosa</label>
										<textarea id="addDiagnosa" class="form-control" id="" name="diagnosa"  rows="10" cols="80"></textarea>
									</div>
									<div class="form-group" id="more_answer">
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="Submit" class="btn btn-primary">Submit</button>
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

	        <a data-toggle="modal" data-target="#modal-edit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-edit"></i> Edit Question</a>
	        <div class="modal fade" id="modal-edit">
				<div class="modal-dialog">
					<div class="modal-content">
				    	<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true">&times;</span></button>
				            <h4 class="modal-title">Edit Question</h4>
				        </div>
	              		<div class="modal-body">
	                		<!-- form start -->
							<form role="form" method="POST" action="{{ url('admin/question/update/'.$question->id) }}">
				            	@csrf
				              	<div class="box-body">
				               		<div class="form-group">
				                  		<label>Question</label>
				                  		<textarea id="questionUpdate" class="form-control" id="" name="question"  rows="10" cols="80">{{ $question->question }}</textarea>
				                	</div>
				               		<div class="form-group">
				                  		<label>Description</label>
				                  		<textarea id="descriptionUpdate" class="form-control" id="" name="description"  rows="10" cols="80">{{ $question->description }}</textarea>
				                	</div>
				                	<div class="form-group">
				                  		<label for="exampleInputPassword1">Theory</label>
				                		<select class="form-control" name="theory_id">
				                			@foreach($theories as $theory)
				                				<option value="{{ $theory->id }}">{{ $theory->name }}</option>
				                			@endforeach
				                		</select>
				                	</div>
				               		<div class="form-group">
				                  		<label>Time Limit</label>
				                  		<input type="time" class="form-control" id="" name="time_limit" value="{{ $question->time_limit }}">
				                	</div>
				               		<div class="form-group">
				                  		<label>Score</label>
				                  		<input type="numeric" class="form-control" id="" name="score"  value="{{ $question->score }}">
				                	</div>
				                	<div class="form-group">
				                  		<label>Order</label>
				                  		<input type="numeric" class="form-control" name="order" id="" value="{{ $question->order }}">
				                	</div>
				              	</div>
				              	<!-- /.box-body -->
				              	<div class="box-footer">
				                	<button type="submit" class="btn btn-primary">Submit</button>
				                	<a href="{{ url('admin/question') }}" class="btn btn-default">Close</a>
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

	        <a href="{{ url('admin/question/delete/'.$question->id )}}" class="btn btn-danger btn-flat pull-right" onclick="return confirm('are you sure?')"><i class="fa fa-edit"></i> Delete Question</a>
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
	    	// instance, using default configuration.
	    	CKEDITOR.replace('addAnswer')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})
	  	$(function () {
	    	// instance, using default configuration.
	    	CKEDITOR.replace('addSuggestion')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})
	  	$(function () {
	    	// instance, using default configuration.
	    	CKEDITOR.replace('addDiagnosa')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})
	  	$(function () {
	    	// instance, using default configuration.
	    	CKEDITOR.replace('questionUpdate')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})
	  	$(function () {
	    	// instance, using default configuration.
	    	CKEDITOR.replace('descriptionUpdate')
	    	//bootstrap WYSIHTML5 - text editor
	    	$('.textarea').wysihtml5()
	  	})

    	@foreach($question->answers as $answer)
    		$(function () {
		    	// instance, using default configuration.
		    	CKEDITOR.replace('editAnswer{{ $answer->id }}')
		    	//bootstrap WYSIHTML5 - text editor
		    	$('.textarea').wysihtml5()
		  	})
    		$(function () {
		    	// instance, using default configuration.
		    	CKEDITOR.replace('editSuggestion{{ $answer->id }}')
		    	//bootstrap WYSIHTML5 - text editor
		    	$('.textarea').wysihtml5()
		  	})
    		$(function () {
		    	// instance, using default configuration.
		    	CKEDITOR.replace('editDiagnosa{{ $answer->id }}')
		    	//bootstrap WYSIHTML5 - text editor
		    	$('.textarea').wysihtml5()
		  	})
    	@endforeach
	</script>
@stop