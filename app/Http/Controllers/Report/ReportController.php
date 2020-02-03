<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use Cache;
use Session;

use App\Models\Confluence;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Evaluation;
use App\Models\Student;

class ReportController extends Controller
{
	public function getByConfluence(Request $request)
	{
		$answers = [];
		if ($request->filled('confluence_id') && $request->filled('question_id')) {
			$evaluations = Evaluation::where('confluence_id', $request->confluence_id)
										->where('question_id', $request->question_id)
										->get()->groupBy('answer_id');

			foreach ($evaluations as $key => $value) {
				$answers[$key] = count($value);
			}
		}

		$confluences = Confluence::all();
		$listAnswers = Answer::where('question_id', $request->question_id)->withTrashed()->get();
		$lastId = $request->confluence_id;
		$answerSort = ['A', 'B', 'C', 'D', 'E', 'G', 'H', 'I', 'J', 'K'];
		$totalStudents = Student::count();

		return view('contents.report.confluence', compact('answers', 'confluences', 'lastId', 'listAnswers', 'answerSort', 'totalStudents'));
	}
}