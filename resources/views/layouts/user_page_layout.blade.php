<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ruslan Khasanshin">
    <meta name="generator" content="Jekyll v4.0.1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title-block') · Дневник</title>
    <style>
	  a.nav-link:hover {
	    text-decoration: none; /* Убираем подчеркивание */
	    color: #28a745; /* Цвет ссылки при наведении на нее курсора мыши */  
	     /* Цвет фона */
	  }

	</style>
    <!-- Bootstrap core CSS -->
	@include('css.bootstrap_css')
	    <!-- Custom styles for this project-->
    @yield('custom-style-block')
	@include('css.user_css')
	
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
	  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
		  <img src="http://bigproject.std-1055.ist.mospolytech.ru/img/mospolytech-logo-white.png" alt="logo" width="20" height="20" class="round"> Дневник
	  </a>
	  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <ul class="navbar-nav px-3" id="button_big_screen">
	    <li class="nav-item text-nowrap">
	       <a class="btn btn-danger"  href="{{ route('main') }}">Выйти</a>
	    </li>
	  </ul>
	</nav>

	<div class="container-fluid">
	  <div class="row">
	    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
		    
	      <div class="sidebar-sticky pt-3" >
	        <ul class="nav flex-column">
		      @yield('li-blocks')
	        </ul>
	
	        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
	          <span>Полезные ссылки</span>
	          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
	            <span data-feather="plus-circle"></span>
	          </a>
	        </h6>
	        <ul class="nav flex-column mb-2">
<!--
	          <li class="nav-item">
	            <a class="nav-link" href="#">
	              <span data-feather="file-text"></span>
	              Комиксы
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="#">
	              <span data-feather="file-text"></span>
	              Майнкрафт
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="#">
	              <span data-feather="file-text"></span>
	              Машинки
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="#">
	              <span data-feather="file-text"></span>
	              Лего
	            </a>
	          </li>
-->
	          <li class="nav-item active">
		  	    <a class="links_main nav-link py-2" href="https://www.gosuslugi.ru/105551/2/info">Ученику</a>
		  	  </li>   
		  	  <li class="nav-item active">
		  	    <a class="links_main nav-link " href="https://www.gosuslugi.ru/44300/2/info">Учителю</a>
		  	  </li>
		  	  <li class="nav-item active">
		  		<a class="links_main nav-link" href="https://www.gosuslugi.ru/help/news/2020_05_30_gosuslugi_family">Родителю</a>
		  	  </li>
			  
		  	  <li class="nav-item active">
		  		<a class="links_main nav-link" href="https://www.gosuslugi.ru/">Гос.Услуги</a>
		  	  </li>
		  	  <li class="nav-item active">
		  		<a class="links_main nav-link " href="https://www.gosuslugi.ru/10999">Дет.сад</a>
		  	  </li>
		  	  <li class="nav-item active">
		  		<a class="links_main nav-link" href="https://www.gosuslugi.ru/category">Дополнительно</a>
		  	  </li>

	          <li class="nav-item " id="button_little_screen" >
			    <a class="btn btn-danger"  href="{{ route('main') }}">Выйти</a>
			  </li>
	        </ul>
	      </div>
	    </nav>
	
		@yield('main-block')
	  </div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!--     <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script> -->
<!--     <script src="../bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script> -->
	@include('js.jquery_js')
	@include('js.bootstrap_bundle_js')
	@include('js.bootstrap_js')
	<script>
	  $('div.alert').not('.alert-important').delay(3000).slideUp(300);
	  
	  $("select.marks").change(function(){
		let id = $(this).attr('id');
		let value = $(this).val();
		let pupil_id = $(this).attr('data-pupil_id');
		let subject_id = $(this).attr('data-subject_id');
		
// 		console.log(value);
		
		$.ajax({
        url: '{{route("sendMark")}}',  
        type: 'POST', 
        data: {
	        "id": id,
		    "value": value,
		    'pupil_id': pupil_id,
		    'subject_id': subject_id
	        },
        datatype: 'JSON',
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }})
            .then(function(response) {
	            if(response){
		            console.log(response);
		            location.reload()
	            }
	            else{
		          console.log('Ошибка');  
	            } 
		    
			});
		});
		
		
		
		$('select.choose').change(function(){
		let id = $(this).attr('id');
		let value = $(this).val();
				
/*
		console.log(value);
		console.log(id);
*/
		
		$.ajax({
        url: '{{route("marks")}}',  
        type: 'POST', 
        data: {
	        "id": id,
		    "value": value
	        },
        datatype: 'JSON',
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }})
            .then(function(response) {
	            if(response){
		            console.log(response);
		            location.reload()
	            }
	            else{
		          console.log('Ошибка');  
	            } 
		    
			});
		});
		
		
		
	</script>
  </body>
</html>