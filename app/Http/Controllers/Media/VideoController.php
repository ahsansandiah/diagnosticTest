<?php

namespace App\Http\Controllers\Media;

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

class VideoController extends Controller
{
	const BASE_VIEW_URL_PATH = 'student-contents.media.video';

	public function index()
	{
		$videos = Media::where('type', 'video')->get();

		return view('contents.media.video-index', compact('videos'));
	}

	public function indexStudent()
	{
		$videos = Media::where('type', 'video')->get();

		return view($this::BASE_VIEW_URL_PATH.'.index', compact('videos'));
	}

	public function store(Request $request)
	{
		$video = new Media;
		$video->title = $request->title;
		$video->description = $request->description;
		$video->type = $request->type;
		$video->url = $request->url;
		$video->save();

        return redirect('/admin/media/video')->with('status', 'Successfully created!');
	}

	public function update(Request $request, $id)
	{
		$video = Media::find($id);
		$video->title = $request->title;
		$video->description = $request->description;
		$video->url = $request->url;
		$video->update();

        return redirect('/admin/media/video')->with('status', 'Successfully created!');
	}

	public function destroy($id)
	{
		$video = Media::find($id);
		$video->delete();

        return redirect('/admin/media/video')->with('status', 'Successfully created!');
	}
}