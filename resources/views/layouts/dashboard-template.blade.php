<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Bienvenido
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrate') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesion') }}
                                    </a>    
                                    <a class="dropdown-item" href="home">
                                      Inicio
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

        <main class="py-4 d-flex flex-nowrap">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                  <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                  <li class="nav-item">
                    <a href="#publish" class="nav-link active" aria-current="page">
                      <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                      Publicaciones
                    </a>
                  </li>
                  <li>
                    <a href="/articles" class="nav-link link-dark">
                      <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                      Articulos
                    </a>
                  </li>
                  <li>
                    <a href="/tags" class="nav-link link-dark">
                      <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                      Etiquetas
                    </a>
                  </li>
                  <li>
                    <a href="/categories" class="nav-link link-dark">
                      <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                      Categorias
                    </a>
                  </li>
                </ul>
                <hr>
                <div class="dropdown">
                  <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="..\img\profile.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>perfil</strong>
                  </a>
                  <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="view-profile">Ver Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Publicaciones</a></li>
                    <li><a class="dropdown-item" href="#">Buscador</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
                  </ul>
                </div>
              </div>
            @yield('content')
        </main>
        <footer class="mt-auto">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-muted">Bienvenido</a></li>
            <li class="nav-item"><a href="{{ url('/news')}}" class="nav-link px-2 text-muted">Actualizaciones</a></li>
            <li class="nav-item"><a href="{{ url('/about-me')}}" class="nav-link px-2 text-muted">Acerca de nosotros</a></li>
            </ul>
            <p class="text-center text-muted">© 2024 YourBlog, Team</p>
        </footer>
    </div>
</body>
</html>
