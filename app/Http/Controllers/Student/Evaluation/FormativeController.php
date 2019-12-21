<?php

namespace App\Http\Controllers\Student\Evaluation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Ycs77\LaravelWizard\Step;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use Cache;
use Session;

use App\Models\Evaluation;
use App\Models\EvaluationStatus;
use App\Models\Theory;
use App\Models\Student;
use App\Models\Confluence;
use App\Models\Question;
use App\Models\Answer;
use App\Models\TheoryMedia;

class FormativeController extends Controller
{
	const BASE_VIEW_URL_PATH = 'student-contents.evaluation.formative';
	const FORMATIVE_CATEGORY = 2;

	public function introduction()
	{
		return view($this::BASE_VIEW_URL_PATH.'.first');
	}

	public function index(Request $request)
	{
		$user = Auth::user();
		$student = $user->student;
		if (is_null($student)){
			return redirect('/evaluation/formative/introduction')->with('error_message', 'Maaf, Anda tidak terdaftar sebagai siswa');
		}

		$theory = Theory::where('category_id', $this::FORMATIVE_CATEGORY)->first();
		$confluence = Confluence::where('type', 'formative')->first();
		$question = $this->question($request->last_question, $confluence->id);

		$evaluationStatus = (new EvaluationStatus)->isDone($user->id, 'formative', null);
		if ($evaluationStatus ) {
			return redirect('/evaluation/formative/result')->with('error_message', 'Anda telah menyelesaikan test');
		}

		$evaluations = Evaluation::where('type','formative')->where('student_id', $student->id)->count();
		if ($evaluations > 0 && is_null($question)) {
			$evaluationStatus = new EvaluationStatus;
			$evaluationStatus->user_id = $user->id;
			$evaluationStatus->type = 'formative';
			$evaluationStatus->status = 'done';
			$evaluationStatus->confluence_id = $confluence->id;
			$evaluationStatus->save();

			return redirect('/evaluation/formative/result')->with('message', 'Anda telah menyelesaikan semua test');
		}

		if (is_null($question)) {
			return redirect('/evaluation/formative/result')->with('error_message', 'Maaf, Test belum tersedia');
		}

		return view($this::BASE_VIEW_URL_PATH.'.index', compact('theory', 'question'));
	}

	public function question($lastQuestion, $confluenceId)
	{
		$nextQuestion = 1;
		if (!empty($lastQuestion)) {
			$nextQuestion = $lastQuestion + 1;
		}

		$question = Question::with(['answers', 'theory'])
					->where('confluence_id', $confluenceId)
					->where('order', $nextQuestion)->first();

		return $question;
	}

	public function getFileTheory($theoryId)
	{
		if (is_null($theoryId)) {
			return null;
		}

		$files = TheoryMedia::with('media')->where('theory_id', $theoryId)->get();
		$path = asset('/uploads/files/');

		return [
			'files' => $files,
			'path'  => $path
		];
	}

	public function store(Request $request)
	{
		$user = Auth::user();
		$question = Question::find($request->question_id);
		$answer = Answer::find($request->answer_id);
		$student = $user->student;

		$studentEvaluation = new Evaluation;
		$studentEvaluation->student_id = $student->id;
		$studentEvaluation->question_id = $question->id;
		$studentEvaluation->answer_id = $answer->id;
		$studentEvaluation->confluence_id = $question->confluence_id;
		$studentEvaluation->theory_id = $question->theory_id;
		$studentEvaluation->score = $question->score;
		$studentEvaluation->correct = $answer->correct;
		$studentEvaluation->package = $question->package;
		$studentEvaluation->time = $request->time_limit;
		$studentEvaluation->type = 'formative';
		$studentEvaluation->save();
		
		return redirect('/evaluation/formative/'.$studentEvaluation->id.'/review');
	}

	public function review($evaluationId)
	{
		$evaluation = Evaluation::with(['answer', 'question', 'confluence'])->findOrFail($evaluationId);
		$filesTheory = $this->getFileTheory($evaluation->theory_id);

		return view($this::BASE_VIEW_URL_PATH.'.review', compact('evaluation', 'filesTheory'));
	}

	public function result()
	{
		$user = Auth::user();
		$student = $user->student;

		$evaluation = (new Evaluation)->getResultByUser($student,null,'formative');
		return view($this::BASE_VIEW_URL_PATH.'.result', compact('evaluation'));
	}
}