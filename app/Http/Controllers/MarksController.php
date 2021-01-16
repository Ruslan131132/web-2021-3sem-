<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use App\Accounts;

use App\Pupil;

use App\Teacher;

use App\Pupil_Subject_Marks;

use App\Subject;

use Carbon\Carbon;


class MarksController extends Controller
{
    public function check(Request $request) {
	    if (Session::has('user_id')) {
		    
		  $user_id =  Session::get('user_id', 0);  
		    
		  $account_info = Accounts::where('User_Id', $user_id)->first();
		    
		  if( $account_info->User_Type == 'Учитель' ){

		    $teachers_class;
			$teachers_subject;
			

		    
		    $classes_subjects = DB::table('teacher_subject_classes')
		    ->join('subjects', 'subjects.Id', '=', 'teacher_subject_classes.Subject_Id')
		    ->join('classes', 'classes.Id', '=', 'teacher_subject_classes.Class_Id')
		    ->select('teacher_subject_classes.Class_Id', 'classes.Name as className', 'subjects.Name as subjectName', 'teacher_subject_classes.Subject_Id')
		    ->where('teacher_subject_classes.Teacher_Id', '=', $user_id)
		    ->orderBy('classes.Name', 'asc')
		    ->orderBy('subjects.Name', 'asc')
		    ->get();
		    
		    
		    $choosed_id = $request->input('id');
		    
		    if (Session::has('teachers_class') && Session::has('teachers_subject')) {
			
				if($choosed_id==null){
			    
				   $teachers_class =  Session::get('teachers_class', 0);
				   $teachers_subject = Session::get('teachers_subject', 0);
				}
				else{
					
				  if($choosed_id == 'classes'){
				    $teachers_class =  $request->input('value');
				    $teachers_subject = Session::get('teachers_subject', 0);				  
					Session::forget('teachers_class'); 
				    Session::put('teachers_class', $teachers_class);
				  }
				  if($choosed_id == 'subjects'){
				    $teachers_subject =  $request->input('value');
				    $teachers_class =  Session::get('teachers_class', 0);				  
					Session::forget('teachers_subject'); 
				    Session::put('teachers_subject', $teachers_subject);
				  }
					   
				}
			}
		    
		    else{
			    $teachers_class = $classes_subjects[0]->className;
			    $teachers_subject = $classes_subjects[0]->subjectName;
			    
			    
			    Session::put('teachers_class', $teachers_class);
			    Session::put('teachers_subject', $teachers_subject);
			    
		    }



		    
		    $class_marks = DB::table('pupil_subject_marks')
            ->join('subjects', 'subjects.Id', '=', 'pupil_subject_marks.Subject_Id')
            ->join('pupils', 'pupils.Id', '=', 'pupil_subject_marks.Pupil_Id')
            ->join('classes', 'classes.Id', '=', 'pupils.Class_Id')
            ->select('pupil_subject_marks.*', 'subjects.Name as subName', 'pupils.*', 'pupil_subject_marks.Id as markId', 'classes.Name as className')
            ->where([
			    ['subjects.Name', '=', $teachers_subject],
			    ['classes.Name', '=', $teachers_class],
			])
            ->orderBy('pupils.Surname', 'asc')
            ->orderBy('pupil_subject_marks.Date_of_Mark', 'asc')
            ->get();
		    
		    $get_row = DB::table('classes')
		    ->join('pupils', 'pupils.class_Id', '=', 'classes.Id')
		    ->select('pupils.*')->where('classes.Name', '=', $teachers_class)
		    ->get();
		    
		    $choosed_subject_id = DB::table('subjects')->select('Id')->where('Name', '=', $teachers_subject)->get();
		    
		    return view('user_page.marks', ['class_marks' => $class_marks, 'User_Type' => $account_info->User_Type, 'row' => $get_row, 'classes_subjects' => $classes_subjects, 'choosed_subject' => $choosed_subject_id]);
				    
		  }
		    
		  if($account_info->User_Type=='Ученик'){
			  
			$class_marks = DB::table('pupil_subject_marks')
            ->join('subjects', 'subjects.Id', '=', 'pupil_subject_marks.Subject_Id')
            ->join('pupils', 'pupils.Id', '=', 'pupil_subject_marks.Pupil_Id')
            ->select('pupil_subject_marks.*', 'subjects.Name as subName', 'pupils.*' , 'subjects.Id as subId')
            ->where('pupils.Id', '=', $user_id)
            ->orderBy('subjects.Id', 'asc')
            ->orderBy('subjects.Name', 'asc')
            ->get();
		    
			$get_row = DB::select('select * from subjects');
			
			
						  	
			return view('user_page.marks', ['class_marks' => $class_marks, 'User_Type' => $account_info->User_Type, 'row' => $get_row]);		 
		  }

			    
		    
		  
	    }
	    
	    else{
		  return redirect()->route('main');
		
		}
		
			
	}
	
	public function sendMark(Request $request) {
      $mark_id = $request->input('id');
      $mark_value = $request->input('value');
      $pupil_id = $request->input('pupil_id');
      $subject_id = $request->input('subject_id');
      
      if($mark_id == null){
	      DB::insert('insert into pupil_subject_marks (Pupil_Id, Subject_Id, Mark) values (?, ?, ?)', [$pupil_id, $subject_id, $mark_value]);
	      return 'Оценка поставлена';
      }
      if($mark_id <> null){
	      if($mark_value == (1 || 2 || 3 || 4 || 5) ){
		    $date = Carbon::now()->format('Y-m-d H:i:s');
		    DB::update('update pupil_subject_marks set Mark = ?,Updated_at = ? where Id = ?', [$mark_value, $date, $mark_id]);
		    
		    
		    
		    return 'Оценка обновлена';
		  }
	     
	     else{
		    DB::delete('delete from pupil_subject_marks where Id = ?', [$mark_id]); 
		    return 'Оценка удалена';
   
	      }
	  }
    return 'Errorrrrrrrr!!!!';
    
    }
	
}
