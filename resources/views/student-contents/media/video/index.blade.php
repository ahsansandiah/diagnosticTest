
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">Media</a></li>
      	<li class="active">Video</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3><b>Video Termodinamika</b></h3>
                </div>

                <div class="box-body box-profile">
                    <!-- Post -->
                    <div class="post">
                        <!-- /.user-block -->
                        <div class="row margin-bottom">
                            <div class="col-sm-12">
                                <div class="row">
                                    @foreach ($videos as $video)
                                    <div class="col-sm-4">
                                        <iframe width="370" height="315" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                        <p>{{ $video->title .' | '.  $video->description}}</p>
                                    </div>
                                    @endforeach
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

@section('css-custom')
@stop

@section('js-custom')
@stop