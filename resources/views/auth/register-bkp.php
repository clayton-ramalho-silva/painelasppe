<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Usuário</h1>

        <!-- Exibir mensagens de erro -->
        @if ($errors->any())           
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>                   
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Cadastro -->
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Papel do Usuário</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="recruiter" {{old('role') == 'recruiter' ? 'selected' : '' }}>Recrutador</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    
</body>
</html>