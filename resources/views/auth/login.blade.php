<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asppe - Login</title>

    <!-- CSS Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" type="text/css" rel="stylesheet"> <meta charset="utf-8">
<style>
*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
</style>

</head>
<body class="body-login">

    <div class="container">

        <div class="row bloco-login">

            <div class="bloco-logo">
                <img src="{{ asset('images/logo.png')}}" class="rounded" alt="Asppe">
            </div>

            <div class="justify-content-center flex-column">

                <h1>Faça seu login</h1>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="erro-login">{{ $error }}</div>
                @endforeach
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="row">

                        <p class="col-12 justify-content-center">
                            <label for="email" class="form-label">Digite seu e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </p>
                        <p class="col-12 justify-content-center">
                            <label for="password" class="form-label">Digite sua senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </p>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn-padrao btn-cadastrar">Entrar</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
