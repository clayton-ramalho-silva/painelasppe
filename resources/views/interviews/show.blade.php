@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Entrevista</a></li>
          <li class="breadcrumb-item active" aria-current="page">Candidato: {{ $resume->informacoesPessoais->nome }}</li>
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

    <div class="f1 row mt-4 col-12">
        <div class="col-12 d-flex justify-content-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn-padrao btn-associar-vaga" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Associar a uma vaga
            </button>
        </div>
    </div>


    <article class="f1">

        <div class="container">

            <!-- Modal -->
            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <div class="modal fade modal-associar-vaga" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-xl">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4>Vagas abertas</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="table-container lista-associar-vaga">

                                            <ul class="tit-lista">
                                                <li class="col1">Empresa</li>
                                                <li class="col2">Título</li>
                                                <li class="col3">Vagas</li>
                                                <li class="col4">Cidade</li>
                                                <li class="col5">Candidatos Selecionados</li>
                                                <li class="col6">Ações</li>
                                            </ul>

                                            @if ($jobs->count() > 0)

                                                @foreach ($jobs as $job)
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
                                                        <b>Título</b>
                                                        {!! limite($job->cargo, 28) !!}
                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        {{ $job->filled_positions }} / {{ $job->qtd_vagas }}
                                                    </li>
                                                    <li class="col4">
                                                        <b>Cidade</b>
                                                        {{ $job->cidade }}
                                                    </li>
                                                    <li class="col5">
                                                        <b>Candidatos Selecionados</b>
                                                        @if ($job->resumes->count() > 0)
                                                            {{$job->resumes->count()}} candidatos
                                                        @else
                                                            Nenhum candidato selecionado
                                                        @endif
                                                    </li>
                                                    <li class="col6">
                                                        <b>Ações</b>
                                                        @php
                                                        $resumeAssociado = false;

                                                        foreach ($job->resumes as $curriculo) {
                                                            if ($curriculo->id == $resume->id) {
                                                                $resumeAssociado = true;
                                                            }
                                                        }
                                                        @endphp

                                                        @if ($resumeAssociado)
                                                            <button disabled="disabled" class="btn btn-primagy btn-sm d-inline">Associado</button>
                                                        @else

                                                        <form action="{{ route('interviews.associarVaga') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                            <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                                                            <button type="submit" class="btn btn-success btn-sm">Associar</button>
                                                        </form>
                                                        @endif
                                                    </li>

                                                </ul>
                                                @endforeach

                                            @else
                                            <span class="sem-resultado">Nenhuma vaga encontrada</span>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required value="{{ $resume->contato->uf }}">
                                    @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

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
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto" 
                                            @checked(in_array(
                                                'Ensino Médio Incompleto', 
                                                (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                                    ? $resume->escolaridade->escolaridade 
                                                    : []
                                            ))>
                                            <label class="form-check-label" for="escolaridade1">
                                                Ensino Médio Incompleto
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo" 
                                            @checked(in_array(
                                                'Ensino Médio Completo', 
                                                (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                                    ? $resume->escolaridade->escolaridade 
                                                    : []
                                            ))>
                                            <label class="form-check-label" for="escolaridade2">
                                                Ensino Médio Completo
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro" 
                                            @checked(in_array(
                                                'Outro', 
                                                (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                                    ? $resume->escolaridade->escolaridade 
                                                    : []
                                            ))>
                                            <label class="form-check-label" for="escolaridade3">
                                            Outro
                                            </label>
                                        </div>
                                        <div class="campo-escondido check-escolaridade"{!! $resume->escolaridade->escolaridade === 'Outro' ? ' style="display:block"' : '' !!}>
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

                            {{-- <div class="col-6 form-campo">

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

                            <div class="col-6 form-campo">

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

                            <div class="col-6 form-campo">

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

                        <div class="col-9 d-flex bloco-submit mt-3">
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
                                @endif

                                <div id="preview-doc" class="preview-doc" style="display: none;">
                                    <p id="file-name"></p>
                                    <a id="file-download" href="#" target="_blank" class="btn btn-sm btn-primary">Baixar</a>
                                </div>
                            </div>

                            <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>

                            @error('curriculo_doc') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </article>

</section>

<section class="sessao mt-5">

    <article class="f1">

        <div class="container">

            <form class="form-padrao" id="form-interview" action="{{ route('interviews.update', $interview)}}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">

                <div class="row mb-3 mt-3">

                    <div class="col-12">
                        <h4>Entrevista</h4>
                    </div>

                    <div class="col-12 d-flex flex-wrap">

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Data Entrevista:</b> {{ $interview->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Hora Entrevista:</b> {{ $interview->created_at->format('H:i:s') }}
                            </p>
                        </div>

                    </div>

                </div>
                <div class="row mb-3 mt-3">

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Saúde do Candidato" id="saude_candidato" name="saude_candidato" required value="{{ $interview->saude_candidato }}">
                            @error('saude_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Vacina COVID</label>
                                <select name="vacina_covid" id="vacina_covid" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Não pretende tomar" {{ $interview->vacina_covid === 'Não pretende tomar' ? 'selected' : ''}}> Não pretende tomar</option>
                                    <option value="Pretende tomar" {{ $interview->vacina_covid === 'Pretende tomar' ? 'selected' : ''}}> Pretende tomar</option>
                                    <option value="1 dose" {{ $interview->vacina_covid === '1 dose' ? 'selected' : ''}}> 1 dose</option>
                                    <option value="2 doses" {{ $interview->vacina_covid === '2 doses' ? 'selected' : ''}}> 2 doses</option>
                                    <option value="3 doses" {{ $interview->vacina_covid === '3 doses' ? 'selected' : ''}}> 3 doses</option>
                                    <option value="4 doses" {{ $interview->vacina_covid === '4 doses' ? 'selected' : ''}}> 4 doses</option>
                                    <option value="5 ou mais doses" {{ $interview->vacina_covid === '5 ou mais doses' ? 'selected' : ''}}> 5 ou mais doses</option>
                                </select>
                                @error('vacina_covid') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil" class="label-floatlabel" class="form-label floatlabel-label">Perfil</label>
                                <select name="perfil" id="perfil" class="form-select active-floatlabel" required>
                                    <option value="" selected disabled>Escolher</option>
                                    <option value="Administrativo" {{ strtolower($interview->perfil) === 'administrativo' ? 'selected' : ''}}> Administrativo</option>
                                    <option value="Operacional" {{ strtolower($interview->perfil) === 'operacional' ? 'selected' : ''}}> Operacional</option>
                                    <option value="Adm / Operacional" {{ strtolower($interview->perfil) === 'adm / operacional' ? 'selected' : ''}}> Adm / Operacional</option>
                                </select>
                                @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Perfil Santa Casa</label>
                                <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Sim" {{ $interview->perfil_santa_casa === 'SIM' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ $interview->perfil_santa_casa === 'NÃO' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('perfil_santa_casa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="classificacao" class="label-floatlabel" class="form-label floatlabel-label">Classificação</label>
                                <select name="classificacao" id="classificacao" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="A" {{ $interview->classificacao === 'A' ? 'selected' : ''}}> A</option>
                                    <option value="B" {{ $interview->classificacao === 'B' ? 'selected' : ''}}> B</option>
                                    <option value="C" {{ $interview->classificacao === 'C' ? 'selected' : ''}}> C</option>
                                    <option value="D" {{ $interview->classificacao === 'D' ? 'selected' : ''}}> D</option>
                                </select>
                                @error('classificacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="qual_formadora" name="qual_formadora" placeholder="Qual a formadora?(Caso já tenha sido jovem aprendiz.)" required value="{{ $interview->qual_formadora }}">
                            @error('qual_formadora') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Parecer do Entrevistador</label>
                                <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador" placeholder="Parecer do Entrevistador">{{ $interview->parecer_recrutador }}</textarea>
                                @error('parecer_recrutador') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="curso_extracurricular" class="label-floatlabel" class="form-label floatlabel-label">Cursos Extracurriculares</label>
                                <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" >{{ $interview->curso_extracurricular }}</textarea>
                                @error('curso_extracurricular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="apresentacao_pessoal" class="label-floatlabel" class="form-label floatlabel-label">Apresentação Pessoal</label>
                                <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" >{{ $interview->apresentacao_pessoal }}</textarea>
                                @error('apresentacao_pessoal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="experiencia_profissional" class="label-floatlabel" class="form-label floatlabel-label">Experiência Profissional (Tempo de Empresa/Motivo da Saída)</label>
                                <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" >{{ $interview->experiencia_profissional }}</textarea>
                                @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="caracteristicas_positivas" class="label-floatlabel" class="form-label floatlabel-label">Características Positivas</label>
                                <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" >{{ $interview->caracteristicas_positivas    }}</textarea>
                                @error('caracteristicas_positivas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="habilidades" class="label-floatlabel" class="form-label floatlabel-label">Habilidades</label>
                                <textarea class="form-control" id="habilidades" name="habilidades" >{{ $interview->habilidades }}</textarea>
                                @error('habilidades') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="porque_ser_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Porque gostaria de ser Jovem Aprendiz?</label>
                                <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" >{{ $interview->porque_ser_jovem_aprendiz    }}</textarea>
                                @error('porque_ser_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="qual_motivo_demissao" class="label-floatlabel" class="form-label floatlabel-label">Por qual motivo pediria demissão</label>
                                <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" >{{ $interview->qual_motivo_demissao }}</textarea>
                                @error('qual_motivo_demissao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pretencao_candidato" class="label-floatlabel" class="form-label floatlabel-label">Pretenções do candidato</label>
                                <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" >{{ $interview->pretencao_candidato }}</textarea>
                                @error('pretencao_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="objetivo_longo_prazo" class="label-floatlabel" class="form-label floatlabel-label">Objetivos longo prazo</label>
                                <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" >{{ $interview->objetivo_longo_prazo }}</textarea>
                                @error('objetivo_longo_prazo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pontos_melhoria" class="label-floatlabel" class="form-label floatlabel-label">Pontos de Melhoria</label>
                                <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" >{{ $interview->pontos_melhoria }}</textarea>
                                @error('pontos_melhoria') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="familia" class="label-floatlabel" class="form-label floatlabel-label">Família</label>
                                <textarea class="form-control" id="familia" name="familia" >{{ $interview->familia }}</textarea>
                                @error('familia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="disponibilidade_horario" class="label-floatlabel" class="form-label floatlabel-label">Disponibilidade de Horário</label>
                                <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" >{{ $interview->disponibilidade_horario }}</textarea>
                                @error('disponibilidade_horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sobre_candidato" class="label-floatlabel" class="form-label floatlabel-label">Fale um pouco sobre você</label>
                                <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" >{{ $interview->sobre_candidato }}</textarea>
                                @error('sobre_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="rotina_candidato" class="label-floatlabel" class="form-label floatlabel-label">Qual a sua rotina?</label>
                                <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" >{{ $interview->rotina_candidato }}</textarea>
                                @error('rotina_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="outros_idiomas" class="label-floatlabel" class="form-label floatlabel-label">Outros idiomas?</label>
                                <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" >{{ $interview->outros_idiomas }}</textarea>
                                @error('outros_idiomas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Sua família é atendida no CRAS?</label>
                                <select name="familia_cras" id="familia_cras" class="form-select active-floatlabel" required>
                                    <option value="Sim" {{ $interview->familia_cras === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ $interview->familia_cras === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('familia_cras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="fonte_curriculo" name="fonte_curriculo" placeholder="Fonte de Captação do Currículo" required value="{{ $interview->fonte_curriculo }}">
                            @error('fonte_curriculo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Sugestão Empresa</label>
                                <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" >{{ $interview->sugestao_empresa }}</textarea>
                                @error('sugestao_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="observacoes" class="label-floatlabel" class="form-label floatlabel-label">Observações</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" >{{ $interview->observacoes }}</textarea>
                                @error('observacoes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="pontuacao" name="pontuacao" placeholder="Pontuação" required value="{{ $interview->pontuacao }}">
                            @error('pontuacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4 mt-3 bloco-submit">
                        <button type="submit" class="btn btn-primary btn-padrao btn-cadastrar">Atualizar</button>
                    </div>

                    <div class="col-8"></div>

                </div>

            </form>

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
$('#vacina_covid').select2({
    placeholder: "Selecione",
});
$('#familia_cras').select2({
    placeholder: "Selecione",
});
$('#perfil').select2({
    placeholder: "Selecione",
});
$('#perfil_santa_casa').select2({
    placeholder: "Selecione",
});
$('#classificacao').select2({
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

$("#form-interview").validate({
    ignore: [],
    rules:{
        saude_candidato:"required",
        vacina_covid:"required",
        perfil:"required",
        perfil_santa_casa:"required",
        classificacao:"required",
        qual_formadora:"required",
        familia_cras:"required",
        fonte_curriculo:"required",
        pontuacao:"required",
    }
});

// Validação inicial
var validator1 = $( "#form-companies-create" ).validate();
validator1.form();

var validator2 = $( "#form-interview" ).validate();
validator2.form();

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