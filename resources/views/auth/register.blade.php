@extends('layouts.app')

@section('content')

<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários1</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('users.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <h4 class="fw-normal mb-4">Cadastro do usuário</h4>

            <!-- Exibir mensagens de erro -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        <b>Erro de cadastro</b>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Formulário de Cadastro -->
            <form action="{{ route('register') }}" class="form-padrao" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="mb-3 col-6 form-campo">
                                <input type="text" class="form-control floatlabel" placeholder="Nome" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3 col-6 form-campo">
                                <input type="email" class="form-control floatlabel" placeholder="E-mail" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3 col-6 form-campo">
                                <input type="password" class="form-control floatlabel" placeholder="Senha" id="password" name="password" required>
                            </div>

                            <div class="mb-3 col-6 form-campo">
                                <input type="password" class="form-control floatlabel" placeholder="Confirme a Senha" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="mb-3">
                                <div class="floatlabel-wrapper required">
                                    <label for="role" class="label-floatlabel" class="form-label floatlabel-label">Papel do Usuário</label>
                                    <select name="role" id="role" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="recruiter" {{old('role') == 'recruiter' ? 'selected' : '' }}>Recrutador</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Administrador</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-9 d-flex bloco-submit mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                            <a href="{{ route('users.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">

                            <p class="fw-bold text-center">Foto</p>
                            <input type="file" id="file-upload" class="file-input" accept="image/*" name="image">
                            <div class="preview-container mb-3">
                                <img id="preview-image" src="{{ asset('img/image-not-found.png') }}" class="preview-image" alt="Prévia do logotipo">
                            </div>
                            <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>

                            @error('logotipo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>

                </div>

            </form>

        </div>

    </article>

</section>
@endsection

@push('scripts-custom')

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/floatlabels.min.js') }}"></script>
<script>
$('#role').select2({
    placeholder: "Selecione",
});

// Regras de validação
$(".form-padrao").validate({
    rules:{
        name: "required",
        email: {required: true, email:true},
        password: "required",
        password_confirmation: {required: true, equalTo: "#password"}
    },message:{
        password_confirmation: {required: '', equalTo: ""}
    }
});

document.getElementById('file-upload').addEventListener('change', function(event) {
    if (event.target.files.length === 0) {
        return; // Sai da função se nenhum arquivo for selecionado
    }

    const file = event.target.files[0]; // Obtém o arquivo selecionado

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview-image').src = e.target.result; // Atualiza a imagem
    };
    reader.readAsDataURL(file);

});
</script>
@endpush


@push('css-custom')
<style>
article.container-form-create{
    box-shadow: none;
    padding: 0;
}


/* Esconde o input original */
.file-input {
    display: none;
}

/* Estiliza o botão */
.file-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

/* Efeito hover */
.file-label:hover {
    background-color: #0056b3;
}

/* Estiliza o texto do nome do arquivo */
.file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}

/* Estiliza a prévia da imagem */
.preview-container {
    width: 100%;
    text-align: center;
    margin-top: 15px;
}
.preview-image {
    display: block;
    max-height: 230px;
    width: 100%;
    height: auto;
    padding: 3px;
    box-sizing: border-box;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.btn-select-file{
    cursor: pointer;
    height: 38px;
    padding: 12px 20px !important;
    background-color: gray;
}

.btn-select-file:hover{
    background-color: #a7a7a7;
}
        .btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}

.breadcrumb-item{
    font-size: 23px;
    font-weight: 500;
}

.breadcrumb-item a{

    color: grey !important;
}

.breadcrumb-item.active{
    color: #009cff !important;
}
</style>
@endpush