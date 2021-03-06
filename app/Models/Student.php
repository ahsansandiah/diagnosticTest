<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = "student";
    protected $guarded = [];

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}