<?php

namespace App\Http\Controllers\Other;

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

use App\Models\Other;

class ProfileController extends Controller
{
    const BASE_VIEW_URL_PATH = 'student-contents.other.profile';

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
    	$profile = Other::where('type', 'profile')->first();


    	return view('contents.profile.index', compact('profile'));
    }

    public function indexStudents()
    {
        $profile = Other::where('type', 'profile')->first();


        return view($this::BASE_VIEW_URL_PATH, compact('profile'));
    }

    public function storeOrUpdate(Request $request)
    {
        $profileExisting = Other::where('type', $request->type)->first();
        if (is_null($profileExisting)) {
            $profile = new Other;
            $profile->title = $request->title;
            $profile->description = $request->description;
            $profile->type = $request->type;
            $profile->save();

            return redirect('/admin/profile')->with('status', 'Successfully created!');
        } else {
            $profileExisting->title = $request->title;
            $profileExisting->description = $request->description;
            $profileExisting->update();

            return redirect('/admin/profile')->with('status', 'Successfully updated!');
        }
    }
}
