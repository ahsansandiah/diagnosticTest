<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = "media";
    protected $guarded = [];

    const IMAGE_TYPE = "image";
    const FILE_TYPE = "file";
    const VIDEO_TYPE = "video";

    public function postMedia($request, $file)
    {
    	if (is_null($file)) {
    		return null;
    	}

        $originalName = $file->getClientOriginalName();
        $originalExtension = $file->getClientOriginalExtension();

        if (in_array($originalExtension, ['jpg', 'jpeg', 'png'])) {
            $type = $this::IMAGE_TYPE;
        } elseif (in_array($originalExtension, ['pdf', 'doc', 'docx', 'xls', 'xlsx'])) {
            $type = $this::FILE_TYPE;
        } else {
            $type = $this::VIDEO_TYPE;
        }

        if ($type == $this::IMAGE_TYPE) {
            $path = public_path('/uploads/theory/images/');
        } else {
            $path = public_path('/uploads/theory/files/');
        }

        $media = new Media;
        $media->title = $request->title;
        $media->description = $request->description;
        $media->file_name = $file->getClientOriginalName();
        $media->path = $path;
        $media->type = $type;
        $media->file_type = $originalExtension;
        $media->save();

        $file->move($path, $file->getClientOriginalName());

        return $media;
    }
}