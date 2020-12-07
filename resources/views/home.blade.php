@extends('layouts.app')

@section('content')
<style>

</style>
<link href="{{ asset('css/menuBarCss.css') }}" rel="stylesheet">
<nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm" id="navMenuBar">
  <div class="container" >
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="menuBar">
      <li class="nav-item">
        <a class="nav-link  {{ $page_flg =='homePage'?'active':''}}"  href="{{ url('/homePage') }}">Home PAGE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $page_flg =='createProject'?'active':''}}" href="{{ url('/createProject') }}" >CREAT PROJECT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $page_flg =='pictures'?'active':''}}" href="{{ url('/pictures') }}">PICTURES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $page_flg =='allPdf'?'active':''}}"  href="{{ url('/allPdf') }}">ALL PDF</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $page_flg =='data'?'active':''}}"  href="{{ url('/data') }}">DATA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $page_flg =='folders'?'active':''}}"  href="{{ url('/folders') }}">FOLDERS</a>
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
