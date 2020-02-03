@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Evaluation</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<h3 class="profile-username text-center"></h3>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Score</b> <a class="pull-right">{{ $totalScore }}</a>
						</li>
						<li class="list-group-item">
							<b>Question</b> <a class="pull-right">{{ $totalQuestion }}</a>
						</li>
						<li class="list-group-item">
							<b>Correct Answer</b> <a class="pull-right">{{ $totalCorrectAnswer }}</a>
						</li>
				 	</ul>
				</div>
			<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-10">
			<div class="box box-primary">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Question</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($evaluations))
							@foreach($evaluations as $index => $evaluation)
								<tr>
									<td>{{ $index+1 }}</td>
									<td>{!! ($evaluation->question) ? $evaluation->question->question : '' !!}</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="box box-primary">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Answer</th>
							<th>Time</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($evaluations as $index => $evaluation)
							<tr>
								<td>{!! $evaluation->answer->answer !!}</td>
								<td>{!! $evaluation->time !!}</td>
								<td>
									@if($evaluation->correct == 1)
										<i class="fa fa-check-square" aria-hidden="true"></i>
									@else
										<i class="fa fa-times" aria-hidden="true"></i>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box box-primary">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Diagnosis</th>
							<th>Saran</th>
						</tr>
					</thead>
					<tbody>
						@foreach($evaluations as $index => $evaluation)
							<tr>
								<td>{!! $evaluation->answer->diagnosa !!}</td>
								<td>{!! $evaluation->answer->suggestion !!}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('css-pages')
@stop

@section('js-pages')
@stop