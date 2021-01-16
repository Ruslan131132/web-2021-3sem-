@extends('layouts.user_page_layout')

@section('title-block')
EGE
@endsection

@section('custom-style-block')
    <style >
	  @media screen and (max-device-width: 767px) {
		.link_none_a {
		font-size: 9pt;
		}
	  }
	  @media screen and  (min-device-width: 767px) and (max-device-width: 1000px) {
		.link_none_a {
		  font-size: 9pt;
		}
	  }


	</style>
@endsection


@section('li-blocks')
<li class="nav-item">
	            <a class="nav-link" href="{{ route('login') }}">
	              <span data-feather="user"></span>
	              Главная <span class="sr-only"></span>
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('shedule') }}">
	              <span data-feather="shedule"></span>
	              Расписание
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('marks') }}">
		          <span data-feather="marks"></span>
	              Оценки 
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link " href="{{ route('courses') }}">
	              <span data-feather="courses"></span>
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
	            <a class="nav-link active" href="{{ route('ege') }}">
	              <span data-feather="layers"></span>
	              ЕГЭ
	            </a>
	          </li>

@endsection


@section('main-block')
	    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" link="#000000">
		  <section class="jumbotron text-center" style="margin-top: 2rem;">
		    <div class="container">
		      <h1>Подготовка к Экзаменам</h1>
		      <p class="lead text-muted">Подготовительные курсы Центра довузовского образования Москосвкого Политехнического Университета обеспечат солидную подготовку к выпускным и вступительным экзаменам, повышение среднего балла, ликвидацию пробелов в школьной программе, индивидуальный подход и помощь опытных преподавателей в выборе будущей профессии.</p>
		    </div>
		  </section>
		  <div class="row" style="text-align: center" align="center">
			  <div class="col">
		  	<h3><b>Мы гарантируем:</b></h3>
			  </div>
		  </div>
		  
	      <div class="table-responsive">
	        <table class="table table-striped table-sm" style="text-align: center;">
<!--
	          <thead>
	            <tr>
	              <th scope="col" style="width:25%;"></th>
	              <th scope="col" style="width:25%;">Оценки</th>
	              <th scope="col" style="width:25%;">Ср. балл</th>
	              <th scope="col" style="width:25%;">Предметы</th>
	            </tr>
	          </thead>
-->
	          <tbody>
			    <tr>
				  <td width="25%">
					<img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/2.png" class="mt48 mb24">
				  </td>
						<td width="25%">
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/3.png" class="mt48 mb24">
						</td>
						<td width="25%">
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/4.png" class="mt48 mb24">
						</td>
						<td width="25%">
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/5.png" class="mt48 mb24">
						</td>
					  </tr>
					  <tr>
						<td>
							 Университетский<br>
							 уровень подготовки
						</td>
						<td>
							 Научить понимать,<br>
							 а не «зубрить»
						</td>
						<td>
							 Индивидуальный<br>
							 подход
						</td>
						<td>
							 Доступные<br>
							 цены
						</td>
					  </tr>
					  <tr>
						<td>
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/6.png" class="mt48 mb24">
						</td>
						<td>
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/7.png" class="mt48 mb24">
						</td>
						<td>
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/8.png" class="mt48 mb24">
						</td>
						<td>
						  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/ege/9.png" class="mt48 mb24">
						</td>
					  </tr>
					  <tr>
						<td>
							 Ликвидировать<br>
							 пробелы в школьной<br>
							 программе
						</td>
						<td>
							 Педагогов, заинтересованных<br>
							 в хорошем результате
						</td>
						<td>
							 Удобное расписание<br>
							 занятий<br>
							 (будни или выходные)
						</td>
						<td>
							 Подготовку<br>
							 с учетом<br>
							 требований ФГОС
						</td>
					  </tr>
	          </tbody>
	        </table>
	      </div>

	      <br/>
	    
		  <div class="container" style="background: #e9ecef; border-radius: 27px;border: 3px solid #66CCCC;" >
		    <div class="row" style="text-align: center;margin-top: 1%" align="center">
		      <div class="col">
		        <b><p><a class="link_none_a" href="https://old.mospolytech.ru/index.php?id=5709" style="color: black">	КАК <nobr style="color: red">ПОСТУПИТЬ НА ПОДГОТОВИТЕЛЬНЫЕ КУРСЫ</nobr> Московского Политеха</a></p></b>
		      </div>
		    </div>
	      </div>
	      <br/>
	      <footer class="container">
		    <p style="text-align: right;">&copy; 2020 Московский Политехнический Университет · Курсы · Дневник</p>
		  </footer>
	    </main>
@endsection