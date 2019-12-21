<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use Cache;
use Session;
use App\User;

use App\Models\Student;

class StudentController extends Controller
{
	public function index()
	{
		$students = Student::with('user')->paginate(20);

		return view('contents.student.index', compact('students'));
	}

	public function store(Request $request)
	{
		$user = new User;
		$user->email = $request->email;
		$user->name = $request->name;
		$user->role = 'student';
		$user->password = Hash::make('student123');
		$user->save();

		$student = new Student;
		$student->name = $request->name;
		$student->address = $request->address;
		$student->birthday = $request->birthday;
		$student->birthday_place = $request->birthday_place;
		$student->email = $request->email;
		$student->user_id = $user->id;
		$student->role = 'student';
		$student->save();

		return redirect('/admin/student')->with('status', 'Successfully created!');
	}

	public function update(Request $request, $id)
	{
		$student = Student::findOrFail($id);
		$student->name = $request->name;
		$student->address = $request->address;
		$student->email = $request->email;
		$student->birthday = $request->birthday;
		$student->birthday_place = $request->birthday_place;
		$student->update();

		return redirect('/admin/student')->with('status', 'Successfully updated!');
	}

	public function resetPassword(Request $request, $id)
	{
		$user = User::find($id);
		$user->password = Hash::make('student123');
		$user->update();

		return redirect('/admin/student')->with('status', 'Successfully updated password!');
	}

	public function destroy($id)
	{
		$student = Student::findOrFail($id);
		$student->delete();

		return redirect('/admin/student')->with('status', 'Successfully deleted!');
	}
}