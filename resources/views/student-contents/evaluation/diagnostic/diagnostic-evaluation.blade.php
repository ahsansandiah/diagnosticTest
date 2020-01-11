
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
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Test - Diagnostik - {{ $confluenceName }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example-basic">
                @foreach ($questions as $key => $value)
                    <h3></h3>
                    <section>
                        <form role="form" method="POST" action="{{ url('') }}">
                            <h3 class="pull-right"><b>Waktu :</b> <b class="countdown"></b></h3>
                            <hr>
                            <p><b>Pertanyaan</b></p>
                            <p>{!! $value->question !!}</p>
                            <p><input type="text" name="question_id" id="question" value="{{ $value->id }}"></p>
                            <hr>
                            <p><b>Jawaban</b></p>
                            @foreach($value->answers as $answer)
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer" id="answer" value="{{ $answer->id }}" checked="">{!! $answer->answer !!}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('css-custom')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/jquery-steps@1.1.0/demo/css/jquery.steps.min.css">
@stop

@section('js-custom')
    <script src="{{ asset('bower_components/jquery-steps/jquery.steps.js') }}"></script>
    <script>
        $("#example-basic").steps({
            headerTag: "h3",
            title: "Step Title 1",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            previous:false,
            autoFocus: true,
            
            onStepChanged: function (event, currentIndex, priorIndex) {
                
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
                    timer2 = minutes + ':' + seconds;
                }, 1000);
            },
            onFinished: () => {
                // compile datas
                var dataObject = {
                    'question': $('#question').val(),
                    'answer': $('#answer').val(),
                };
                console.log(dataObject);
            }
        });
    </script>

    <script type="text/javascript">
        
    </script>
@stop