<?php

namespace App\Http\Controllers\Student\Theory;

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

use App\Models\TheoryMedia;
use App\Models\Theory;
use App\Models\TheoryCategory;
use App\Models\Confluence;
use App\Models\Media;

/**
 * 
 */
class TheoryController extends Controller
{
	const BASE_VIEW_URL_PATH = 'student-contents.theory';
	
	public function index()
	{
		$files = Media::paginate(10);
        $path = asset('/uploads/files');

        return view($this::BASE_VIEW_URL_PATH.'.list', compact('files', 'path'));
	}
}