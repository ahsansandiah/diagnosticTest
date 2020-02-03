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
use App\Models\Confluence;

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
    	$questions = Question::get();
        $theories = Theory::all();
        $confluences = Confluence::all();

    	return view('contents.question.index', compact('questions', 'theories', 'confluences'));
    }

    public function create()
    {
        $theories = Theory::all();
        $confluences = Confluence::all();

        return view('contents.question.stepone', compact('theories', 'confluences'));
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
        foreach ($request->answer as $keyAnswer => $value) {
            foreach ($request->suggestion as $keySuggestion => $suggestion) {
                if ($keySuggestion == $keyAnswer) {
                     foreach ($request->diagnosa as $keyDiagnosa => $diagnosa) {
                        if ($keyAnswer == $keyDiagnosa) {
                            $answer = new Answer();
                            $answer->question_id = $request->question_id;
                            $answer->answer = $value;
                            $answer->suggestion = $suggestion;
                            $answer->diagnosa = $diagnosa;
                            $answer->save();
                        }
                    }
                }
            }
        }

        return redirect('/admin/question/detail/'.$request->question_id)->with('status', 'Successfully created!');
    }

    public function show($id)
    {
        $question = Question::with('answers', 'theory')->find($id);
        $theories = Theory::all();
        $answerSort = ['A', 'B', 'C', 'D', 'E', 'G', 'H', 'I', 'J', 'K'];

        return view('contents.question.detail', compact('question', 'theories', 'answerSort'));
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
        $statusAnswer = Answer::setStatus($idAnswer, $status, $idQuestion);

        return redirect('/admin/question/detail/'.$idQuestion)->with('status', 'Successfully created!');
    }

    public function storeAnswer(Request $request)
    {
        $answer = new Answer();
        $answer->question_id = $request->question_id;
        $answer->answer = $request->answer;
        $answer->suggestion = $request->suggestion;
        $answer->diagnosa = $request->diagnosa;
        $answer->score = $request->score;
        $answer->save();

        return redirect('/admin/question/detail/'.$request->question_id)->with('status', 'Successfully created!');
    }

    public function updateAnswer(Request $request, $idAnswer)
    {
        $answer = Answer::find($idAnswer);
        $answer->suggestion = $request->suggestion;
        $answer->answer = $request->answer;
        $answer->diagnosa = $request->diagnosa;
        $answer->score = $request->score;
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
