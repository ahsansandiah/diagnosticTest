<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $table = "evaluation";
    protected $guarded = [];

    const CORRECT_ANSWER = 1;

    const FORMATIVE_TYPE = 'formative';
    const DIAGNOSTIC_TYPE = 'diagnostic';

    public function question()
    {
    	return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }

    public function answer()
    {
    	return $this->belongsTo('App\Models\Answer', 'answer_id', 'id');
    }

    public function student()
    {
    	return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }

    public function confluence()
    {
    	return $this->belongsTo('App\Models\Confluence', 'confluence_id', 'id');
    }

    public function theory()
    {
    	return $this->belongsTo('App\Models\Theory', 'theory_id', 'id');
    }

    public function getResultByUser($student, $confluenceId, $type)
    {
        $query = $this->where('student_id', $student->id)->where('type', $type);
        if ($type == $this::DIAGNOSTIC_TYPE && !is_null($confluenceId)) {
            $query->where('confluence_id', $confluenceId);
        }

        $total = $query->count();
        $score = $query->where('correct', $this::CORRECT_ANSWER)->sum('score');
        $correctAnswer = $query->where('correct', $this::CORRECT_ANSWER)->count();

        return [
            'correct_answer' => $correctAnswer,
            'total_question' => $total,
            'total_answer' => $total,
            'score' => $score,
        ];
    }
}
