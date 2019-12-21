
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
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Test - {{ $confluenceName }} - Soal No.{{ $question->order }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example-basic">

                </div>
                <div class="timeline-item">
                    <div class="timeline-header">
                        <span class="time pull-right">
                            <h4>Waktu Pengerjaan : <b class="countdown"></b></h4>
                        </span>
                        <br>
                        <br>
                        <div>
                            <h5>{!! $question->question !!}</h5>
                        </div>

                    </div>
                    <div class="timeline-body">
                        <hr>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Answer</th>
                            </tr>
                            @if(!empty($question->answers))
                                <form method="POST" action="{{ url('/evaluation/diagnostic/'.$confluenceName.'/submit') }}">
                                    @csrf
                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                    <input type="hidden" name="time_limit" value="" id="time_limit">
                                    @foreach($question->answers as $answer)
                                        <tr>
                                            <td>
                                                <input type="radio" name="answer_id" id="optionsRadiosAnswer" value="{{ $answer->id}}" checked="">
                                            </td>
                                            <td>{{ strip_tags($answer->answer) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-block btn-success btn-flat">Submit</button>
                                        </td>
                                    </tr>
                                </form>
                            @else
                                <div class="callout callout-warning">
                                    <h4>Maaf, Jawaban belum tersedia</h4>
                                </div>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="timeline-footer">
                    </div>
                </div>
            </div>
        </div>
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