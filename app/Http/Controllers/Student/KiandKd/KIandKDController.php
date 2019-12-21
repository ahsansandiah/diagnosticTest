<?php

namespace App\Http\Controllers\Student\KiandKd;

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

class KIandKDController extends Controller
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

    public function getKI()
    {
    	$ki = Other::where('type', 'KI')->first();


    	return view('student-contents.ki-and-kd.ki', compact('ki'));
    }

    public function getKD()
    {
        $kd = Other::where('type', 'KD')->first();


        return view('student-contents.ki-and-kd.kd', compact('kd'));
    }
}
