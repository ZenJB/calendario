<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ _('Calendario Academico') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ _('Calendario Academico') }}
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

                        <!-- Caso logado -->
                        @if(Auth::user())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('settings') }}">{{ __('Definicoes') }}</a>
                            </li>

                            @if (DB::Table('alunos')->find(Auth::user()->id) != null)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cursos') }}">{{ __('Cursos') }}</a>
                                </li>
                            @endif

                            @if (DB::Table('docentes')->find(Auth::user()->id) != null)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('frequencias') }}">{{ __('Frequencias') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('aulas') }}">{{ __('Aulas') }}</a>
                                </li>
                            @endif

                            <!-- Caso seja admin -->
                            @if (DB::Table('administradores')->find(Auth::user()->id) != null)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('gestaoCursos') }}">{{ __('Gestao de Cursos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('gestaoCadeiras') }}">{{ __('Gestao de Cadeiras') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pedidosdesala') }}">{{ __('Pedidos de sala') }}</a>
                                </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('gerirutilizadores') }}">{{ __('Gerir Utilizadores') }}</a>
                                    </li>
                            @endif
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
