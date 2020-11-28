<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Convert') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/trumbowyg.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/ui/trumbowyg.min.css">
    <!-- colors -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/colors/ui/trumbowyg.colors.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/colors/trumbowyg.colors.min.js"></script>
    <!-- font family -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
    <!-- font size -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
    <!-- history -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/history/trumbowyg.history.min.js"></script>
    <!-- template -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.21.0/plugins/template/trumbowyg.template.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- folder tree -->
    <link href="{{ asset('dist/themes/default/style.min.css') }}" rel="stylesheet">
    <script src="{{ asset('dist/jstree.min.js') }}" defer></script>

    <!-- folder tree end-->

    <!-- data type begin-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/numeric-comma.js" defer></script>
    <!-- data type end -->
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container" >
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Convert') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
