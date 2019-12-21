<?php

namespace App\Http\Controllers\Student\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use Cache;
use Session;

use App\Models\Media;

class MediaController extends Controller
{
    const BASE_VIEW_URL_PATH = 'student-contents.media';
	const BASE_VIEW_VIDEO = 'student-contents.media.video';

    const IMAGE_TYPE = "image";
    const FILE_TYPE = "file";
    const VIDEO_TYPE = "video";

	public function index($type)
	{		
		if ($type == $this::IMAGE_TYPE) {
			$images = Media::where('type', 'image')->get();
			$path = asset('/uploads/images/');
			
			return view($this::BASE_VIEW_URL_PATH.'.index', compact('images', 'path', 'type'));
		} else if ($type == $this::VIDEO_TYPE) {
			$videos = Media::where('type', 'video')->get();

			return view($this::BASE_VIEW_VIDEO.'.index', compact('videos'));
		} else {
			$files = Media::where('type', 'file')->paginate(20);
			$path = asset('/uploads/files/');
			
			return view($this::BASE_VIEW_URL_PATH.'.file', compact('files', 'path', 'type'));
		}
	}

}