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

use App\Models\Confluence;

class ConfluenceController extends Controller
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
    	$confluences = Confluence::paginate(20);


    	return view('contents.confluence.index', compact('confluences'));
    }


    public function store(Request $request)
    {
        $confluence = Confluence::create($request->all());

        if (!$confluence) {
            return Redirect::back()->with('error_message', 'Failed create');
        }

        return redirect('admin/confluence')->with('message', 'Successfully created');
    }


    public function update(Request $request, $id)
    {
        $confluence = Confluence::find($id);
        $confluence->update($request->all());

        if (!$confluence) {
            return Redirect::back()->with('error_message', 'Failed create');
        }

        return redirect('admin/confluence')->with('message', 'Successfully created');
    }


    public function destroy($id)
    {
        $confluence = Confluence::find($id);
        $confluence->delete();

        if (!$confluence) {
            return Redirect::back()->with('error_message', 'Failed delete');
        }

        return redirect('admin/confluence')->with('message', 'Successfully delete');
    }
}
