@extends('layouts.user_page_layout')

@section('title-block')
User
@endsection

@section('custom-style-block')
<style>
  .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-radius:25px;
  }
  @media screen and  (min-device-width: 767px) and (max-device-width: 1000px) {
    .bd-placeholder-img {
		  width: 150px;
		  height: 150px;
	}
  }
  @media screen and (max-device-width: 767px) {
    .bd-placeholder-img {
		  width: 150px;
		  height: 150px;
    }
  }
	
</style>
@endsection


@section('li-blocks')
<li class="nav-item">
	            <a class="nav-link active" href="{{ route('login') }}">
	              <span data-feather="home"></span>
	              Главная <span class="sr-only">(current)</span>
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('shedule') }}">
	              <span data-feather="file"></span>
	              Расписание
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('marks') }}">
		          <span data-feather="bar-chart-2"></span>
	              Оценки
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('courses') }}">
	              <span data-feather="shopping-cart"></span>
	              Записаться на курс
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('olimpiads') }}">
	              <span data-feather="users"></span>
	              Олимпиады
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('ege') }}">
	              <span data-feather="layers"></span>
	              ЕГЭ
	            </a>
	          </li>

@endsection


@section('main-block')

	    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 class="h2">Добро пожаловать, {{ $data->Name }}</h1>
	      </div>
		  <div class="row">
			  
		  </div>
		  <div class="row">
		    <div class="col-md-4 order-md-2 mb-4">
			    <div class="col-auto d-lg-block" align="center">
		        <svg class="bd-placeholder-img" height="250" width="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $User_Type }}</text></svg>
		    	</div>
			    <br/>
		      <h4 class="d-flex justify-content-between align-items-center mb-3">
		        <span class="text-muted">Активных курсов</span>
		        <span class="badge badge-success badge-pill">{{ count($courses) }}</span>
		      </h4>
		      <ul class="list-group mb-3">
			    @php
				  $courses_name = array('Английский язык', 'Программирование', 'математика(ЕГЭ)', 'Русский язык(ЕГЭ)', 'Биология(ЕГЭ)', 'С++', 'Химия(ЕГЭ)', 'Физика');  
				@endphp
				@foreach($courses as $el)
				  @for($i = 0; $i < count($courses_name); $i++)
				  
			        @if($el->Course == $i+1) 
				      <li class="list-group-item d-flex justify-content-between lh-condensed">
			            <div>
			              <h6 class="my-0">Курс «{{$courses_name[$i]}}»</h6>
			              <small class="text-muted">@php echo date("d.m.y(h:i) ", strtotime(strval($el->created_at))); @endphp</small>
			            </div>
			          </li>
		            @endif
		            
		          @endfor
		        @endforeach


		      </ul>
		    </div>
		    
		    <div class="col-md-8 order-md-1">
		      <h4 class="mb-3">Информация</h4>
		      <form class="needs-validation" novalidate>
		        <div class="row">
		          <div class="col-md-4 mb-3">
		            <label for="firstName">Имя</label>
		            <input type="text" readonly class="form-control" id="firstName" value="{{ $data->Name }}" style="color: #000000">
		          </div>
		          <div class="col-md-4 mb-3">
		            <label for="lastName">Фамилия</label>
					<input type="text" readonly class="form-control" id="lastName" value="{{ $data->Surname }}" style="color: #000000">
		          </div>
		          <div class="col-md-4 mb-3">
		            <label for="Patronymic">Отчество</label>
					<input type="text" readonly class="form-control" id="Patronymic" value="{{ $data->Patronymic }}" style="color: #000000">
		          </div>
		        </div>
		
				<div class="row">
		          <div class="col-md-6 mb-3">
		            <label for="position">Должность</label>
		            <input type="text" readonly class="form-control" id="position" value="{{ $User_Type }}" style="color: #000000">
		          </div>
		          <div class="col-md-6 mb-3">
			        @if($User_Type == "Учитель")
		            <label for="class">Классный руководитель</label>
					<input type="text" readonly class="form-control" id="class" value="{{ $data->HaveClass }}" style="color: #000000">
				  </div>
		        </div>
				<div class="mb-3">
		          <label for="address">Адрес</label>
		          <input type="text" readonly class="form-control" id="address" value="Не указан" style="color: #000000">
		        </div>		        
					@else
					<label for="class">Класс</label>
					<input type="text" readonly class="form-control" id="class" value="{{ $data->Class }}" style="color: #000000">
					
		          </div>
		        </div>
		
		        <div class="mb-3">
		          <label for="address">Адрес</label>
		          <input type="text" readonly class="form-control" id="address" value="{{ $data->Address }}" style="color: #000000">
		        </div>		        
<!--
		        <div class="mb-3">
					<label for="loveSubjects">Любимые предметы</label>
					<textarea class="form-control" id="loveSubjects" rows="3"></textarea>
				</div>
-->
				@endif
<!-- 		        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button> -->
		      </form>
		    </div>
	  	  </div>
	    </main>

@endsection