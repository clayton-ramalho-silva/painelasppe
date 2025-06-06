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
            
            <li><a href="<?php echo e(route('dashboard')); ?>" class="nav-link px-2 link-secondary">Dashboard</a></li>

            
           <?php if(Auth::user()->role === 'admin'): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Empresas
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?php echo e(route('companies.index')); ?>">Listar</a></li>
                  <li><a class="dropdown-item" href="<?php echo e(route('companies.create')); ?>">Criar</a></li>
                  
                </ul>
              </li>              
           <?php endif; ?>


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Vagas
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(route('jobs.index')); ?>">Listar</a></li>

                
                <?php if(Auth::user()->role === 'admin'): ?>
                  <li><a class="dropdown-item" href="<?php echo e(route('jobs.create')); ?>">Criar</a></li>                  
                <?php endif; ?>
                
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Currículos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(route('resumes.index')); ?>">Listar</a></li>
                
              <?php if(Auth::user()->role === 'admin'): ?>
                  <li><a class="dropdown-item" href="<?php echo e(route('resumes.create')); ?>">Criar</a></li>                 
              <?php endif; ?>
               
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Entrevistas
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(route('interviews.index')); ?>">Listar</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('interviews.create')); ?>">Criar</a></li>               
               
              </ul>
            </li>

            
            <?php if(Auth::user()->role === 'admin'): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Usuários
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?php echo e(route('users.index')); ?>">Todos Usuários</a></li>
                  <li><a class="dropdown-item" href="<?php echo e(route('register')); ?>">Cadastrar Usuário</a></li>                               
                
                </ul>
              </li>              
            <?php endif; ?>

            <li><a href="<?php echo e(route('logs.index')); ?>" class="nav-link px-2 link-secondary">Logs</a></li>
          </ul>
  
          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form>
  
          <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
                $fotoUser = Auth::user()->image; 
                $fotoPath = $fotoUser ? asset("documents/users/image/{$fotoUser}") : "https://github.com/mdo.png";
              ?>
              <img src="<?php echo e($fotoPath); ?>" alt="mdo" width="32" height="32" class="rounded-circle">                
              
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
              <li><a class="dropdown-item" href="#"><?php echo e(Auth::user()->name); ?></a></li>
              <li><a class="dropdown-item" href="#">Função: <?php echo e(Auth::user()->role); ?></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="<?php echo e(route('logout')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <a class="dropdown-item" 
                     href="<?php echo e(route('logout')); ?>"
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


    <?php if(session('success')): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      <div>
        <?php echo e(session('success')); ?>

      </div>
    </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/layouts/app-fase2.blade.php ENDPATH**/ ?>