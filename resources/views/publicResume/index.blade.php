<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Asppe - Cadastro de Currículo</title>

<!-- CSS Scripts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/estilos.css') }}" type="text/css" rel="stylesheet"> <meta charset="utf-8">

  <style>
body{
    background-color: #f6f6f6;
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
        text-align: center;
        margin-top: 15px;
    }
    
    .preview-image {
        display: block;
        max-width: 200px;
        max-height: 200px;
        width: auto;
        height: auto;
        border-radius: 10px;
        border: 2px solid #ddd;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Estilo para documentos */
    .preview-doc {
        text-align: center;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }
    
    .btn-select-file{
        background-color: gray;
    }
    
    .btn-select-file:hover{
        background-color: #a7a7a7;
    }
    
    /*Botãos submit e cancelar*/
    .btn-cadastrar{
        background-color: #0056b3;
        padding: 10px 50px;
    }
    
    .btn-cadastrar:hover{
        background-color: #046dde;
    }
    
    
            /*Cabeçario*/
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
    
    article.container-form-create{
        box-shadow: none;
        padding: 0;
    }

    main{
        float: unset;
        margin: 0 auto;
    }

    .header{
        max-width: 1200px;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 50px;
    }

    .container-logo{
        display: flex;
        justify-content: center;
        width: 100%;
    }
    
    .container-logo .logo{
        font-size: 0;
    }

    .header p{
        width: 100%;
        text-align: center;        
    }

    #bloco-submit-mobile{
        display: none;
    }

    #bloco-submit-desktop{
        display: flex;
    }



    @media(max-width: 480px){
        .form-padrao .form-l{
            order: 1;
        }
        .form-padrao .form-r{
            order: 2;
        }

       #bloco-submit-desktop{
            display: none;
        }

        #bloco-submit-mobile{
        display: flex;
        order: 3;
    }
    }
</style>

