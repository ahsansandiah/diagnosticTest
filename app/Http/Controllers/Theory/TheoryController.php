<?php

namespace App\Http\Controllers\Theory;

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

use App\Models\Theory;
use App\Models\TheoryCategory;
use App\Models\TheoryMedia;
use App\Models\Confluence;
use App\Models\Media;

class TheoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$theories = Theory::with(['category', 'confluence'])->paginate(20);
    	$theoryCategories = TheoryCategory::all();
    	$confluences = Confluence::all();

    	return view('contents.theory.index', compact('theories', 'theoryCategories', 'confluences'));
    }


    public function store(Request $request)
    {
        $theory = Theory::create($request->all());

        if (!$theory) {
            return Redirect::back()->with('error_message', 'Failed create');
        }

        return redirect('admin/theory')->with('message', 'Successfully created');
    }


    public function update(Request $request, $id)
    {
        $theory = Theory::find($id);
        $theory->update($request->all());

        if (!$theory) {
            return Redirect::back()->with('error_message', 'Failed create');
        }

        return redirect('admin/theory')->with('message', 'Successfully created');
    }


    public function destroy($id)
    {
        $theory = Theory::find($id);
        $theory->delete();

        if (!$theory) {
            return Redirect::back()->with('error_message', 'Failed delete');
        }

        return redirect('admin/theory')->with('message', 'Successfully delete');
    }

    public function getMediaById($id)
    {
        $medias = TheoryMedia::with('media', 'theory')->where('theory_id', $id)->paginate(10);
        $path = asset('/uploads/files');

        return view('contents.theory.media', compact('medias', 'id', 'path'));
    }

    public function getFiles()
    {
        $files = Media::paginate(10);
        $path = asset('/uploads/files');

        return view('contents.theory.theory', compact('files', 'path'));
    }

    public function postMedia(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $modelMedia = new Media;
            $media = $modelMedia->postMedia($request, $request->file('file'));

            $theoryMedia = new TheoryMedia;
            $theoryMedia->theory_id = $id;
            $theoryMedia->media_id = $media->id;
            $theoryMedia->save();

            return redirect('/admin/theory/media/'.$id)->with('message', 'Successfully created!');

        } else {
            return redirect('/admin/theory/media/'.$id)->with('error_message', 'Failed created!');
        }
    }

    public function deleteMedia($mediaId)
    {
        $media = Media::find($mediaId);
        $media->delete();

        return redirect('/admin/theory/files/')->with('message', 'Successfully deleted!');
    }
}
