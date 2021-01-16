<?php

namespace App\Http\Controllers;

// use config\session;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use App\Accounts;

use App\Pupil;

use App\Teacher;

use App\Courses;

use Illuminate\Pagination\Paginator;

class AuthController extends Controller
{
	
	public function checkAndGet(){
		
		
		if (Session::has('user_id')) {
		    
		  $user_id =  Session::get('user_id', 0);
		  
		  $all_pupils = DB::table('accounts')
            ->join('pupils', 'pupils.Id', '=', 'accounts.User_Id')
            ->select('accounts.*', 'pupils.*')
            ->paginate(10);
           
           $all_teachers = DB::table('accounts')
            ->join('teachers', 'teachers.Id', '=', 'accounts.User_Id')
            ->select('accounts.*', 'teachers.*')
            ->paginate(10);             
          
           $classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
// 		  $all_users = DB::select('select * from accounts, pupils, teachers where pupils.Id = accounts.User_Id or teachers.Id = accounts.User_Id');
		  
		  return view('admin_page.register',['pupils' => $all_pupils, 'teachers' => $all_teachers, 'classes' => $classes ]);
		  
		}
		else{
		  return redirect()->route('main');
		
		}
		
		
	}
	
	
	
	
	
	
	
	
	
	
	public function createUser(Request $request){
	  $user = $request->input('User_Id');
		
		
		$account = new Accounts();
		$account->User_Id = $request->input('User_Id');
		$account->Password = bcrypt($request->input('Password')); 
		$account->User_Type = $request->input('User_Type');
		$account->email = $request->input('email');
		
		$account->save();
		
		
		$class_id = DB::table('classes')
		->select('classes.Id')
		->where('classes.Name', '=', $request->input('Class_Name'))
		->get()->first();

		
		if( $request->input('User_Type') == 'Учитель' ){
		  DB::insert('insert into teachers (Id, Name, Surname, Patronymic, HaveClass) values (?, ?, ?, ?, ?)', [$request->input('User_Id'), $request->input('Name'), $request->input('Surname'), $request->input('Patronymic'), $request->input('Class_Name')]);
			
		}
		
		if( $request->input('User_Type') == 'Ученик' ){
		  DB::insert('insert into pupils (Id, Name, Surname, Patronymic, Class_Id, Address) values (?, ?, ?, ?, ?, ?)', [$request->input('User_Id'), $request->input('Name'), $request->input('Surname'), $request->input('Patronymic'), $class_id->Id, $request->input('Address')]);
		
		}
		
		
		session()->flash('flash_message', 'Пользователь '.$user.' был добавлен');
// 		session()->flash('test', $request->input('Class_Name'));
		return redirect()->route('admin');
		 
		 
	}
	
	public function deleteUser(Request $request){
	  DB::delete('delete from accounts where User_Id = ?', [$request->input('deleteUser')]);
	  
	  if($request->input('deleteUser_Type') == 'Учитель'){
	    
	    
	    $has_emp = DB::table('teacher_subject_classes')
		->select('Teacher_Id')
		->where('Teacher_Id', '=', $request->input('deleteUser'))
		->get();
	    
	    $has_class = DB::table('classes')
		->select('Teacher_Id')
		->where('Teacher_Id', '=', $request->input('deleteUser'))
		->get();
	    
	    if(count($has_emp) != 0 ){
		  DB::delete('delete from teacher_subject_classes where Teacher_Id = ?', [$request->input('deleteUser')]);    
	    }
	    
	    if(count($has_class) != 0 ){
		  DB::delete('delete from classes where Teacher_Id = ?', [$request->input('deleteUser')]);    
	    }
	    
	    DB::delete('delete from teachers where Id = ?', [$request->input('deleteUser')]);
	      	  
	  }
	  if($request->input('deleteUser_Type') == 'Ученик'){
		
		
		$has_marks = DB::table('pupil_subject_marks')
		->select('Pupil_Id')
		->where('Pupil_Id', '=', $request->input('deleteUser'))
		->get();
		
		if(count($has_marks) != 0 ){
		  DB::delete('delete from pupil_subject_marks where Pupil_Id = ?', [$request->input('deleteUser')]);
		  
		      
	    }
	    
	    DB::delete('delete from pupils where Id = ?', [$request->input('deleteUser')]); 
		
	  }
	  
	  
	    	
	  session()->flash('flash_message', '!!Пользователь '.$request->input('deleteUser').' был удален!!');
	  return redirect()->route('admin');
	}
	
	
	
	
	
