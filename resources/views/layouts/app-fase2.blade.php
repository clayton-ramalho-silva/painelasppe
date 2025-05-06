<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <header class="p-3 mb-3 border-bottom">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
          </a>
  
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            {{-- Link Dashboard - Visível para todos --}}
            <li><a href="{{ route('dashboard') }}" class="nav-link px-2 link-secondary">Dashboard</a></li>

            {{-- Link Empres - Exclusibo para Administrador --}}
           @if (Auth::user()->role === 'admin')
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Empresas
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('companies.index')}}">Listar</a></li>
                  <li><a class="dropdown-item" href="{{route('companies.create')}}">Criar</a></li>
                  
                </ul>
              </li>              
           @endif


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Vagas
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('jobs.index')}}">Listar</a></li>

                {{-- Link Criação Vagas Exclusivo para Administrador --}}
                @if (Auth::user()->role === 'admin')
                  <li><a class="dropdown-item" href="{{route('jobs.create')}}">Criar</a></li>                  
                @endif
                
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Currículos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('resumes.index')}}">Listar</a></li>
                {{-- Link criação de Currículos Exclusivo para Administrador --}}
              @if (Auth::user()->role === 'admin')
                  <li><a class="dropdown-item" href="{{route('resumes.create')}}">Criar</a></li>                 
              @endif
               
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Entrevistas
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('interviews.index')}}">Listar</a></li>
                <li><a class="dropdown-item" href="{{route('interviews.create')}}">Criar</a></li>               
               
              </ul>
            </li>

            {{-- Links para Gerenciamento de Usuários somente Adminstrador --}}
            @if (Auth::user()->role === 'admin')
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Usuários
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('users.index')}}">Todos Usuários</a></li>
                  <li><a class="dropdown-item" href="{{route('register')}}">Cadastrar Usuário</a></li>                               
                
                </ul>
              </li>              
            @endif

            <li><a href="{{ route('logs.index') }}" class="nav-link px-2 link-secondary">Logs</a></li>
          </ul>
  
          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form>
  
          <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              @php
                $fotoUser = Auth::user()->image; 
                $fotoPath = $fotoUser ? asset("documents/users/image/{$fotoUser}") : "https://github.com/mdo.png";
              @endphp
              <img src="{{ $fotoPath }}" alt="mdo" width="32" height="32" class="rounded-circle">                
              
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
              <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}</a></li>
              <li><a class="dropdown-item" href="#">Função: {{ Auth::user()->role }}</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{route('logout') }}" method="post">
                  @csrf
                  <a class="dropdown-item" 
                     href="{{route('logout')}}"
                     onclick="event.preventDefault();
                     this.closest('form').submit();"                  
                  >Logout</a>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>


    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      <div>
        {{ session('success') }}
      </div>
    </div>
    @endif
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>