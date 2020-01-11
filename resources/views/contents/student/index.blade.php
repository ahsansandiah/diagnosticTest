@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Student</h1>
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
		                			<h4 class="modal-title">Add New Student</h4>
		                			<p></p>
		              			</div>
		              			<div class="modal-body">
		                			<!-- form start -->
						            <form role="form" method="POST" action="{{ url('admin/student/store/') }}">
						            	@csrf
						              	<div class="box-body">
						               		<div class="form-group">
						                  		<label for="">Name</label>
						                  		<input type="text" class="form-control" id="" name="name">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">Address</label>
						                  		<input type="text" class="form-control" id="" name="address">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">email</label>
						                  		<input type="text" class="form-control" id="" name="email">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">Birthday</label>
						                  		<input type="text" class="form-control" id="datepicker" name="birthday">
						                	</div>
						                	<div class="form-group">
						                  		<label for="">Birthday Place</label>
						                  		<input type="text" class="form-control" id="" name="birthday_place">
						                	</div>
						              	</div>
						              	<!-- /.box-body -->
						              	<div class="box-footer">
						                	<button type="submit" class="btn btn-primary">Submit</button>
						                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						              	</div>
						            </form>
		              			</div>
		            		<!-- /.modal-content -->
		            		</div>
		          		</div>
		          		<!-- /.modal-dialog -->
		        	</div>
		        	<!-- /.modal -->
				</div>

				<div class="box-body box-profile">
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<table class="table table-bordered">
		                <tbody>
		                	<tr>
			                  	<th style="width: 10px">#</th>
			                  	<th>Name</th>
			                  	<th>Address</th>
			                  	<th>Birthday</th>
			                  	<th>Email</th>
			                  	<th>Action</th>
		                	</tr>
		                	@foreach ($students as $key => $student)
				                <tr>
				                  	<td>{{ $key+1 }}</td>
				                  	<td>{{ $student->name }}</td>
				                  	<td>{{ $student->address }}</td>
				                  	<td>{{ $student->birthday }}</td>
				                  	<td>{{ $student->email }}</td>
				                  	<td>
				                  		<a href="{{ url('admin/student/update/'.$student->id )}}" class="btn btn-default btn-xs" target="_blank" data-toggle="modal" data-target="#edit{{$student->id}}"><i class="fa fa-edit"></i> Edit</a>
				                  		<div class="modal fade" id="edit{{$student->id}}">
							          		<div class="modal-dialog">
							            		<div class="modal-content">
							              			<div class="modal-header">
							                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                  			<span aria-hidden="true">&times;</span></button>
							                			<h4 class="modal-title">Edit : {{ $student->name }}</h4>
							              			</div>
							              			<div class="modal-body">
							                			<!-- form start -->
											            <form role="form" method="POST" action="{{ url('admin/student/update/'.$student->id) }}">
											            	@csrf
											              	<div class="box-body">
											               		<div class="form-group">
											                  		<label for="">Name</label>
											                  		<input type="text" class="form-control" id="" name="name" value="{{ $student->name }}">
											                	</div>
											                	<div class="form-group">
											                  		<label for="">Address</label>
											                  		<input type="text" class="form-control" id="" name="address" value="{{ $student->address }}">
											                	</div>
											                	<div class="form-group">
											                  		<label for="">email</label>
											                  		<input type="text" class="form-control" id="" name="email" value="{{ $student->email }}">
											                	</div>
											                	<div class="form-group">
											                  		<label for="">Birthday</label>
											                  		<input type="text" class="form-control" id="datepicker{{ $student->id }}" name="birthday" value="{{ $student->birthday }}">
											                	</div>
											                	<div class="form-group">
											                  		<label for="">Birthday Place</label>
											                  		<input type="text" class="form-control" id="" name="birthday_place" value="{{ $student->birthday_place }}">
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

				                  		<a href="{{ url('admin/student/delete/'.$student->id )}}" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete</a>

				                  		<a class="btn btn-default btn-xs" target="_blank" data-toggle="modal" data-target="#password{{$student->id}}"><i class="fa fa-key"></i> Password</a>
				                  		<div class="modal fade" id="password{{$student->id}}">
							          		<div class="modal-dialog">
							            		<div class="modal-content">
							              			<div class="modal-header">
							                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                  			<span aria-hidden="true">&times;</span></button>
							                			<h4 class="modal-title">Reset Password : {{ $student->name }}</h4>
							              			</div>
							              			<div class="modal-body">
							                			<!-- form start -->
											            <form role="form" method="POST" action="{{ url('admin/student/'.$student->user_id.'/reset-password') }}">
											            	@csrf
											              	<div class="box-body">
											               		<div class="form-group">
											                  		<label for="">New Passowrd</label>
											                  		<input type="text" class="form-control" id="" name="password">
											                	</div>
											                	<div class="form-group">
											                  		<label for="">Confirmation Password</label>
											                  		<input type="text" class="form-control" id="" name="password_confirmation">
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
				                  	</td>
				                </tr>
			                @endforeach
		             	</tbody>
		             </table>
				</div>

				<div class="box-footer box-profile">
					{{ $students->links() }}
				</div>
			</div>
        </div>
        <!-- /.col -->
	</div>
@stop

@section('css-pages')
	<link rel="stylesheet" src="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('js-pages')
	<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript">
		//Date picker
	    $('#datepicker').datepicker({
	    	format: 'yyyy-mm-dd',
	      	autoclose: true
	    })

	    @foreach($students as $key => $student)
		    $('#datepicker{{ $student->id }}').datepicker({
		    	format: 'yyyy-mm-dd',
		      	autoclose: true
		    })
		@endforeach
	</script>
@stop