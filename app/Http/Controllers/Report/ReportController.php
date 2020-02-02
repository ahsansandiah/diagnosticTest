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

class ReportController extends Controller
{
	public function getByConfluence(Request $request)
	{
		$questions = [];
		if ($request->filled('confluence_id')) {
			$evaluations = Evaluation::where('confluence_id', $request->confluence_id)->get()->groupBy('question_id');

			foreach ($evaluations as $key => $value) {
				$questions[$key] = count($value);
			}
		}

		$confluences = Confluence::all();
		$listQuestions = Question::whereIn('id', array_keys($questions))->withTrashed()->get();
		$lastId = $request->confluence_id;

		return view('contents.report.confluence', compact('questions', 'confluences', 'lastId', 'listQuestions'));
	}
}