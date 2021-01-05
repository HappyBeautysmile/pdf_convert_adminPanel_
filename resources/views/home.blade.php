@extends('layouts.app')
@section('content')
<link href="{{ asset('css/selection.css') }}" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-warning" id="navMenuBar">
	<div class="container">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link  {{ $page_flg =='homePage'?'active':''}}"  href="{{ url('/homePage') }}"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $page_flg =='createProject'?'active':''}}" href="{{ url('/createProject') }}" ><i class="fa fa-cubes" aria-hidden="true"></i> Créer un projet</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $page_flg =='data'?'active':''}}"  href="{{ url('/data') }}"><i class="fa fa-database" aria-hidden="true"></i> Databases</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $page_flg =='pictures'?'active':''}}" href="{{ url('/pictures') }}"><i class="fa fa-file-image-o" aria-hidden="true"></i> Portfolio</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $page_flg =='folders'?'active':''}}"  href="{{ url('/folders') }}"><i class="fa fa-folder-open" aria-hidden="true"></i> Tous les dossiers</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ $page_flg =='allPdf'?'active':''}}"  href="{{ url('/allPdf') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Visualiser les PDF</a>
			</li>
		</ul>
	</div>
</nav>
<div id="mainNavbarContainer">@yield('main_area')</div>
@endsection