<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Confluence extends Model
{
    use SoftDeletes;

    protected $table = "confluence";
    protected $guarded = [];
}
