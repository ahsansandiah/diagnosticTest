<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheoryCategory extends Model
{
    use SoftDeletes;

    protected $table = "theory_category";
    protected $guarded = [];
}