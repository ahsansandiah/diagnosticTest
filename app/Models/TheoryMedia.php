<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheoryMedia extends Model
{
    use SoftDeletes;

    protected $table = "theory_media";
    protected $guarded = [];


    public function theory()
    {
    	return $this->belongsTo('App\Models\Theory', 'theory_id', 'id');
    }

    public function media()
    {
    	return $this->belongsTo('App\Models\Media', 'media_id', 'id');
    }
}