<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $table = "answer";
    protected $guarded = [];

    public static function setStatus($id, $status, $questionId)
    {
        $answer = Answer::where('correct', '1')->where('question_id', $questionId)->whereNotIn('id', [$id])->first();
        if ($answer) {
            $answer->correct = 0;
            $answer->update();
        }

        $answerCorrect = Answer::find($id);
        $answerCorrect->correct = 1;
        $answerCorrect->update();

        return $answerCorrect;
    }
}
