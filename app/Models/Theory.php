<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theory extends Model
{
    use SoftDeletes;

    protected $table = "theory";
    protected $guarded = [];

    public function category()
    {
        return $this->hasOne('App\Models\TheoryCategory', 'id', 'category_id');
    }

    public function confluence()
    {
        return $this->hasOne('App\Models\Confluence', 'id', 'confluence_id');
    }
}