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

class MediaController extends Controller
{
	const BASE_VIEW_URL_PATH = 'contents.media';
    const IMAGE_TYPE = "image";
    const FILE_TYPE = "file";
    const VIDEO_TYPE = "video";
    
	public function index($type)
	{
		if ($type == $this::IMAGE_TYPE) {
			$images = Media::where('type', 'image')->paginate(10);
			$path = asset('/uploads/images/');
			
			return view($this::BASE_VIEW_URL_PATH.'.image', compact('images', 'path', 'type'));
		} else {
			$files = Media::where('type', 'file')->paginate(20);
			$path = asset('/uploads/files/');
			
			return view($this::BASE_VIEW_URL_PATH.'.file', compact('files', 'path', 'type'));
		}
	}

	public function store(Request $request)
	{
    	
    	$media = new Media;
		$media->type = 'video';
		if ($request->hasFile('file')) {
			$file = $request->file('file');
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
				$path = public_path('/uploads/images/');
			} else {
				$path = public_path('/uploads/files/');
			}

    		$media->file_name = $file->getClientOriginalName();
    		$media->path = $path;
    		$media->type = $type;
    		$media->file_type = $originalExtension;
    		$file->move($path, $file->getClientOriginalName());
		} 

		$media->title = $request->title;
    	$media->description = $request->description;
    	$media->url = $request->url;
    	$media->save();

    	if($request->from = 'theory') {
    		return redirect('/admin/theory/files')->with('message', 'Successfully created!');
    	}

		return redirect('/admin/media/'.$type)->with('message', 'Successfully created!');
	}

	public function destroy($id, $type)
	{
		$media = Media::findOrFail($id);
		$media->delete();

		return redirect('/admin/media/'.$type)->with('message', 'Successfully deleted!');
	}
}