<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class ExamController extends Controller
{
     public function check() {
	    if (Session::has('user_id')) {
		  return view('user_page.ege');
	    }
	    
	    else{
		  return redirect()->route('main');
		
		}
		
			
	}
}
