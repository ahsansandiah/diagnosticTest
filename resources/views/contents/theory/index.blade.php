@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Theory</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Theory Data</h3>
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
                			<h4 class="modal-title">Create Theory</h4>
              			</div>
              			<div class="modal-body">
                			<!-- form start -->
				            <form role="form" method="POST" action="{{ url('admin/theory/store') }}">
				            	@csrf
				              	<div class="box-body">
				               		<div class="form-group">
				                  		<label for="exampleInputEmail1">Name</label>
				                  		<input type="text" class="form-control" id="" name="name" placeholder="Enter Theory Title">
				                	</div>
				                	<div class="form-group">
				                  		<label for="exampleInputPassword1">Description</label>
				                  		<input type="text" class="form-control" name="description" id="" placeholder="Enter Description">
				                	</div>
				                	<div class="form-group">
				                  		<label for="exampleInputPassword1">Category</label>
				                		<select class="form-control" name="category_id">
				                			@foreach($theoryCategories as $category)
				                				<option value="{{ $category->id }}">{{ $category->category }}</option>
				                			@endforeach
				                		</select>
				                	</div>
				                	<div class="form-group">
				                  		<label for="exampleInputPassword1">Confluence</label>
				                		<select class="form-control" name="confluence_id">
				                			@foreach($confluences as $confluence)
				                				<option value="{{ $confluence->id }}">{{ $confluence->confluence }}</option>
				                			@endforeach
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
		                <th>Description</th>
		                <th>Category</th>
		                <th>Confluence</th>
		                <th>Created At</th>
		                <th>Updated At</th>
		                <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach ($theories as $index => $theory)
	                	<tr>
		                	<td>{{ $index+1 }}</td>
		                	<td>{{ $theory->name }}</td>
		                	<td>{{ $theory->description }}</td>
		                	<td>{{ $theory->category->category }}</td>
		                	<td>{{ $theory->confluence->confluence }}</td>
		                	<td>{{ $theory->created_at }}</td>
		                	<td>{{ $theory->updated_at }}</td>
		                	<td>
		                		<a class="btn btn-app" data-toggle="modal" data-target="#modal-edit{{ $theory->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <div class="modal fade" id="modal-edit{{ $theory->id }}">
					          		<div class="modal-dialog">
					            		<div class="modal-content">
					              			<div class="modal-header">
					                			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  			<span aria-hidden="true">&times;</span></button>
					                			<h4 class="modal-title">Edit Theory</h4>
					              			</div>
					              			<div class="modal-body">
					                			<!-- form start -->
									            <form role="form" method="post" action="{{ url('admin/theory/update/'.$theory->id) }}">
									            	@csrf
									              	<div class="box-body">
									               		<div class="form-group">
									                  		<label for="exampleInputEmail1">Name</label>
									                  		<input type="text" class="form-control" id="" name="name" value={{ $theory->name }}>
									                	</div>
									                	<div class="form-group">
									                  		<label for="exampleInputPassword1">Description</label>
									                  		<input type="text" class="form-control" name="description" id="" value={{ $theory->description }}>
									                	</div>
									                	<div class="form-group">
									                  		<label for="exampleInputPassword1">Category</label>
									                		<select class="form-control" name="category_id">
									                			@foreach($theoryCategories as $category)
									                				<option value="{{ $category->id }}">{{ $category->category }}</option>
									                			@endforeach
									                		</select>
									                	</div>
									                	<div class="form-group">
									                  		<label for="exampleInputPassword1">Confluence</label>
									                		<select class="form-control" name="confluence_id">
									                			@foreach($confluences as $confluence)
									                				<option value="{{ $confluence->id }}">{{ $confluence->confluence }}</option>
									                			@endforeach
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
		                		<a href="{{ url('admin/Theory/delete'.'/'.$theory->id) }}" class="btn btn-app">
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
@stop