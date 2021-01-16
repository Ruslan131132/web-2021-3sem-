<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use App\Courses;

class CoursesController extends Controller
{
    public function check() {
	    if (Session::has('user_id')) {
		  $courses = DB::select('select * from courses where User_Id = ? ', [Session::get('user_id', 0)]);
		  return view('user_page.courses', [ 'active_courses' => $courses ]);
	    }
	    
	    else{
		  return redirect()->route('main');
		
		}
		
			
	}
	
	 public function signUp(Request $request) {
		 
		$user_id =  Session::get('user_id', 0);
		$course = $request->input('signUp');
		
		$user_course = DB::select('select * from courses where User_Id = ? and Course = ?', [$user_id, $course]);
		
		
		if($user_course!=null){
			session()->flash('course_message', 'Вы уже записаны на курс '.$course);
			return redirect()->route('courses');
			
		
		}
		else{
			$course_user = new Courses();
			$course_user->User_Id = $user_id;
			$course_user->Course = $course; 
					
			$course_user->save();
			
			session()->flash('course_message', 'Вы были записаны на курс '.$course);
			return redirect()->route('courses');
			
		}
		
		 
	}
}
