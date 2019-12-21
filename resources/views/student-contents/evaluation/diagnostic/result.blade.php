
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Penilaian</a></li>
        <li><a href="{{ url('evaluation/diagnostic') }}">Diagnostik</a></li>
        <li class="active">Hasil</li>
    </ol>
@stop

@section('content')
    <div class="col-md-2">
        
    </div>
    <div class="col-md-8">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    {{-- <img class="img-circle" src="{{ asset('vendor/adminlte/dist/img/user7-128x128.jpg')}}" alt="User Avatar"> --}}
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Question <span class="pull-right badge bg-blue">{{ $evaluation['total_question'] }}</span></a></li>
                    <li><a href="#">Answer <span class="pull-right badge bg-aqua">{{ $evaluation['total_answer'] }}</span></a></li>
                    <li><a href="#">Correct <span class="pull-right badge bg-green">{{ $evaluation['correct_answer'] }}</span></a></li>
                    <li><a href="#">Score <span class="pull-right badge bg-red">{{ $evaluation['score'] }}</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>

    <div class="col-md-2">
        
    </div>
@stop

@section('css-custom')
@stop

@section('js-custom')

@stop