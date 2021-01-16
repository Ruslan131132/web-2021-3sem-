<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

use App\Accounts;

use App\Pupil;

use App\Teacher;

// use App\Class;

use App\Subject;

use App\Cabinet;

use App\Lesson;

use App\Day;

use App\Shedule;

use App\Teacher_Subject_Class;



class SheduleController extends Controller
{
    
    public function SheduleData() {
	    if (Session::has('user_id')) {
		    
		  $user_id =  Session::get('user_id', 0);
		  $password = Session::get('password', 0);
	    }
	    
	    else{
		  return redirect()->route('main');
		
		}
		
		
		$account_info = Accounts::where('User_Id', $user_id)->first();
		$user_info;
		$user_class;
		$user_subject;
		
		if( $account_info->User_Type == 'Учитель' ){
		  $user_info = Teacher::where('Id', $account_info->User_Id)->first();
		  $user_class_sub = DB::select('select * from `teacher_subject_classes` where Teacher_Id = ?', [$user_id]);
		 		  
		  $user_class = array();
		  $user_subject = array();
		  foreach ($user_class_sub as $el) {
			$user_class[] = [$el->Class_Id];
			$user_subject[] = [$el->Subject_Id];
		  }
		  
		  //Вывод расписаиния всех предметов учителя:
		  
		  
		  
		  $user_shedule = DB::table('shedules')
            ->join('subjects', 'subjects.Id', '=', 'shedules.Subject_Id')
            ->join('lessons', 'lessons.Number', '=', 'shedules.Lesson_Number')
            ->select('shedules.*', 'subjects.Name', 'lessons.Start_Time', 'lessons.End_Time' )
			->whereIn('shedules.Class_Id', $user_class)
			->whereIn('shedules.Subject_Id', $user_subject)
			->orderBy('shedules.Day_Number', 'asc')
            ->orderBy('shedules.Lesson_Number', 'asc')
            ->get();

		}
		    
		if($account_info->User_Type=='Ученик'){
		  $user_info = Pupil::where('Id', $account_info->User_Id)->first();
		  $user_class = $user_info->Class_Id;
		  
		  $user_shedule = DB::table('shedules')
            ->join('subjects', 'subjects.Id', '=', 'shedules.Subject_Id')
            ->join('lessons', 'lessons.Number', '=', 'shedules.Lesson_Number')
            ->select('shedules.*', 'subjects.Name', 'lessons.Start_Time', 'lessons.End_Time')
            ->where('shedules.Class_Id', '=', $user_class)
            ->orderBy('shedules.Lesson_Number', 'asc')
            ->get();

		}
		
		$date = Carbon::now()->format('H:i:s');	
		$day = Carbon::now()->format('l');		
				
		return view('user_page.shedule', ['data' => $user_shedule, 'today' => $date, 'day' =>  $day, 'class' => $user_class]);
		
		
		

	}
    
}