	public function createClass(Request $request) {
		
		$teacher_id = DB::table('teachers')
		->select('teachers.Id')
		->where('teachers.Name', '=', $request->input('Name'))
		->where('teachers.Surname', '=', $request->input('Surname'))
		->where('teachers.Patronymic', '=', $request->input('Patronymic'))
		->get();
		
		$class_id = DB::table('classes')
		->select('classes.Id')
		->where('classes.Name', '=', $request->input('Class_Name'))
		->get();
		
		if(count($class_id) == 0 && count($teacher_id) != 0){
		  DB::insert('insert into classes ( Name, Teacher_Id) values (?, ?)', [
			  $request->input('Class_Name'),
			  $teacher_id->first()->Id
		  ]);	
		  session()->flash('flash_message', 'Класс был добавлен');
		}
		else if(count($class_id) == 0 && count($teacher_id) == 0){
		  
		  session()->flash('flash_message', '!!Преподавателя не существует!!');
		  		
		
		}

		else if(count($class_id) != 0){
		  
		  session()->flash('flash_message', 'Класс уже существует');
		  		
		
		}
		
		
		return redirect()->route('createClass');
		
    }

	
	
	
    public function createSubject(Request $request) {
	    
		$subject_id = DB::table('subjects')
		->select('subjects.Id')
		->where('subjects.Name', '=', $request->input('Subject_Name'))
		->get();		
		if(count($subject_id) == 0 ){
		  DB::insert('insert into subjects (Name) values (?)', [$request->input('Subject_Name')]);	
		  session()->flash('flash_message', 'Предмет был добавлен');
		}
		else{
		  session()->flash('flash_message', '!!Предмет уже существует!!');
		}
		
		
		return redirect()->route('createSubject');
		
    }
    
    
    
    
    public function createEmp(Request $request) {
		
		$teacher_id = DB::table('teachers')
		->select('teachers.Id')
		->where('teachers.Name', '=', $request->input('Name'))
		->where('teachers.Surname', '=', $request->input('Surname'))
		->where('teachers.Patronymic', '=', $request->input('Patronymic'))
		->get();
		
		$class_id = DB::table('classes')
		->select('classes.Id')
		->where('classes.Name', '=', $request->input('Class_Name'))
		->get();
		
		$subject_id = DB::table('subjects')
		->select('subjects.Id')
		->where('subjects.Name', '=', $request->input('Subject_Name'))
		->get();			
		
		
		
		
		
		
		if(count($teacher_id) != 0){
			
		  $employment = DB::table('teacher_subject_classes')
			->select('*')
			->where('Subject_Id', '=', $subject_id->first()->Id)
			->where('Teacher_Id', '=', $teacher_id->first()->Id)
			->where('Class_Id', '=', $class_id->first()->Id)
			->get();	
			
		  if(count($employment) == 0){
			  DB::insert('insert into teacher_subject_classes ( Teacher_Id, Subject_Id, Class_Id) values (?, ?, ?)', [
				  $teacher_id->first()->Id,
				  $subject_id->first()->Id,
				  $class_id->first()->Id
			  ]);	
			  session()->flash('flash_message', 'Занятость добавлена');
		  }
		  
		  else{
			session()->flash('flash_message', 'Занятость уже существует');  
			  
		  }
		}
		
		else if(count($teacher_id) == 0){
		  
		  session()->flash('flash_message', '!!Преподавателя не существует!!');
		  		
		
		}
		
		
		return redirect()->route('createEmployment');
		
    }

    
    
    
    
    
    
    
    public function createShed(Request $request) {
		
		$class_id = DB::table('classes')
		->select('classes.Id')
		->where('classes.Name', '=', $request->input('Class_Name'))
		->get();
		
		$subject_id = DB::table('subjects')
		->select('subjects.Id')
		->where('subjects.Name', '=', $request->input('Subject_Name'))
		->get();			
		
		
		$engaged_cabinet = DB::table('shedules')
		->select('shedules.Class_Id')
		->where('shedules.Day_Number', '=', $request->input('Day_Number'))
		->where('shedules.Lesson_Number', '=', $request->input('Lesson_Number'))
		->where('shedules.Cabinet_Id', '=', $request->input('Cabinet_Number'))
		->get();
		
		
		
		if(count($engaged_cabinet) == 0){
			
		  $shedule_exists = DB::table('shedules')
		  ->select('shedules.id')
		  ->where('shedules.Day_Number', '=', $request->input('Day_Number'))
		  ->where('shedules.Lesson_Number', '=', $request->input('Lesson_Number'))
		  ->where('shedules.Class_Id', '=', $class_id->first()->Id)
		  ->get();
		  
		  if(count($shedule_exists) == 0){
		    DB::insert('insert into shedules ( Class_Id, Day_Number, Lesson_Number, Subject_Id, Cabinet_Id ) values (?, ?, ?, ?, ?)', [
			      $class_id->first()->Id,
			      $request->input('Day_Number'),
			      $request->input('Lesson_Number'),
				  $subject_id->first()->Id,
				  $request->input('Cabinet_Number')
				  
			  ]);	

		 	session()->flash('flash_message', 'Информация добавлена в расписание');	  
		  
		  }
		  
		  else{
			  
			  DB::update('update shedules set Subject_Id = ?,Cabinet_Id = ? where Id = ?', [$subject_id->first()->Id, $request->input('Cabinet_Number'), $shedule_exists->first()->id]);
			  session()->flash('flash_message', 'Информация обновлена');	
			  
		  }
			
			
			
			
		  	
		}
		
		else{
		$engaged_class_id = DB::table('classes')
		->select('classes.Name')
		->where('classes.Id', '=', $engaged_cabinet->first()->Class_Id)
		->get();
		  
		  session()->flash('flash_message', '!!Этот кабинет занят классом - '.$engaged_class_id->first()->Name.' !!');
		  		
		
		}
		
		
		return redirect()->route('createShedule');
		
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    public function login(Request $request) {
	    
	    
	    $test = $request->input('User_Id');
	    

		if (Session::has('user_id')) {
			
		  if($test==null){
		    
		    $user_id =  Session::get('user_id', 0);
		     $password = Session::get('password', 0);
		  }
		  else{
			   $user_id = $request->input('User_Id');
			   $password = $request->input('Password');
			Session::forget('user_id');
			Session::forget('password');
			   
			Session::put('user_id', $user_id);
		    Session::put('password', $password);
			   
		  }
	    }
	    
	    else{
		    $user_id = $request->input('User_Id');
		    $password = $request->input('Password');
		    
		    
		    Session::put('user_id', $user_id);
		    Session::put('password', $password);
		    
	    }
	    
	    $account_info = Accounts::where('User_Id', $user_id)->first();
		$user_info;
	    if($account_info && Hash::check($password, $account_info->Password)) {
		    
		    if( $account_info->User_Type == 'Админ' ){
			    return redirect()->route('admin');
			}
		    
		    else{
			    
// 			  $courses = Courses::where('User_Id', $user_id);
			  $courses = DB::select('select * from courses where User_Id = ? ', [$user_id]); 
// 			  DB::select('select * from courses where User_Id = ? ', [$user_id]);
			    
		      if( $account_info->User_Type == 'Учитель' ){
		        $user_info = Teacher::where('Id', $account_info->User_Id)->first();
		      }
		    
		      if($account_info->User_Type=='Ученик'){
// 		        $user_info = Pupil::where('Id', $account_info->User_Id)->first();
		        
		        
		        $user_info = DB::table('pupils')
	            ->join('classes', 'classes.Id', '=', 'pupils.Class_Id')
	            ->select('pupils.*', 'classes.Name as Class')
	            ->where('pupils.Id', '=', $account_info->User_Id)
	            ->get()->first();
		        
		        
		      }
		    

		      return view('user_page.user', ['data' => $user_info, 'User_Type' => $account_info->User_Type, 'courses' => $courses ] );
		    
		    }
		} 
		else {
		    return redirect()->route('main')->with('wrong', 'Проверьте правильность введенных данных');
		}
	    
	    
	    
    }
    
    
}
