<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationStatus extends Model
{
    use SoftDeletes;

    protected $table = "evaluation_status";
    protected $guarded = [];

    const STATUS_DONE = 'done';
    const STATUS_REMEDIAL = 'remedial';

    const FORMATIVE_TYPE = 'formative';
    const DIAGNOSTIC_TYPE = 'diagnostic';

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function isDone($userId, $type, $confluenceId)
    {
    	switch ($type) {
            case $this::FORMATIVE_TYPE:
                $query = EvaluationStatus::where('user_id', $userId)
                            ->where('type', $this::FORMATIVE_TYPE)
                            ->where('status', $this::STATUS_DONE)->count();
                break;
            
            default:
                $query = EvaluationStatus::where('user_id', $userId)->where('type', $this::DIAGNOSTIC_TYPE)
                			->where('confluence_id', $confluenceId)
                			->where('status', $this::STATUS_DONE)->count();
                break;
        }

        if ($query == 0) {
        	return false;
        }

        return true;
    }
}