<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>inoria flies</title>
		<meta name="description" content="INORWEB : spécialisé en création site web et stratégie digitale, intégration d'emailing, catalogue interactif, développement web, landing page.">
		<link rel="icon" type="image/png" sizes="16x16" href="/public/img/favicon.ico">
		<script src="{{ asset('js/app.js') }}" defer></script>
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link rel="preconnect" href="https://fonts.gstatic.com"> 
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/trumbowyg.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/colors/ui/trumbowyg.colors.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/colors/trumbowyg.colors.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/history/trumbowyg.history.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/template/trumbowyg.template.min.js"></script>

		<script src="{{ asset('js/createProject/trumbowygFontfamily.js') }}" defer></script>

		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('dist/themes/default/style.min.css') }}" rel="stylesheet">
		<script src="{{ asset('dist/jstree.min.js') }}" defer></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
		<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/numeric-comma.js" defer></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="{{ asset('css/section.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="app">
			<nav class="navbar navbar-expand-lg navbar-light bg-white">
				<div class="container" style="padding:10px 0px;">
					<img src="/public/img/if5.png" alt="INORWEB" style="width: 150px">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"><span class="navbar-toggler-icon"></span></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto"></ul>
						<ul class="navbar-nav ml-auto">
							@guest
							@else
							<div class="btn-group">
								<a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="lead"> <i class="fa fa-user-circle-o fa-lg text-primary" aria-hidden="true"></i> {{ Auth::user()-> name }}</span></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item text-right h6 text-muted" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span> <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Déconnexion ') }}</span></a>
									@if (Auth::user()->role_id == 1)
									<a class="dropdown-item text-right h6 text-muted"  href="{{ url('/admin/users') }}" target="_blank"><span> <i class="fa fa-cog" aria-hidden="true"></i> Admin Panel</span></a>
									@endif
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</div>
							</div>
							@endguest
						</ul>
					</div>
				</div>
			</nav>
			<main>
				@yield('content')
			</main>
		</div>
	</body>
</html>