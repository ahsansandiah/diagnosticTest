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

class DiagnosticController extends Controller
{
	const BASE_VIEW_URL_PATH = 'student-contents.evaluation.diagnostic';
	const DIAGNOSTIC_CATEGORY = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$user = Auth::user();
		$confluences = Confluence::where('type', 'diagnostic')->get();

		return view($this::BASE_VIEW_URL_PATH.'.index', compact('confluences'));
	}

	public function checkPassword(Request $request, $confluenceName)
	{
		$user = Auth::user();
		$name = str_replace('-', ' ', $confluenceName);
		$confluence = Confluence::where('confluence', $name)
								->where('password', $request->password)
								->first();

		if (is_null($confluence)) {
			return redirect('/evaluation/diagnostic')->with('error_message', 'Gagal! Password yang anda masukkan salah!');
		}

		$evaluationStatus = (new EvaluationStatus)->isDone($user->id, 'diagnostic', $confluence->id);
		if ($evaluationStatus) {
			return redirect('/evaluation/diagnostic/result/'.$confluence->id);
		}

		return redirect('/evaluation/diagnostic/'.$confluenceName);
	}

	public function evaluationTheory(Request $request, $confluenceName)
	{
		$user = Auth::user();
		$name = str_replace('-', ' ', $confluenceName);
		$confluence = Confluence::where('confluence', $name)
								->first();

		$theory = Theory::where('confluence_id', $confluence->id)->where('category_id', $this::DIAGNOSTIC_CATEGORY)->first();
		$medias = null;
		if ($theory) {
			$medias = TheoryMedia::with('media')->where('theory_id', $theory->id)->get();
		}
		$path = asset('/uploads/files/');

		$query = Question::with(['answers', 'theory']);
		if  (!empty($request->last_question)) {
			$nextQuestion = $request->last_question + 1;
			$query->where('order', $nextQuestion);
		}
		
		$question = $query->where('confluence_id', $confluence->id)->orderBy('order', 'asc')->first();

		if (is_null($question)) {
			if (is_null($request->last_question)) {
				return redirect('/evaluation/diagnostic')->with('error_message', 'Test belum tersedia');
			}

			$evaluationStatus = new EvaluationStatus;
			$evaluationStatus->user_id = $user->id;
			$evaluationStatus->type = 'diagnostic';
			$evaluationStatus->status = 'done';
			$evaluationStatus->confluence_id = $confluence->id;
			$evaluationStatus->save();

			return redirect('/evaluation/diagnostic')->with('message', 'Anda telah menyelesaikan semua pertanyaan');
		}

		return view($this::BASE_VIEW_URL_PATH.'.question', compact('confluenceName', 'question', 'medias', 'path'));
	}

	public function submitEvaluation(Request $request, $confluenceName)
	{
		$user = Auth::user();
		$student = $user->student;
		$questionId = $request->question_id;
		$answerId = $request->answer_id;
		$name = str_replace('-', ' ', $confluenceName);
		$confluence = Confluence::where('confluence', $name)
								->first();

		$question = Question::find($questionId);
		$answer = Answer::find($answerId);

		$studentEvaluation = new Evaluation;
		$studentEvaluation->student_id = $student->id;
		$studentEvaluation->question_id = $questionId;
		$studentEvaluation->answer_id = $answerId;
		$studentEvaluation->confluence_id = $confluence->id;
		$studentEvaluation->theory_id = $question->theory_id;
		$studentEvaluation->score = $question->score;
		$studentEvaluation->package = $question->package;
		$studentEvaluation->correct = !is_null($answer->correct) ? $answer->correct : 0;
		$studentEvaluation->time = $request->time_limit;
		$studentEvaluation->type = 'diagnostic';
		$studentEvaluation->save();
		
		return redirect('/evaluation/diagnostic/'.$studentEvaluation->id.'/review');
	}

	public function review($evaluationId)
	{
		$evaluation = Evaluation::with(['answer', 'question', 'confluence'])->findOrFail($evaluationId);
		$medias = TheoryMedia::with('media')->where('theory_id', $evaluation->question->theory_id)->get();
		$path = asset('/uploads/files/');
		$confluenceName = str_replace(' ', '-', $evaluation->confluence->confluence);

		return view($this::BASE_VIEW_URL_PATH.'.review-answer', compact('evaluation', 'medias', 'path', 'confluenceName'));
	}

	public function result($confluenceId)
	{
		if (is_null($confluenceId)) return abort(404);

		$user = Auth::user();
		if (is_null($user)) return abort(404);

		$student = $user->student;

		$evaluation = (new Evaluation)->getResultByUser($student, $confluenceId, 'diagnostic');
		return view($this::BASE_VIEW_URL_PATH.'.result', compact('evaluation'));
	}

}