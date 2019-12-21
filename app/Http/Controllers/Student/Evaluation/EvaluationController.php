<?php

namespace App\Http\Controllers\Student\Evaluation;

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

use App\Models\Answer;
use App\Models\Question;

class EvaluationController extends Controller
{

	public function getQuestion($questionId)
	{
		

	}

	public function store(Request $request)
	{
		
	}

}