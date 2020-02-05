
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
                <h3 class="box-title">Hasil - {{ $evaluation->confluence->confluence }} - Soal No.{{ $evaluation->question->order }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example-basic">

                </div>
                <div class="timeline-item">
                    <div class="timeline-header">
                        <div class="callout callout-success">
                            <h5>{!! $evaluation->question->question !!}</h5>
                        </div>
                    </div>
                    <div class="timeline-body">
                        <dl class="dl-horizontal">
                            <dt>Jawaban</dt>
                            <dd>{!! $evaluation->answer->answer !!}</dd>
                            <br>
                            <dt>Diagnosa</dt>
                            <dd>{!! $evaluation->answer->diagnosa !!}</dd>
                            <br>
                            <dt>Saran</dt>
                            <dd>{!! $evaluation->answer->suggestion !!}</dd>
                            <br>
                            <dt>Score</dt>
                            <dd>{!! $evaluation->answer->score !!}</dd>
                        </dl>
                        <hr>
                        <form method="get" action="{{ url('evaluation/diagnostic/'.$confluenceName) }}">
                            <input type="hidden" name="last_question" value="{{ $evaluation->question->order }}">
                            <button type="submit" class="btn btn-primary btn-flat btn-sm">Lanjutkan</button>
                        </form>
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

@stop