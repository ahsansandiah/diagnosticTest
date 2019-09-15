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

use App\Models\Question;
use App\Models\Theory;

class QuestionController extends Controller
{
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
    	$questions = Question::paginate(20);
        $theories = Theory::all();

    	return view('contents.question.index', compact('questions', 'theories'));
    }

    public function create()
    {
        $questions = Question::paginate(20);
        $theories = Theory::all();

        return view('contents.question.create', compact('questions', 'theories'));
    }
}
