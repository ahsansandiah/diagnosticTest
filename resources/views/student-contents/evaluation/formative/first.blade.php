
@extends('layouts.main-user')

@section('title', 'Dashboard')

@section('content-header')
    <h1>
		<small></small>
	</h1>
    <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      	<li><a href="#">Penilaian</a></li>
      	<li class="active">Formatif</li>
    </ol>
@stop

@section('content')
    <div class="login-box">
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
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Apabila anda sudah siap mengerjakan test, silahkan tekan button mulai.</p>
            <div class="social-auth-links text-center">
                <a href="{{ url('/evaluation/formative') }}" type="button" class="btn bg-olive btn-lg btn-flat margin">MULAI</a>
            </div>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.login-box-body -->
    </div>
@stop

@section('css-custom')
@stop

@section('js-custom')
    <script type="text/javascript">
        var timer2 = "2:10";
        var interval = setInterval(function() {
            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            $("#time_limit").val(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }, 1000);
    </script>

@stop