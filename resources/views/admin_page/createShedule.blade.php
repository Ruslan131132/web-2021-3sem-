@extends('layouts.admin_page_layout')

@section('title-block')
CreateSubject
@endsection

@section('custom-style-block')
<style>
  header{
	  background-color: #ffffff;
	}
	body{
	  background-color: rgba(0, 0, 0, .85);	
	}
	  .flex-equal > * {
	  -ms-flex: 1;
	  flex: 1;
	}
	@media (min-width: 768px) {
	  .flex-md-equal > * {
	    -ms-flex: 1;
	    flex: 1;
	  }
	}
	
	.overflow-hidden { overflow: hidden; }
	

	  .form-signin {
	  width: 100%;
	  max-width: 330px;
	  padding: 15px;
	  margin: auto;
	}

	.form-signin .form-control {
	  position: relative;
	  box-sizing: border-box;
	  height: auto;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	.form-signin input[type="number"] {
/*
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	  -moz-appearance: textfield;
*/
	  -webkit-inner-spin-button
	}
	.form-signin input[type="number"]::-webkit-inner-spin-button { 
		display: none;
	}
	.form-signin input[type="password"] {
/*
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
*/
	}
	
	
	.password {
	position: relative;
	}
	.password-control {
		position: absolute;
		top: 40px;
		right: 23px;
		display: inline-block;
		width: 20px;
		height: 20px;
		background: url(http://bigproject.std-1055.ist.mospolytech.ru/img/forPassword/view.svg) 0 0 no-repeat;
	}
	.password-control.view {
		background: url(http://bigproject.std-1055.ist.mospolytech.ru/img/forPassword/noview.svg) 0 0 no-repeat;
	}
	

	.navbar {
	  background-color: rgba(0, 0, 0, .85);
	  -webkit-backdrop-filter: saturate(180%) blur(20px);
	  backdrop-filter: saturate(180%) blur(20px);
	}
	#card{
		 background-color: rgb(37 37 37);
	  -webkit-backdrop-filter: saturate(180%) blur(20px);
	  backdrop-filter: saturate(180%) blur(20px);
	
	}
	.navbar a {
	  color: #999;
	  transition: ease-in-out color .15s;
	}
	.navbar a:hover {
	  color: #fff;
	  text-decoration: none;
	}


</style>
@endsection



@section('li-blocks')
			  <li class="nav-item">
	            <a class="nav-link " href="{{ route('admin') }}">
	              <span data-feather="home"></span>
	              Создать пользователя
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('createClass') }}">
	              <span data-feather="file"></span>
	              Создать класс
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('createSubject') }}">
	              <span data-feather="file"></span>
	              Создать предмет
	            </a>
	          </li>
			  <li class="nav-item">
	            <a class="nav-link active" href="{{ route('createEmployment') }}">
	              <span data-feather="file"></span>
	              Создать занятость
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link active" href="{{ route('createShedule') }}" style="color: #ffffff">
	              <span data-feather="file"></span>
	              Создать расписание<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659l4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
</svg><span class="sr-only">(current)</span>
	            </a>
	          </li>
@endsection


@section('main-block')
    <div class="container-fluid"
	  <div class="row"
		<div class="col">
		  <div class="multi-collapse justify-content-md-center collapse show" id="collapseCreateUser">
			<div class="card card-body" id="card">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title">Создание/обновление расписания</h5>
				  <button type="button" class="close" data-toggle="collapse" href="#collapseCreateUser" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				
				<div class="modal-body">
					
					
					<form class="form-inline" method="POST" action="{{ route('createShed') }}">
						{{ csrf_field() }}
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="Class_Name">Класс:&nbsp;</label>
					    <select class="form-control" id="Class_Name" name="Class_Name" required>
						  @foreach($classes as $class)
						    <option>{{ $class->Name }}</option>
						  @endforeach
						  </select>
					    
					  </div>&nbsp;
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="Day_Number">День недели:&nbsp;</label>
					    <select class="form-control" id="Day_Number" name="Day_Number" required>
						    <option selected>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
						  </select>
					  </div>&nbsp;
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="Lesson_Number">Номер урока:&nbsp;</label>
					    <select class="form-control" id="Lesson_Number" name="Lesson_Number" required>
						    <option selected>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
						  </select>
					  </div>&nbsp;
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="Subject_Name">Предмет:&nbsp;</label>
					    <select class="form-control" id="Subject_Name" name="Subject_Name" required>
						  @foreach($subjects as $subject)
						    <option>{{ $subject->Name }}</option>
						  @endforeach
						  </select>
					    
					  </div>&nbsp;
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="Cabinet_Number">Кабинет:&nbsp;</label>
					    <select class="form-control" id="Cabinet_Number" name="Cabinet_Number" required>
						  @foreach($cabinets as $cabinet)
						    <option>{{ $cabinet->Name }}</option>
						  @endforeach
						  </select>
					  </div>&nbsp;
					  					  					  
					  
					  <button type="submit" class="btn btn-success mb-2">Добавить запись</button>
					</form>
					<p>Предупреждения:<br/>
					Если в указанный день в указанный урок кабинет занят другим классом - запись добавить не получится.<br/>
					Если в указанный день в указанный урок у выбранного класса уже есть урок - запись об этом классе в расписании обновится.<br/>
					Если записи в БД в указанный день в указанный урок у выбранного класса нет - запись добавится в БД.
					</p>
				        	
				        		
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>  	
    </div>
	
@endsection


@section('message')

	  
		@if(Session::has('flash_message'))
		  <div class="alert alert-info {{ Session::has('flash_message_important') ? 'alert-important' : '' }} text-center">
			@if(Session::has('flash_message_important'))
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			@endif
				  
			{{ session('flash_message') }}
			</div>
		@endif
	  
	
	
@endsection




















