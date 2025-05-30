<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ASPPE</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.html" class="nav-item nav-link active"><i class="fa fa-home me-2" aria-hidden="true"></i>Dashboard</a>
            <a href="{{ route('companies.index') }}" class="nav-item nav-link" ><i class="fa fa-building me-2" aria-hidden="true"></i>Empresas</a>                
            <a href="{{ route('jobs.index') }}" class="nav-item nav-link"><i class="fa fa-folder-open me-2" aria-hidden="true"></i>Vagas</a>
            <a href="{{ route('resumes.index') }}" class="nav-item nav-link"><i class="fa fa-users me-2" aria-hidden="true"></i>Currículos</a>
            <a href="{{ route('interviews.index') }}" class="nav-item nav-link"><i class="fa fa-comments me-2" aria-hidden="true"></i>Entrevistas</a>
            <a href="{{ route('users.index') }}" class="nav-item nav-link"><i class="fa fa-cog me-2" aria-hidden="true"></i>Usuários</a>
            
            
            
            
        </div>
    </nav>
</div>