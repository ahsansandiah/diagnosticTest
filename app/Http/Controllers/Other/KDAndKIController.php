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

class KDAndKIController extends Controller
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
        $ki = Other::where('type', 'KI')->first();
    	$kd = Other::where('type', 'KD')->first();

    	return view('contents.ki-and-kd.index', compact('ki', 'kd'));
    }

    public function storeOrUpdateKI(Request $request)
    {
        $profileExisting = Other::where('type', $request->type)->first();
        if (is_null($profileExisting)) {
            $profile = new Other;
            $profile->title = $request->title;
            $profile->description = $request->description;
            $profile->type = $request->type;
            $profile->save();

            return redirect('/admin/ki-and-kd')->with('status', 'Successfully created!');
        } else {
            $profileExisting->title = $request->title;
            $profileExisting->description = $request->description;
            $profileExisting->update();

            return redirect('/admin/ki-and-kd')->with('status', 'Successfully updated!');
        }
    }    

    public function storeOrUpdateKD(Request $request)
    {
        $profileExisting = Other::where('type', $request->type)->first();
        if (is_null($profileExisting)) {
            $profile = new Other;
            $profile->title = $request->title;
            $profile->description = $request->description;
            $profile->type = $request->type;
            $profile->save();

            return redirect('/admin/ki-and-kd')->with('status', 'Successfully created!');
        } else {
            $profileExisting->title = $request->title;
            $profileExisting->description = $request->description;
            $profileExisting->update();

            return redirect('/admin/ki-and-kd')->with('status', 'Successfully updated!');
        }
    }
}
