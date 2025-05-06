<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Layout principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-light sidebar py-4">
                <div class="text-center mb-4">
                    <h4><i class="fas fa-user-graduate"></i> ASPPE'30</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-building"></i> Empresas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-briefcase"></i> Vagas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-alt"></i> Currículos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-calendar-check"></i> Entrevistas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i> Usuários
                        </a>
                    </li>
                </ul>
                <div class="text-center mt-auto">
                    <a href="#" class="text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </nav>

            <!-- Conteúdo Principal -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2>Dashboard</h2>
                    <div>
                        <input type="text" class="form-control d-inline-block w-50" placeholder="Buscar">
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary me-2">Filtros</button>
                        <button class="btn btn-outline-secondary">Este mês</button>
                    </div>
                    <div>
                        <span>Fernanda Silva</span>
                        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle ms-2">
                    </div>
                </div>

                <!-- Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Empresas Ativas</h5>
                                <h1>89</h1>
                                <small>20 empresas inativas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Vagas Totais</h5>
                                <h1>120</h1>
                                <small>20 vagas inativas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Vagas Abertas</h5>
                                <h1>35</h1>
                                <small>20 vagas inativas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Currículos Disponíveis</h5>
                                <h1>938</h1>
                                <small>198 currículos inativos</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabela de Vagas -->
                <h4>Vagas em Destaque</h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Tipo de Vaga</th>
                            <th>Vagas</th>
                            <th>Recrutador</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Krill</td>
                            <td>Caixa</td>
                            <td>0/2</td>
                            <td>Fernanda</td>
                            <td>
                                <button class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                <button class="btn btn-sm btn-outline-dark"><i class="fas fa-ellipsis-h"></i></button>
                            </td>
                        </tr>
                        <!-- Adicione mais linhas aqui -->
                    </tbody>
                </table>

                <!-- Painel Lateral de Currículos -->
                <div class="card bg-primary text-white">
                    <div class="card-header">Últimos Currículos</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-primary text-white">
                            <i class="fas fa-user-circle me-2"></i> Kayque Marques Santos
                        </li>
                        <li class="list-group-item bg-primary text-white">
                            <i class="fas fa-user-circle me-2"></i> Kayque Marques Santos
                        </li>
                        <li class="list-group-item bg-primary text-white">
                            <i class="fas fa-user-circle me-2"></i> Kayque Marques Santos
                        </li>
                    </ul>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
