<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = "question";
    protected $guarded = [];

    public function answers()
    {
    	return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function theory()
    {
    	return $this->hasOne('App\Models\Theory', 'id', 'theory_id');
    }
}