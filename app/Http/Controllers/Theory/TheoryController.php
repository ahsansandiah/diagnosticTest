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
use App\Models\Confluence;

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
}
