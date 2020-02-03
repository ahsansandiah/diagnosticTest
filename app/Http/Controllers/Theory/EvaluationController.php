<?php

namespace App\Http\Controllers\Theory;

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

use App\Models\Evaluation;
use App\Models\Theory;
use App\Models\Student;
use App\Models\Confluence;

class EvaluationController extends Controller
{
	public function index(Request $request, $package)
	{
		$query = Evaluation::where('type', $package)->with('student', 'confluence');
		
		if ($request->filled('student_id') && $request->filled('confluence_id')) {
			$evaluationStudent = $query->where('student_id', $request->student_id)
										->where('confluence_id', $request->confluence_id);

        	$evaluations = $evaluationStudent->get();
			$totalQuestion = $evaluationStudent->count();
			$totalCorrectAnswer = $evaluationStudent->where('correct', '=', '1')->count();
        	$totalScore = $evaluationStudent->where('correct', '=', '1')->sum('score');

		} else {
			$totalCorrectAnswer = null;
			$totalScore = null;
			$evaluations = null;
			$totalQuestion = null;
			$evaluations = $query->get();
		}
		
		$theories = Theory::all();
		$students = Student::all();
		$confluences = Confluence::where('type', $package)->get();
		
		$viewData = [
			'package' => $package,
			'evaluations' => $evaluations,
			'theories' => $theories,
			'students' => $students,
			'confluences' => $confluences,
			'totalQuestion' => $totalQuestion,
			'totalCorrectAnswer' => $totalCorrectAnswer,
			'totalScore' => $totalScore,
		];

		return view('contents.evaluation.index', $viewData);
	}

	public function show($evaluationId, $studentId)
	{
		$query = Evaluation::where('id', $evaluationId);
		$evaluations = $query->get();
		$totalCorrectAnswer = $query->where('correct', '=', '1')->count();
        $totalScore = $query->where('correct', '=', '1')->sum('score');

		$totalQuestion = $query->count();

		$student = Student::find($studentId);

		if (!$evaluations) {
            return Redirect::back()->with('error_message', 'Data not found');
        }

        $viewData = [
			'evaluations' => $evaluations,
			'totalScore' => $totalScore,
			'totalCorrectAnswer' => $totalCorrectAnswer,
			'totalQuestion' => $totalQuestion,
			'student' => $student
		];

		return view('contents.evaluation.detail', $viewData);
	}

}