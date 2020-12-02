@extends('layouts.app')

@section('content')
<style>
ul > li > a{
    font-size:20px;   
    border:none!important;
}
ul > li > a.active{
  color:white!important;
}
ul{
  border:none!important;
}
</style>
<nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
  <div class="container" >
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='homePage'?'active':''}}"  href="{{ url('/homePage') }}">Home PAGE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='createProject'?'active':''}}" href="{{ url('/createProject') }}" >CREAT PROJECT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='pictures'?'active':''}}" href="{{ url('/pictures') }}">PICTURES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='allPdf'?'active':''}}"  href="{{ url('/allPdf') }}">ALL PDF</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='data'?'active':''}}"  href="{{ url('/data') }}">DATA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-success {{ $page_flg =='folders'?'active':''}}"  href="{{ url('/folders') }}">FOLDERS</a>
      </li>
    </ul>
  </div>
</nav>
  <script>
    // Add active class to the current button (highlight it)
    // var header = document.getElementById("mainNavbarContainer");
    // var btns = header.getElementsByClassName("nav-link");
    // for (var i = 0; i < btns.length; i++) {
    //   btns[i].addEventListener("click", function() {
    //   var current = document.getElementsByClassName("active");
    //   current[0].className = current[0].className.replace(" active", "");
    //   this.className += " active";
    //   });
    // }

// $('#create_project').on('click', function() {
    //   $(this).addClass('active');
    //   $.ajax({        
    //     url: "{{ url('/createProject') }}", 
    //     success: function(result){
    //       $("#mainNavbarContainer").html(result);
    //   }});
    // })
    
</script>
<div id="mainNavbarContainer">@yield('main_area')</div>
@endsection