</head>
<body>
    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg width="30px" height="30px" style="margin-bottom: 10px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>success</title>
            <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                <g id="add-copy" fill="#ffffff" transform="translate(42.666667, 42.666667)">
                    <path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M293.669333,137.114453 L323.835947,167.281067 L192,299.66912 L112.916693,220.585813 L143.083307,190.4192 L192,239.335893 L293.669333,137.114453 Z" id="Shape">

        </path>
                </g>
            </g>
        </svg>
      <div>
        {{ session('success') }}
      </div>
    </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg width="30px" height="30px" style="margin-bottom: 10px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>danger</title>
                <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                    <g id="error-copy" fill="#ffffff" transform="translate(42.666667, 42.666667)">
                        <path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M240.64,213.333333 L293.973333,160 L272,138.026667 L218.666667,191.36 L165.333333,138.026667 L143.36,160 L196.693333,213.333333 L143.36,266.666667 L165.333333,288.64 L218.666667,235.306667 L272,288.64 L293.973333,266.666667 L240.64,213.333333 Z" id="Shape">
                        </path>
                    </g>
                </g>
            </svg>
          <div>
            {{ session('danger') }}
          </div>
        </div>
    @endif
    <div class="header">
        <div class="container-logo">
            <a href="/" class="logo">ASPPE - Sistema</a>

        </div>
        <p class="mb-2 mt-3">Cadastre seu currículo.</p> 
        <p>Entraremos em contato assim que encontrarmos a vaga ideal para você.</p>
    </div>
    <main>
        <section class="sessao">
    
            <article class="f1 container-form-create">
        
                <div class="container">
        
                    <h4 class="fw-normal mb-4">Cadastro de Currículo</h4>
        
                    <form class="form-padrao" id="form-companies-create" action="{{ route('publicResume.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
        
                            <div class="col-9 py-0 pe-5 form-l">
        
                                <div class="row">
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" required value="{{old('nome')}}">
                                            @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror
        
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email" required value="{{old('email')}}">
                                            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                                <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" required value="{{old('data_nascimento')}}">
                                                @error('data_nascimento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg" required placeholder="RG" value="{{old('rg')}}">
                                            @error('rg') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf" required placeholder="CPF" value="{{old('cpf')}}">
                                            @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                                <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Solteiro"> Solteiro</option>
                                                    <option value="Casado"> Casado</option>
                                                    <option value="Divorciado"> Divorciado</option>
                                                    <option value="Viúvo"> Viúvo</option>
                                                    <option value="Separado"> Separado</option>
                                                </select>
                                                @error('estado_civil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                                                <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Sim"> Sim</option>
                                                    <option value="Não"> Não</option>
                                                </select>
                                                @error('possui_filhos') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                                <select name="sexo" id="sexo" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Homem"> Homem</option>
                                                    <option value="Mulher"> Mulher</option>
                                                    <option value="Prefiro não dizer"> Prefiro não dizer</option>
                                                </select>
                                                @error('sexo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="cnh" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                                <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Sim"> Sim</option>
                                                    <option value="Não"> Não</option>
                                                    <option value="Em andamento"> Em andamento</option>
                                                </select>
                                                @error('cnh') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram" value="{{old('instagram')}}">
                                            @error('instagram') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin" value="{{old('linkedin')}}">
                                            @error('linkedin') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Telefone Celular" class="floatlabel form-control" id="telefone_celular" name="telefone_celular" required value="{{old('telefone_celular')}}">
                                            @error('telefone_celular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Telefone de Contato" class="floatlabel form-control" id="telefone_residencial" name="telefone_residencial" value="{{old('telefone_residencial')}}">
                                            @error('telefone_residencial') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Nome para contato" class="floatlabel form-control" id="nome_contato" name="nome_contato" value="{{old('nome_contato')}}">
                                            @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <h4 class="fw-normal mb-4 mt-4">Endereço</h4>
        
                                    <div class="col-3 form-campo">
                                        <div class="mb-3 position-relative">
                                            <i class="fas fa-spinner"></i>
                                            <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep" required value="{{old('cep')}}">
                                            @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-7 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro" required value="{{old('logradouro')}}">
                                            @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-2 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero" required value="{{old('numero')}}">
                                            @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento" required value="{{old('complemento')}}">
                                            @error('complemento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro" required value="{{old('bairro')}}">
                                            @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required value="{{old('cidade')}}">
                                            @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 form-campo col-6">
                                        <div class="floatlabel-wrapper required">
                                            <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                            <select name="uf" id="uf" class="form-select active-floatlabel" required>
                                                <option></option>
                                                @php
                                                echo get_estados(old('uf'));
                                                @endphp
                                            </select>
                                            @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    {{-- <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required>
                                            @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div> --}}
        
                                    <h4 class="fw-normal mb-4 mt-4">Mais Informações</h4>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
        
                                            <label for="telefone_celular" class="form-label">Tem Reservista?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim">
                                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="reservista1">
                                                Sim
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não">
                                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="reservista2">
                                                Não
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento">
                                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="reservista3">
                                                Em andamento
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
                                        <div class="mb-3 form-checkbox">
                                            <label for="telefone_celular" class="form-label">Já foi Jovem Aprendiz?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz1" value="Sim, da ASPPE">
                                                <label class="form-check-label" for="foi_jovem_aprendiz1">
                                                    Sim, da ASPPE
                                                </label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz2" value="Sim, de Outra Qualificadora">
                                                <label class="form-check-label" for="foi_jovem_aprendiz2">
                                                    Sim, de Outra Qualificadora
                                                </label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz3" value="Não">
                                                <label class="form-check-label" for="foi_jovem_aprendiz3">
                                                    Não
                                                </label>
                                            </div>
                                            @error('foi_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
                                        <div class="mb-3 form-checkbox">
                                            <label for="telefone_celular" class="form-label">Formação/Escolaridade*
                                                (Especifique no campo "OUTRO" caso tenha Ensino Superior, Técnico ou outro)</label>
                                                <div class="form-check form-check">
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto">
                                                    <label class="form-check-label" for="escolaridade1">
                                                        Ensino Médio Incompleto
                                                    </label>
                                                </div>
                                                <div class="form-check form-check">
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo">
                                                    <label class="form-check-label" for="escolaridade2">
                                                        Ensino Médio Completo
                                                    </label>
                                                </div>
                                                <div class="form-check form-check">
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro">
                                                    <label class="form-check-label" for="escolaridade3">
                                                    Outro
                                                    </label>
                                                </div>
                                                <div class="campo-escondido check-escolaridade">
                                                    <input type="text" placeholder="Qual curso?" class="floatlabel form-control" id="escolaridade_outro" name="escolaridade_outro">
                                                </div>
                                                @error('escolaridade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
                                        <div class="mb-3 form-checkbox">
                                            <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse1" value="Copa & Cozinha" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse1">
                                                    Copa & Cozinha
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse2" value="Administrativo" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse2">
                                                    Administrativo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse3" value="Camareiro(a) de Hotel" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse3">
                                                    Camareiro(a) de Hotel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse4" value="Recepcionista" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse4">
                                                    Recepcionista
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse5" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse5">
                                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse6" value="Construção e Reparos" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse6">
                                                    Construção e Reparos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]">
                                                <label class="form-check-label" for="vagas_interesse7">
                                                    Conservação e Limpeza
                                                </label>
                                            </div>
                                            @error('vagas_interesse') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
                                        <div class="mb-3 form-checkbox">
                                            <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional1" value="Nenhuma por enquanto" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional1">
                                                    Nenhuma por enquanto
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional2" value="Copa & Cozinha" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional2">
                                                    Copa & Cozinha
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional3" value="Administrativo" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional3">
                                                    Administrativo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional4" value="Camareiro(a) de Hotel" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional4">
                                                    Camareiro(a) de Hotel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional5" value="Recepcionista" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional5">
                                                    Recepcionista
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional6" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional6">
                                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional7" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional7">
                                                    TI (Tecnologia da Informação)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional8" value="Construção e Reparos" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional8">
                                                    Construção e Reparos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional9" value="Conservação e Limpeza" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional9">
                                                    Conservação e Limpeza
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional10" value="Outro" name="experiencia_profissional[]">
                                                <label class="form-check-label" for="experiencia_profissional10">
                                                    Outro
                                                </label>
                                            </div>
                                            <div class="campo-escondido check-experiencia">
                                                <input type="text" placeholder="Qual?" class="floatlabel form-control" id="experiencia_profissional_outro" name="experiencia_profissional_outro">
                                            </div>
                                            @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
        
                                            <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme1" value="FEMININO: Baby Look P">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme1">
                                                    FEMININO: Baby Look P
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme2" value="FEMININO: Baby Look M">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme2">
                                                FEMININO: Baby Look M
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme3" value="FEMININO: Baby Look G">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme3">
                                                FEMININO: Baby Look G
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme4" value="FEMININO: Baby Look GG">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme4">
                                                FEMININO: Baby Look GG
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme5" value="MASCULINO:  P">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme5">
                                                    MASCULINO:  P
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme6" value="MASCULINO:  M">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme6">
                                                MASCULINO:  M
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme7" value="MASCULINO:  G">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme7">
                                                MASCULINO:  G
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme8" value="MASCULINO:  GG">
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme8">
                                                MASCULINO:  GG
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
                                            <label for="informatica" class="form-label">Conhecimento de Informática?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica1" value="Básico">
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica1">
                                                    Básico
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica2" value="Intermediário">
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica2">
                                                Intermediário
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Avançado">
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica3">
                                                Avançado
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Nenhum">
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica3">
                                                Nenhum
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
                                            <label for="ingles" class="form-label">Conhecimento de Inglês?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles1" value="Básico>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles1">
                                                    Básico
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles2" value="Intermediário">
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles2">
                                                Intermediário
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles3" value="Avançado">
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles3">
                                                Avançado
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles4" value="Nenhum">
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles4">
                                                Nenhum
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>      
                                   
        
                                </div>
        
                                <div id="bloco-submit-desktop" class="col-9 bloco-submit mt-3">
                                    <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                                    <a href="#" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                                </div>
        
                            </div>
        
                            <div class="col-3 border-start py-0 ps-5 form-r">
        
                                <div class="mb-3 d-flex flex-column align-items-center">
                                    <p class="fw-bold text-center">Faça Upload do Currículo</p>
        
                                    {{-- Aceita apenas pdf --}}
                                    <input type="file" id="file-upload" class="file-input"
                                        accept=".pdf" name="curriculo_doc">
        
                                    <div class="preview-container mb-3">
        
                                        <div id="preview-doc" class="preview-doc" style="display: none;">
                                            <p id="file-name"></p>
                                            <a id="file-download" href="#" target="_blank" class="btn btn-sm btn-primary">Baixar</a>
                                        </div>
                                    </div>
        
                                    <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>
        
                                    @error('curriculo_doc') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>                                
                            </div>

                            <div id="bloco-submit-mobile" class="col-9 bloco-submit mt-3">
                                <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                                <a href="#" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                            </div>
        
                        </div>
        
                    </form>
                </div>
        
            </article>
        
        </section>

    </main>



    <!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/floatlabels.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('file-upload').addEventListener('change', function (event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        // Verifica se o arquivo é um PDF
        if (file.type !== "application/pdf") {
            alert("Por favor, selecione um arquivo PDF.");
            event.target.value = ""; // Limpa o campo
            return;
        }

        // Atualiza a prévia do documento
        document.getElementById("file-name").textContent = file.name;
        document.getElementById("file-download").href = URL.createObjectURL(file);
        document.getElementById("preview-doc").style.display = "block";
    });
});

$('#uf').select2({
    placeholder: "Selecione",
});
$('#estado_civil').select2({
    placeholder: "Selecione",
});
$('#possui_filhos').select2({
    placeholder: "Selecione",
});
$('#sexo').select2({
    placeholder: "Selecione",
});
$('#cnh').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});
$('#tamanho_uniforme').select2({
    placeholder: "Selecione",
});

$('#rg').mask('00.000.000-0');
$('#cpf').mask('000.000.000-00');
$('#cep').mask('00000-000');
$('#telefone_celular').mask('(00) 00000-0000');
$('#telefone_residencial').mask(SPMaskBehavior, spOptions);

$('#cep').on('input', function(){

    var cep     = $(this).val(),
        digitos = cep.length;

    if(digitos === 9){

        $('.fa-spinner').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url : "{{ url('getCep') }}",
            data : {'cep': cep},
            type : 'POST',
            dataType : 'json',
            success : function(result){

                $('.fa-spinner').hide();

                if(result.msg === '1'){

                    $('#cidade').val(result.cidade);
                    $('#bairro').val(result.bairro);
                    $('#uf').val(result.uf);
                    $('#logradouro').val(result.rua);

                    setTimeout(function(){
                        $('.floatlabel').trigger('change');
                    }, 150)

                } else if(result.msg === '3'){

                    $.message('CEP enválido, por favor verifique o número informado', 2);

                } else {

                    $.message('CEP não encontrado, por favor verifique o número informado', 2);

                }

            }
        });

    }

});

$('#escolaridade3').on('click', function(){

    if($(this).is(':checked')){
        $('.check-escolaridade').slideDown(150);
        $('#escolaridade_outro').prop('disabled', false);
    } else {
        $('.check-escolaridade').slideUp(150);
        $('#escolaridade_outro').prop('disabled', true);
    }

});

$('#experiencia_profissional10').on('click', function(){

    console.dir('aaa');

    if($(this).is(':checked')){
        $('.check-experiencia').slideDown(150);
        $('#experiencia_profissional_outro').prop('disabled', false);
    } else {
        $('.check-experiencia').slideUp(150);
        $('#experiencia_profissional_outro').prop('disabled', true);
    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        escolaridade:"required",
        nome:"required",
        email:"required",
        rg:"required",
        cpf:"required",
        telefone_celular:"required",
        data_nascimento:"required",
        estado_civil:"required",
        possui_filhos:"required",
        sexo:"required",
        cnh:"required",
        cep:"required",
        logradouro:"required",
        numero:"required",
        complemento:"required",
        bairro:"required",
        cidade:"required",
        uf:"required",
        informatica:"required",
        ingles:"required",
        tamanho_uniforme:"required",
    }
});
</script>

</body>
</html>