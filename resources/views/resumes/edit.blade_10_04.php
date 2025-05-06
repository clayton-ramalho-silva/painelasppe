@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('resumes.index') }}">Currículos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Currículo: {{ $resume->id }} </li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('resumes.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <div class="row form-padrao">
                <div class="col-12 py-0 pe-5 form-1">
                    <h4 class="fw-normal mb-4">Cadastro de Currículo</h4>
        
                    <form class="form-padrao" id="form-companies-create" action="{{ route('resumes.update', $resume) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
        
                            <div class="col-9 py-0 pe-5 form-l">
        
                                <div class="row">
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" required value="{{ $resume->informacoesPessoais->nome }}">
                                            @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror
        
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email" required value="{{ $resume->contato->email }}">
                                            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                @php                  
                                                    $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                                                    $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                                                    $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';
                            
                                                    //Verifica se a idade é maior que 22 anos e 8 meses
                                                    $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                                                    $limiteEmMeses = (22 * 12) + 8;
                                                @endphp
                                            
                                                @if ($idadeEmMeses > $limiteEmMeses)
                                                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger" style="right: -23%;">
                                                        {{ $idadeFormatada }}                                               
                                                    </span>                                                
                                                @else
                                                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-light text-dark" style="right: -23%;">
                                                        {{ $idadeFormatada }}                                              
                                                    </span>
                                                    
                                                @endif
                                                <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                                <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="{{ $resume->informacoesPessoais->data_nascimento ? \Carbon\Carbon::parse($resume->informacoesPessoais->data_nascimento)->format('Y-m-d') : '' }}" required>
                                                @error('data_nascimento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>                           
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg" required value="{{ $resume->informacoesPessoais->rg }}">
                                            @error('rg') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf" required value="{{ $resume->informacoesPessoais->cpf }}">
                                            @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                                <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Solteiro" {{ $resume->informacoesPessoais->estado_civil === 'Solteiro' ? 'selected' : '' }} > Solteiro</option>
                                                    <option value="Casado" {{ $resume->informacoesPessoais->estado_civil === 'Casado' ? 'selected' : '' }}> Casado</option>
                                                    <option value="Divorciado" {{ $resume->informacoesPessoais->estado_civil === 'Divorciado' ? 'selected' : '' }}> Divorciado</option>
                                                    <option value="Viúvo" {{ $resume->informacoesPessoais->estado_civil === 'Viúvo' ? 'selected' : '' }}> Viúvo</option>
                                                    <option value="Separado" {{ $resume->informacoesPessoais->estado_civil === 'Separado' ? 'selected' : '' }}> Separado</option>
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
                                                    <option value="Sim" {{ $resume->informacoesPessoais->possui_filhos === 'Sim' ? 'selected' : ''}}> Sim</option>
                                                    <option value="Não" {{ $resume->informacoesPessoais->possui_filhos === 'Não' ? 'selected' : ''}}> Não</option>
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
                                                    <option value="Homem" {{ $resume->informacoesPessoais->sexo === 'Homem' ? 'selected' : '' }}> Homem</option>
                                                    <option value="Mulher" {{ $resume->informacoesPessoais->sexo === 'Mulher' ? 'selected' : '' }}> Mulher</option>
                                                    <option value="Prefiro não dizer" {{ $resume->informacoesPessoais->sexo === 'Prefiro não dizer' ? 'selected' : '' }} > Prefiro não dizer</option>
                                                </select>
                                                @error('sexo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                                <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Sim" {{ $resume->informacoesPessoais->cnh === 'Sim' ? 'selected' : '' }}> Sim</option>
                                                    <option value="Não" {{ $resume->informacoesPessoais->cnh === 'Não' ? 'selected' : '' }}> Não</option>
                                                    <option value="Em andamento" {{ $resume->informacoesPessoais->cnh === 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                                                </select>
                                                @error('cnh') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram" value="{{ $resume->informacoesPessoais->instagram }}">
                                            @error('instagram') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin" value="{{ $resume->informacoesPessoais->linkedin }}">
                                            @error('linkedin') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Telefone Celular" class="floatlabel form-control" id="telefone_celular" name="telefone_celular" required value="{{ $resume->contato->telefone_celular }}">
                                            @error('telefone_celular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Telefone de Contato" class="floatlabel form-control" id="telefone_residencial" name="telefone_residencial" value="{{ $resume->contato->telefone_residencial }}">
                                            @error('telefone_residencial') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-4 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Nome para contato" class="floatlabel form-control" id="nome_contato" name="nome_contato" value="{{ $resume->contato->nome_contato}}">
                                            @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <h4 class="fw-normal mb-4 mt-4">Endereço</h4>
        
                                    <div class="col-3 form-campo">
                                        <div class="mb-3 position-relative">
                                            <i class="fas fa-spinner"></i>
                                            <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep" required value="{{ $resume->contato->cep }}">
                                            @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-7 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro" required value="{{ $resume->contato->logradouro }}">
                                            @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-2 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero" required value="{{ $resume->contato->numero }}">
                                            @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento" required value="{{ $resume->contato->complemento }}">
                                            @error('complemento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro" required value="{{ $resume->contato->bairro }}">
                                            @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required value="{{ $resume->contato->cidade }}">
                                            @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 form-campo col-6">
                                        <div class="floatlabel-wrapper required">
                                            <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                            <select name="uf" id="uf" class="form-select active-floatlabel" required>
                                                <option></option>
                                                @php
                                                echo get_estados($resume->contato->uf);
                                                @endphp
                                            </select>
                                            @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
        
                                    {{-- <div class="col-6 form-campo">
                                        <div class="mb-3">
                                            <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required value="{{ $resume->contato->uf }}">
                                            @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div> --}}
        
                                    <h4 class="fw-normal mb-4 mt-4">Mais Informações</h4>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
                                            <label for="telefone_celular" class="form-label">Tem Reservista?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim" {{ $resume->informacoesPessoais->reservista === 'Sim' ? 'checked' : ''}}>
                                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="reservista1">
                                                Sim
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não" {{ $resume->informacoesPessoais->reservista === 'Não' ? 'checked' : ''}}>
                                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="reservista2">
                                                Não
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento" {{ $resume->informacoesPessoais->reservista === 'Em andamento' ? 'checked' : ''}}>
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
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz1" value="Sim, da ASPPE" {{ $resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="foi_jovem_aprendiz1">
                                                    Sim, da ASPPE
                                                </label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz2" value="Sim, de Outra Qualificadora" {{ $resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="foi_jovem_aprendiz2">
                                                    Sim, de Outra Qualificadora
                                                </label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz3" value="Não" {{ $resume->foi_jovem_aprendiz === 'Não' ? 'checked' : ''}}>
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
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto" @checked(
                                                        isset($resume->escolaridade) && 
                                                        isset($resume->escolaridade->escolaridade) && 
                                                        is_array($resume->escolaridade->escolaridade) && 
                                                        in_array('Ensino Médio Incompleto', $resume->escolaridade->escolaridade)
                                                    )>
                                                    <label class="form-check-label" for="escolaridade1">
                                                        Ensino Médio Incompleto
                                                    </label>
                                                </div>
                                                <div class="form-check form-check">
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo"  @checked(in_array('Ensino Médio Completo', $resume->escolaridade->escolaridade ?? []))>
                                                    <label class="form-check-label" for="escolaridade2">
                                                        Ensino Médio Completo
                                                    </label>
                                                </div>
                                                <div class="form-check form-check">
                                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro" @checked(in_array('Outro', $resume->escolaridade->escolaridade ?? []))>
                                                    <label class="form-check-label" for="escolaridade3">
                                                    Outro
                                                    </label>
                                                </div>
        
                                                <div class="campo-escondido check-escolaridade"{!! is_array($resume->escolaridade->escolaridade) ? ((in_array('Outro', $resume->escolaridade->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade->escolaridade === 'Outro' ? ' style="display:block"' : '') !!}>
                                                    <input type="text" placeholder="Qual curso?" class="floatlabel form-control" id="escolaridade_outro" name="escolaridade_outro" value="{{ $resume->escolaridade->escolaridade_outro }}">
                                                </div>
                                                @error('escolaridade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
                                        <div class="mb-3 form-checkbox">
                                            <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse1" value="Copa & Cozinha" name="vagas_interesse[]" @checked(in_array('Copa & Cozinha', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse1">
                                                    Copa & Cozinha
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse2" value="Administrativo" name="vagas_interesse[]" @checked(in_array('Administrativo', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse2">
                                                    Administrativo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse3" value="Camareiro(a) de Hotel" name="vagas_interesse[]" @checked(in_array('Camareiro(a) de Hotel', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse3">
                                                    Camareiro(a) de Hotel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse4" value="Recepcionista" name="vagas_interesse[]" @checked(in_array('Recepcionista', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse4">
                                                    Recepcionista
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse5" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]" @checked(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse5">
                                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse6" value="Construção e Reparos" name="vagas_interesse[]" @checked(in_array('Construção e Reparos', $resume->vagas_interesse ?? [])) >
                                                <label class="form-check-label" for="vagas_interesse6">
                                                    Construção e Reparos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]" @checked(in_array('Conservação e Limpeza', $resume->vagas_interesse ?? [])) >
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
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional1" value="Nenhuma por enquanto" name="experiencia_profissional[]" @checked(in_array('Nenhuma por enquanto', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional1">
                                                    Nenhuma por enquanto
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional2" value="Copa & Cozinha" name="experiencia_profissional[]" @checked(in_array('Copa & Cozinha', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional2">
                                                    Copa & Cozinha
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional3" value="Administrativo" name="experiencia_profissional[]" @checked(in_array('Administrativo', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional3">
                                                    Administrativo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional4" value="Camareiro(a) de Hotel" name="experiencia_profissional[]" @checked(in_array('Camareiro(a) de Hotel', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional4">
                                                    Camareiro(a) de Hotel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional5" value="Recepcionista" name="experiencia_profissional[]" @checked(in_array('Recepcionista', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional5">
                                                    Recepcionista
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional6" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]" @checked(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional6">
                                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional7" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]" @checked(in_array('TI (Tecnologia da Informação)', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional7">
                                                    TI (Tecnologia da Informação)
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional8" value="Construção e Reparos" name="experiencia_profissional[]" @checked(in_array('Construção e Reparos', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional8">
                                                    Construção e Reparos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional9" value="Conservação e Limpeza" name="experiencia_profissional[]" @checked(in_array('Conservação e Limpeza', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional9">
                                                    Conservação e Limpeza
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="experiencia_profissional10" value="Outro" name="experiencia_profissional[]" @checked(in_array('Outro', $resume->experiencia_profissional ?? []))>
                                                <label class="form-check-label" for="experiencia_profissional10">
                                                    Outro
                                                </label>
                                            </div>
                                            <div class="campo-escondido check-experiencia"{!! (in_array('Outro', $resume->experiencia_profissional ?? [])) ? ' style="display:block"' : '' !!}>
                                                <input type="text" placeholder="Qual?" class="floatlabel form-control" id="experiencia_profissional_outro" name="experiencia_profissional_outro" value="{{ $resume->experiencia_profissional_outro }}">
                                            </div>
                                            @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
        
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
        
                                            <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme1" value="FEMININO: Baby Look P"{{$resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look P' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme1">
                                                    FEMININO: Baby Look P
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme2" value="FEMININO: Baby Look M" {{$resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look M' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme2">
                                                FEMININO: Baby Look M
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme3" value="FEMININO: Baby Look G" {{$resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look G' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme3">
                                                FEMININO: Baby Look G
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme4" value="FEMININO: Baby Look GG" {{$resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look GG' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme4">
                                                FEMININO: Baby Look GG
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme5" value="MASCULINO:  P"{{$resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  P' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme5">
                                                    MASCULINO:  P
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme6" value="MASCULINO:  M" {{$resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  M' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme6">
                                                MASCULINO:  M
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme7" value="MASCULINO:  G" {{$resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  G' ? ' checked' : ' '}}>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="tamanho_uniforme7">
                                                MASCULINO:  G
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme8" value="MASCULINO:  GG" {{$resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  GG' ? ' checked' : ' '}}>
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
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica1" value="Básico"{{$resume->escolaridade->informatica === 'Básico' ? ' checked' : ' '}}>
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica1">
                                                    Básico
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica2" value="Intermediário" {{$resume->escolaridade->informatica === 'Intermediário' ? ' checked' : ' '}}>
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica2">
                                                Intermediário
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Avançado" {{$resume->escolaridade->informatica === 'Avançado' ? ' checked' : ' '}}>
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica3">
                                                Avançado
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="informatica" id="informatica4" value="Nenhum" {{$resume->escolaridade->informatica === 'Nenhum' ? ' checked' : ' '}}>
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="informatica4">
                                                Nenhum
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>
        
                                    <div class="d-flex col-6 form-campo">
        
                                        <div class="mb-3 form-checkbox">
                                            <label for="ingles" class="form-label">Conhecimento de Inglês?</label>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles1" value="Básico"{{$resume->escolaridade->ingles === 'Básico' ? ' checked' : ' '}}>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles1">
                                                    Básico
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles2" value="Intermediário" {{$resume->escolaridade->ingles === 'Intermediário' ? ' checked' : ' '}}>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles2">
                                                Intermediário
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles3" value="Avançado" {{$resume->escolaridade->ingles === 'Avançado' ? ' checked' : ' '}}>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles3">
                                                Avançado
                                                </label>
                                            </div>
        
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="ingles" id="ingles4" value="Nenhum" {{$resume->escolaridade->ingles === 'Nenhum' ? ' checked' : ' '}}>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                <label class="form-check-label" for="ingles4">
                                                Nenhum
                                                </label>
                                            </div>
        
                                        </div>
        
                                    </div>
        
                                    {{-- <div class="col-6">
        
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="informatica" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento de Informática?</label>
                                                <select name="informatica" id="informatica" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Básico" {{$resume->escolaridade->informatica === 'Básico' ? 'selected' : ' '}}> Básico</option>
                                                    <option value="Intermediário" {{$resume->escolaridade->informatica === 'Intermediário' ? 'selected' : ' '}}> Intermediário</option>
                                                    <option value="Avançado" {{$resume->escolaridade->informatica === 'Avançado' ? 'selected' : ' '}}> Avançado</option>
                                                    <option value="Nenhum" {{$resume->escolaridade->informatica === 'Nenhum' ? 'selected' : ' '}}> Nenhum</option>
                                                </select>
                                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <div class="col-6">
        
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="ingles" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento de Inglês?</label>
                                                <select name="ingles" id="ingles" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="Básico" {{ $resume->escolaridade->ingles === 'Básico' ? 'selected' : '' }}> Básico</option>
                                                    <option value="Intermediário" {{ $resume->escolaridade->ingles === 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                                                    <option value="Avançado" {{ $resume->escolaridade->ingles === 'Avançado' ? 'selected' : '' }}> Avançado</option>
                                                    <option value="Nenhum" {{ $resume->escolaridade->ingles === 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                                                </select>
                                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <div class="col-6">
        
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper required">
                                                <label for="tamanho_uniforme" class="label-floatlabel" class="form-label floatlabel-label">Tamanho para Confecção dos Uniformes</label>
                                                <select name="tamanho_uniforme" id="tamanho_uniforme" class="form-select active-floatlabel" required>
                                                    <option></option>
                                                    <option value="FEMININO: Baby Look P" {{ $resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look P' ? 'selected' : ''}}> FEMININO: Baby Look P</option>
                                                    <option value="FEMININO: Baby Look M" {{ $resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look M' ? 'selected' : ''}}> FEMININO: Baby Look M</option>
                                                    <option value="FEMININO: Baby Look G" {{ $resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look G' ? 'selected' : ''}}> FEMININO: Baby Look G</option>
                                                    <option value="FEMININO: Baby Look GG" {{ $resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look GG' ? 'selected' : ''}}> FEMININO: Baby Look GG</option>
                                                    <option value="MASCULINO:  P" {{ $resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  P' ? 'selected' : ''}}> MASCULINO:  P</option>
                                                    <option value="MASCULINO:  M" {{ $resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  M' ? 'selected' : ''}}> MASCULINO:  M</option>
                                                    <option value="MASCULINO:  G" {{ $resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  G' ? 'selected' : ''}}> MASCULINO:  G</option>
                                                    <option value="MASCULINO:  GG" {{ $resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  GG' ? 'selected' : ''}}> MASCULINO:  GG</option>
                                                </select>
                                                @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
        
                                    </div> --}}
        
                                </div>
        
                                <div class="col-9 bloco-submit d-flex mt-3 mb-3">
                                    <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                                    <a href="{{ route('resumes.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                                </div>
        
        
                            </div>
        
                            <div class="col-3 border-start py-0 ps-5 form-r">
        
                                <div class="mb-3 d-flex flex-column align-items-center">
                                    <p class="fw-bold text-center">Enviar Currículo</p>
        
                                    {{--
                                    <input type="file" id="file-upload" class="file-input"
                                    accept=".pdf, .doc, .docx, .txt, .xlsx, .pptx, image/*" name="curriculo_doc">
                                    --}}
                                    <div class="preview-container mb-3">
                                        @php
                                            $curriculo = $resume->curriculo_doc;
                                            $curriculoPath = $curriculo ? asset("documents/resumes/curriculos/{$curriculo}") : "https://github.com/mdo.png";
                                        @endphp
                                        @if ($curriculo)
                                            <a href="{{ $curriculoPath }}" target="_blank" > Baixar Currículo atual </a>
                                            <input type="file" id="file-upload" class="file-input"
                                           accept=".pdf" name="curriculo_doc" value="{{ $resume->curriculo_doc }}">
        
                                           {{-- <input type="file" class="form-control" id="curriculo_doc" name="curriculo_doc" value="{{ $resume->curriculo_doc }}"> --}}
                                        @else
                                            <img id="preview-image" src="{{ asset('img/image-not-found.png') }}" class="preview-image" alt="Prévia do Currículo">
                                            <input type="file" id="file-upload" class="file-input"
                                            accept=".pdf" name="curriculo_doc" value="{{ $resume->curriculo_doc }}">
                                        @endif
        
                                        <div id="preview-doc" class="preview-doc" style="display: none;">
                                            <p id="file-name"></p>
                                            <a id="file-download" href="#" target="_blank" class="btn btn-sm btn-primary">Baixar</a>
                                        </div>
                                    </div>
        
                                    <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>
        
                                    @error('curriculo_doc') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                @if ($resume->curriculo_externo)
                                    <div class="mb-3 d-flex flex-column align-items-center">                                    
                                        <a href="{{ $resume->curriculo_externo }}" target="_blanl" class="fw-bold text-center">Baixar Currículo Externo</a>
                                    </div>
                                    
                                @endif

                            </div>
        
                        </div>
        
                    </form>

                </div>
                
                <div class="col-12 border-top py-0 ps-5 form-r bloco-obs pt-5">
        
                    
        
                    <h4 class="fw-normal">Observações:</h4>                    
        
                    <div class="row mb-3 mt-3 bloco-observacoes">
        
                        <div class="card">
                            <div class="card-header bg-transparent">
                            <p>Observações:</p>
                            </div>
                            <div class="card-body">
                                @if ($resume->observacoes->isNotEmpty())
                                    @foreach ($resume->observacoes->sortByDesc('created_at') as $observacao )
                                        <p class="card-text"><b>{{$observacao->created_at->format('d/m/y')}}</b> - {{$observacao->observacao}} </p>
                                    @endforeach
                                @else
                                    Nenhuma observação.
                                @endif
        
                            </div>
                        </div>
        
                    </div>
        
        
                    <div class="row">
        
                        <form class="form-padrao d-flex justify-content-center" action="{{ route('resumes.storeHistory', $resume->id)}}" method="post">
        
                            @csrf
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Escreva sua observação</label>
                                <textarea name="observacao" id="observacao" class="form-control"></textarea>
                            </div>
                            <button class="btn-padrao btn-cadastrar mt-3" type="submit">Salvar</button>
        
                        </form>
        
                    </div>
        
                </div>
            </div>
            
        </div>

    </article>


    <!--Processos Seletivos do candidato -->
    <article class="f1">

        <h4>Processos Seletivos</h4>

        <p class="my-3">Vagas Associadas</p>

        <div class="table-container lista-processos-seletivos">

            <ul class="tit-lista">
                <li class="col1">Empresa</li>
                <li class="col2">Título</li>
                <li class="col3">Vagas</li>
                <li class="col4">Recrutador</li>
                <li class="col5">Status</li>
            </ul>

            @if ($jobs->count() > 0)

                @if ($jobAprovado)

                    {{-- Empresa selação aprovada --}}
                    @php
                    $selection = $resume->selections->where('job_id', $jobAprovado->id)->first();
                    @endphp

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-{{$jobAprovado->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="col1">
                            @if ($jobAprovado->company->logotipo)
                                <b>Empresa</b>
                                @if (file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" alt="{{ $jobAprovado->company->nome_fantasia }}" title="{{ $jobAprovado->company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $jobAprovado->company->nome_fantasia }}</strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            {{ $jobAprovado->cargo }}
                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{ $jobAprovado->filled_positions }} / {{ $jobAprovado->qtd_vagas }}
                        </li>
                        <li class="col4">
                            <b>Recrutador</b>
                            @if (count($jobAprovado->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($jobAprovado->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col5">
                            <b>Status</b>
                            <button disabled="disabled" class="btn btn-success">Contratado</button>
                        </li>

                    </ul>

                    <!-- Modal Seleção aprovado -->
                    <div class="modal fade modal-vagas" id="modal-selection-{{$jobAprovado->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº {{ $jobAprovado->id}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

                                                <ul>
                                                    <li class="col1">
                                                        @if ($jobAprovado->company->logotipo)
                                                            <b>Empresa</b>
                                                            @if (file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo)))
                                                                <img src="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" alt="{{ $jobAprovado->company->nome_fantasia }}" title="{{ $jobAprovado->company->nome_fantasia }}">
                                                            @else
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            @endif
                                                        @else
                                                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                        @endif
                                                        <span>
                                                            <strong>{{ $jobAprovado->company->nome_fantasia }}</strong>
                                                        </span>
                                                    </li>
                                                    <li class="col2">
                                                        <b>Setor</b>
                                                        {{ $jobAprovado->cargo }}
                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        {{ $jobAprovado->filled_positions }} / {{ $jobAprovado->qtd_vagas }}
                                                        @if ($jobAprovado->filled_positions >= $jobAprovado->qtd_vagas)
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        @endif
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        @if (count($jobAprovado->recruiters) <= 0)
                                                            Nenhum recrutador associado
                                                        @else
                                                            @foreach ($jobAprovado->recruiters as $recruiter)
                                                            {{ $recruiter->name }}
                                                            @endforeach
                                                        @endif
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>

                                            @if (!$selection)

                                                <form class="form-padrao d-flex" action="{{ route('selections.storeSelection') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="job_id" value="{{$jobAprovado->id}}">
                                                    <input type="hidden" name="resume_id" value="{{$resume->id}}">

                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aguardando" selected> Aguardando</option>
                                                                    <option value="aprovado" > Aprovado</option>
                                                                    <option value="reprovado" > Reprovado</option>
                                                                    <option value="Fila de Espera" > Fila de Espera</option>
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option>Escolher</option>
                                                                    <option value="0" > Negativa</option>
                                                                    <option value="1" > Positiva</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"></textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Salvar</button>

                                                    </div>

                                                </form>
                                            @else

                                                <form class="form-padrao d-flex" action="{{ route('selections.updateSelection', $selection->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aprovado" {{ $selection->status_selecao == 'aprovado' ? 'selected' : '' }} > Aprovado</option>
                                                                    <option value="reprovado" {{ $selection->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                    <option value="aguardando" {{ $selection->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                    <option value="Fila de Espera" {{ $selection->status_selecao == 'Fila de Espera' ? 'selected' : '' }}> Fila de Espera</option>
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option value="0" {{$selection->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                    <option value="1" {{ $selection->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selection->observacao }}</textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit" {{ $selection->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button>
                                                        {{-- <button class="btn btn-primary" type="submit">Atualizar</button> --}}

                                                    </div>

                                                </form>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    {{-- Fim selação aprovada --}}

                    @foreach ($jobs as $job)

                    <!-- Encontre a selection correspondente para este job e este resume -->
                    @php
                    $selection = $resume->selections->where('job_id', $job->id)->first();
                    @endphp

                    <ul style="{{$jobAprovado && $job->id == $jobAprovado->id? 'display: none': ''}}; background-color: #f1f1f1;" data-bs-toggle="tooltip" data-bs-placement="top" title="Candidato já contratado em outra vaga">
                        <li class="col1">
                            @if ($job->company->logotipo)
                                <b>Empresa</b>
                                @if (file_exists(public_path('documents/companies/images/'.$job->company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" alt="{{ $job->company->nome_fantasia }}" title="{{ $job->company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $job->company->nome_fantasia }}</strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            {{ $job->cargo }}
                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                        </li>
                        <li class="col4">
                            <b>Recrutador</b>
                            @if (count($job->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($job->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col5">
                            <b>Status</b>
                            @php
                            $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');
                            if($resume->status === 'inativo'){

                                $classe = 'status-inativo'; // Colocar cor vermelha
                                $status = 'Inativo';

                            } else {

                                if(($resume->interview)){

                                    if($resume->selections->contains('status_selecao', 'aprovado')){
                                        $classe = 'status-contratado'; // Colocar cor Verde
                                        $status = 'Contratado';
                                    } else {
                                        $classe = 'status-em-processo'; // Colocar cor Amarela
                                        $status = 'Em processo';
                                    }

                                } else {

                                    $classe = 'status-ativo'; // Colocar cor Cinza
                                    $status = 'Disponível';

                                }

                            }
                            @endphp

                            <i class="{{ $classe }}" title="{{ $status }}"></i>{{ $status }}
                        </li>

                        <div class="modal fade modal-vagas" id="modal-selection-{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4>Vaga - Nº {{ $job->id}}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-12">

                                                <div class="table-container lista-info-vaga">

                                                    <ul>
                                                        <li class="col1">
                                                            @if ($job->company->logotipo)
                                                                <b>Empresa</b>
                                                                @if (file_exists(public_path('documents/companies/images/'.$job->company->logotipo)))
                                                                    <img src="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" alt="{{ $job->company->nome_fantasia }}" title="{{ $job->company->nome_fantasia }}">
                                                                @else
                                                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                                @endif
                                                            @else
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            @endif
                                                            <span>
                                                                <strong>{{ $job->company->nome_fantasia }}</strong>
                                                            </span>
                                                        </li>
                                                        <li class="col2">
                                                            <b>Setor</b>
                                                            {{ $job->cargo }}
                                                        </li>
                                                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                            <b>Vagas</b>
                                                            {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                                                            @if ($job->filled_positions >= $job->qtd_vagas)
                                                                <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                            @endif
                                                        </li>
                                                        <li class="col4">
                                                            <b>Recrutador</b>
                                                            @if (count($job->recruiters) <= 0)
                                                                Nenhum recrutador associado
                                                            @else
                                                                @foreach ($job->recruiters as $recruiter)
                                                                {{ $recruiter->name }}
                                                                @endforeach
                                                            @endif
                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                    <h4>Processo Seletivo</h4>

                                                    @if (!$selection)

                                                        <form class="form-padrao d-flex" action="{{ route('selections.storeSelection') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="job_id" value="{{$job->id}}">
                                                            <input type="hidden" name="resume_id" value="{{$resume->id}}">

                                                            <div class="col-6">

                                                                <div class="mb-3 col-12">

                                                                    <div class="floatlabel-wrapper required">
                                                                        <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                        <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                            <option value="aguardando" selected> Aguardando</option>
                                                                            <option value="aprovado" > Aprovado</option>
                                                                            <option value="reprovado" > Reprovado</option>
                                                                        </select>
                                                                        @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                    </div>

                                                                </div>

                                                                <div class="col-12">

                                                                    <div class="floatlabel-wrapper required">
                                                                        <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                        <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                            <option>Escolher</option>
                                                                            <option value="0" > Negativa</option>
                                                                            <option value="1" > Positiva</option>
                                                                        </select>
                                                                        @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="floatlabel-wrapper form-textarea">
                                                                    <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"></textarea>
                                                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-12 d-flex justify-content-center">

                                                                <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Salvar</button>

                                                            </div>

                                                        </form>

                                                    @else

                                                        <form class="form-padrao d-flex" action="{{ route('selections.updateSelection', $selection->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-6">

                                                                <div class="mb-3 col-12">

                                                                    <div class="floatlabel-wrapper required">
                                                                        <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                        <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                            <option value="aprovado" {{ $selection->status_selecao == 'aprovado' ? 'selected' : '' }} > Aprovado</option>
                                                                            <option value="reprovado" {{ $selection->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                            <option value="aguardando" {{ $selection->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                        </select>
                                                                        @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                    </div>

                                                                </div>

                                                                <div class="col-12">

                                                                    <div class="floatlabel-wrapper required">
                                                                        <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                        <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                            <option value="0" {{$selection->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                            <option value="1" {{ $selection->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                        </select>
                                                                        @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-6">

                                                                <div class="floatlabel-wrapper form-textarea">
                                                                    <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selection->observacao }}</textarea>
                                                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-12 d-flex justify-content-center">

                                                                <button class="btn btn-primary" type="submit" {{ $selection->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button>
                                                                {{-- <button class="btn btn-primary" type="submit">Atualizar</button> --}}

                                                            </div>

                                                        </form>

                                                    @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </ul>
                    @endforeach

                @else

                    @foreach ($jobs as $job)
                    <!-- Encontre a selection correspondente para este job e este resume -->
                    @php
                    $selection = $resume->selections->where('job_id', $job->id)->first();
                    @endphp

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-{{$job->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="col1">
                            @if ($job->company->logotipo)
                                <b>Empresa</b>
                                @if (file_exists(public_path('documents/companies/images/'.$job->company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" alt="{{ $job->company->nome_fantasia }}" title="{{ $job->company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $job->company->nome_fantasia }}</strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            {{ $job->cargo }}
                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                        </li>
                        <li class="col4">
                            <b>Recrutador</b>
                            @if (count($job->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($job->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col5">
                            @php
                            $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');
                            if($resume->status === 'inativo'){

                                $classe = 'status-inativo'; // Colocar cor vermelha
                                $status = 'Inativo';

                            } else {

                                if(($resume->interview)){

                                    if($resume->selections->contains('status_selecao', 'aprovado')){
                                        $classe = 'status-contratado'; // Colocar cor Verde
                                        $status = 'Contratado';
                                    } else {
                                        $classe = 'status-em-processo'; // Colocar cor Amarela
                                        $status = 'Em processo';
                                    }

                                } else {

                                    $classe = 'status-ativo'; // Colocar cor Cinza
                                    $status = 'Disponível';

                                }

                            }
                            @endphp

                            <i class="{{ $classe }}" title="{{ $status }}"></i>
                        </li>

                    </ul>

                    <!-- Modal -->
                    <div class="modal fade modal-vagas" id="modal-selection-{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº {{ $job->id}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

                                                <ul>
                                                    <li class="col1">
                                                        @if ($job->company->logotipo)
                                                            <b>Empresa</b>
                                                            @if (file_exists(public_path('documents/companies/images/'.$job->company->logotipo)))
                                                                <img src="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" alt="{{ $job->company->nome_fantasia }}" title="{{ $job->company->nome_fantasia }}">
                                                            @else
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            @endif
                                                        @else
                                                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                        @endif
                                                        <span>
                                                            <strong>{{ $job->company->nome_fantasia }}</strong>
                                                        </span>
                                                    </li>
                                                    <li class="col2">
                                                        <b>Setor</b>
                                                        {{ $job->cargo }}
                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                                                        @if ($job->filled_positions >= $job->qtd_vagas)
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        @endif
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        @if (count($job->recruiters) <= 0)
                                                            Nenhum recrutador associado
                                                        @else
                                                            @foreach ($job->recruiters as $recruiter)
                                                            {{ $recruiter->name }}
                                                            @endforeach
                                                        @endif
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>

                                            @if (!$selection)

                                                <form class="form-padrao d-flex" action="{{ route('selections.storeSelection') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="job_id" value="{{$job->id}}">
                                                    <input type="hidden" name="resume_id" value="{{$resume->id}}">

                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aguardando" selected> Aguardando</option>
                                                                    <option value="aprovado" > Contrado</option>
                                                                    <option value="reprovado" > Reprovado</option>
                                                                    <option value="Fila de Espera" > Fila de Espera</option>
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required col-12">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option>Escolher</option>
                                                                    <option value="0" > Negativa</option>
                                                                    <option value="1" > Positiva</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observação</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"></textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Salvar</button>

                                                    </div>

                                                </form>

                                            @else

                                                <form class="form-padrao d-flex" action="{{ route('selections.updateSelection', $selection->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aprovado" {{ $selection->status_selecao == 'aprovado' ? 'selected' : '' }} > Contratado</option>
                                                                    <option value="reprovado" {{ $selection->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                    <option value="aguardando" {{ $selection->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                    <option value="Fila de Espera" {{ $selection->status_selecao == 'Fila de Espera' ? 'selected' : '' }}> Fila de Espera</option>
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option value="0" {{$selection->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                    <option value="1" {{ $selection->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observação</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selection->observacao }}</textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit" {{ $selection->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button>

                                                    </div>

                                                    {{-- <button class="btn btn-primary" type="submit">Atualizar</button> --}}

                                                </form>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    @endforeach
                @endif

            @else
            <span class="sem-resultado">Candidato não associado a vagas ainda</span>
            @endif

        </div>

    </article>

</section>
@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
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
                    $('#uf').val(result.uf).select2();
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

// Validação inicial
var validator = $( ".form-padrao" ).validate();
validator.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})
</script>
@endpush

@push('css-custom')
<style>
/*Botãos submit e cancelar*/
.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}
</style>
@endpush
