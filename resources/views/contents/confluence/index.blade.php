@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Confluence</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Confluence Data</h3>
          @yield('message')
          <div class="box-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Create
            </button>
            <div class="modal fade" id="modal-default">
          		<div class="modal-dialog">
            		<div class="modal-content">
              			<div class="modal-header">
                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  			<span aria-hidden="true">&times;</span></button>
                			<h4 class="modal-title">Create Confluence</h4>
              			</div>
              			<div class="modal-body">
                			<!-- form start -->
				            <form role="form" method="POST" action="{{ url('admin/confluence/store') }}">
				            	@csrf
				              	<div class="box-body">
				               		<div class="form-group">
				                  		<label for="exampleInputEmail1">Title</label>
				                  		<input type="text" class="form-control" id="" name="confluence" placeholder="Enter Confluence Title">
				                	</div>
				                	<div class="form-group">
				                  		<label for="exampleInputPassword1">Order</label>
				                  		<input type="numeric" class="form-control" name="order" id="" placeholder="Enter">
				                	</div>
				                	<div class="form-group">
				                  		<select class="form-control" name="type">
				                  			<option value="diagnostic">Diagnostic</option>
				                  			<option value="posttest">Post-Test</option>
				                  			<option value="pretest">Pre-Test</option>
				                  		</select>
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
	                		{{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                		<button type="button" class="btn btn-primary">Save changes</button> --}}
	              		</div>
            		</div>
            		<!-- /.modal-content -->
          		</div>
          		<!-- /.modal-dialog -->
        	</div>
        	<!-- /.modal -->
          </div>
        </div>
        <!-- /.box-header -->
    	<div class="box-body">
    		<table id="example1" class="table table-bordered table-striped">
    			<thead>
	                <tr>
		                <th>No</th>
		                <th>Title</th>
		                <th>Created At</th>
		                <th>Updated At</th>
		                <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach ($confluences as $index => $confluence)
	                	<tr>
		                	<td>{{ $index+1 }}</td>
		                	<td>{{ $confluence->confluence }}</td>
		                	<td>{{ $confluence->created_at }}</td>
		                	<td>{{ $confluence->updated_at }}</td>
		                	<td>
		                		{{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-password{{ $confluence->id }}">
                                    <i class="fa fa-file-pdf-o"></i> Media
                                </a> --}}
		                		<a class="btn btn-app" data-toggle="modal" data-target="#modal-password{{ $confluence->id }}">
                                    <i class="fa fa-key"></i> Password
                                </a>
                                <div class="modal fade" id="modal-password{{ $confluence->id }}">
					          		<div class="modal-dialog">
					            		<div class="modal-content">
					              			<div class="modal-header">
					                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  			<span aria-hidden="true">&times;</span></button>
					                			<h4 class="modal-title">Set Password</h4>
					              			</div>
					              			<div class="modal-body">
					                			<!-- form start -->
									            <form method="POST" action="{{ url('admin/confluence/set-password/'.$confluence->id) }}">
									            	@csrf
									              	<div class="box-body">
									               		<div class="form-group">
									                  		<label for="inputPassword">Password</label>
									                  		<input type="text" class="form-control" id="" name="password" value="{{ $confluence->password }}">
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
						                		{{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						                		<button type="button" class="btn btn-primary">Save changes</button> --}}
						              		</div>
					            		</div>
					            		<!-- /.modal-content -->
					          		</div>
					          		<!-- /.modal-dialog -->
					        	</div>
		                		<a class="btn btn-app" data-toggle="modal" data-target="#modal-edit{{ $confluence->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <div class="modal fade" id="modal-edit{{ $confluence->id }}">
					          		<div class="modal-dialog">
					            		<div class="modal-content">
					              			<div class="modal-header">
					                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  			<span aria-hidden="true">&times;</span></button>
					                			<h4 class="modal-title">Edit Confluence</h4>
					              			</div>
					              			<div class="modal-body">
					                			<!-- form start -->
									            <form method="POST" action="{{ url('admin/confluence/update/'.$confluence->id) }}">
									            	@csrf
									              	<div class="box-body">
									               		<div class="form-group">
									                  		<label for="exampleInputEmail1">Title</label>
									                  		<input type="text" class="form-control" id="" name="confluence" value="{{ $confluence->confluence }}">
									                	</div>
									                	<div class="form-group">
									                  		<label for="exampleInputPassword1">Order</label>
									                  		<input type="numeric" class="form-control" name="order" id=""  value="{{ $confluence->order }}">
									                	</div>
									                	<div class="form-group">
									                  		<select class="form-control" name="type">
									                  			<option value="diagnostic" {{ ($confluence->type == 'diagnostic') ? 'selected' : ''}}>Diagnostic</option>
									                  			<option value="pretest" {{ ($confluence->type == 'pretest') ? 'selected' : ''}}>Pre-Test</option>
									                  			<option value="posttest" {{ ($confluence->type == 'posttest') ? 'selected' : ''}}>Post-Test</option>
									                  		</select>
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
						                		{{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						                		<button type="button" class="btn btn-primary">Save changes</button> --}}
						              		</div>
					            		</div>
					            		<!-- /.modal-content -->
					          		</div>
					          		<!-- /.modal-dialog -->
					        	</div>
					        	<!-- /.modal -->
		                		<a href="{{ url('admin/confluence/delete'.'/'.$confluence->id) }}" class="btn btn-app">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
		                </tr>
                	@endforeach
                </tbody>
    		</table>
    	</div>
    </div>
@stop

@section('css-pages')
  {{-- <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> --}}
@stop

@section('js-pages')
	<!-- DataTables -->
	{{-- <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}

	<script>
	  // $(function () {
	  //   $('#example1').DataTable()
	  // })
	</script>
@stop