@include('Assets/header')
<div class="topnav">
    <!-- Caso logado -->
    @if(Auth::user())
        <a class="nav-link" href="{{ _('/home') }}">{{ __('Home') }}</a>
        @if (DB::Table('alunos')->find(Auth::user()->id) != null)
                <a class="nav-link" href="{{ route('alunoSegueCadeira') }}">{{ __('Cadeiras') }}</a>
                <a class="nav-link" href="{{ route('cursos') }}">{{ __('Cursos') }}</a>
        @endif
        @if (DB::Table('docentes')->find(Auth::user()->id) != null)
                <a class="nav-link" href="{{ route('frequencias') }}">{{ __('Frequencias') }}</a>
                <a class="nav-link" href="{{ route('aulas') }}">{{ __('Aulas') }}</a>
        @endif
    <!-- Caso seja admin -->
        @if (DB::Table('administradores')->find(Auth::user()->id) != null)
               <a class="nav-link" href="{{ route('gestaoCursos') }}">{{ __('Gestao de Cursos') }}</a>
               <a class="nav-link" href="{{ route('gestaoCadeiras') }}">{{ __('Gestao de Cadeiras') }}</a>
                <a class="nav-link" href="{{ route('pedidosdesala') }}">{{ __('Pedidos de sala') }}</a>
               <a class="nav-link" href="{{ route('gerirutilizadores') }}">{{ __('Gerir Utilizadores') }}</a>
        @endif
    @endif
<!-- Authentication Links -->
    @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    @else

            <a class="nav-link" href="{{ route('settings') }}">{{ __('Definicoes: '.Auth::user()->name) }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
    @endguest
</div>
<main>
    @yield('content')
</main>
    </div>
</body>
</html>
