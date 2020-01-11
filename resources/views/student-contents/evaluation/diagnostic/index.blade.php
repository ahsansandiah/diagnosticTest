
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">Penilaian</a></li>
      	<li class="active">Diagnostik</li>
    </ol>
@stop

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> 
                {{ Session::get('message') }}
            </h4>
        </div>
    @elseif(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> 
                {{ Session::get('error_message') }}
            </h4>
        </div>
    @endif
    <div class="row">
        @foreach($confluences as $confluence)
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h4><b>{{ $confluence->confluence }}</b></h4>
                        <p></p>
                    </div>
                    {{-- <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div> --}}
                    <a href="" data-toggle="modal" data-target="#modal-confluence{{ $confluence->id }}" class="small-box-footer">Masuk<i class="fa fa-arrow-circle-right"></i></a>
                    <div class="modal fade" id="modal-confluence{{ $confluence->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" style="color: black;">Masukkan password untuk memulai test</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form role="form" method="POST" action="{{ url('/evaluation/diagnostic/'.str_replace(' ', '-', $confluence->confluence))  }}">
                                        @csrf
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputPassword" style="color: black;">Password</label>
                                                <input type="text" class="form-control" id="" name="password" placeholder="Please input password">
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Mulai</button>
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
                    {{-- <a href="" class="small-box-footer">Masuk<i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('css-custom')
@stop

@section('js-custom')
@stop