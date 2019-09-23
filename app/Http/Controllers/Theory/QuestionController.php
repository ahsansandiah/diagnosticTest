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
use App\Models\Answer;
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
        $theories = Theory::all();

        return view('contents.question.stepone', compact('theories'));
    }

    public function store(Request $request)
    {
        $question = Question::create($request->all());

        return redirect('/admin/question/create-step-two/'.$question->id)->with('status', 'Successfully created!');
    }

    public function createStepTwo($id)
    {
        $question = Question::find($id);

        return view('contents.question.steptwo', compact('question'));
    }

    public function storeStepTwo(Request $request)
    {
        foreach ($request->answer as $value) {
            $answer = new Answer();
            $answer->question_id = $request->question_id;
            $answer->answer = $value;            
            $answer->save();
        }

        return redirect('/admin/question/detail/'.$request->question_id)->with('status', 'Successfully created!');
    }

    public function show($id)
    {
        $question = Question::with('answers', 'theory')->find($id);
        $theories = Theory::all();

        return view('contents.question.detail', compact('question', 'theories'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $question->question = $request->question;
        $question->description = $request->description;
        $question->theory_id = $request->theory_id;
        $question->time_limit = $request->time_limit;
        $question->score = $request->score;
        $question->order = $request->order;
        $question->update();
        
        return redirect('/admin/question/detail/'.$id)->with('status', 'Successfully created!');
    }

    public function setStatusAnswer($idQuestion, $idAnswer, $status)
    {
        $statusAnswer = Answer::setStatus($idAnswer, $status);

        return redirect('/admin/question/detail/'.$idQuestion)->with('status', 'Successfully created!');
    }

    public function storeAnswer(Request $request)
    {
        $answer = new Answer();
        $answer->question_id = $request->question_id;
        $answer->answer = $request->answer;        
        $answer->save();

        return redirect('/admin/question/detail/'.$request->question_id)->with('status', 'Successfully created!');
    }

    public function updateAnswer(Request $request, $idAnswer)
    {
        $answer = Answer::find($idAnswer);
        $answer->answer = $request->answer;
        $answer->update();

        return redirect('/admin/question/detail/'.$request->question_id)->with('status', 'Successfully created!');
    }

    public function deleteAnswer($idQuestion, $idAnswer)
    {
        $answer = Answer::find($idAnswer);
        $answer->delete();

        return redirect('/admin/question/detail/'.$idQuestion)->with('status', 'Successfully created!');
    }

    public function destroy($id)
    {
        $question =Question::find($id);
        $question->delete();

        return redirect('/admin/question')->with('status', 'Successfully deleted!');
    }
}
