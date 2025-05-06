@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Empresas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar: Vaga #{{ $job->id}}</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('jobs.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <div class="row form-padrao">

                <div class="col-8 py-0 pe-5 form-l">

                    <h4 class="fw-normal mb-4">Detalhes da Vaga</h4>

                    <form id="form-jobs" class="form-padrao" action="{{ route('jobs.update', $job) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="mb-3 col-12">
                                <input type="text" name="company_id" id="company_id" class="floatlabel form-control" placeholder="Empresa" value="{{ $job->company->nome_fantasia}}" disabled>
                                @error('company_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            {{--
                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="setor" class="label-floatlabel" class="form-label floatlabel-label">Setor</label>
                                    <select name="setor" id="setor" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="Industria" {{ $job->setor === 'Industria' ? 'selected' : ''}}>Industria</option>
                                        <option value="Varejo" {{ $job->setor === 'Varejo' ? 'selected' : ''}}>Varejo</option>
                                        <option value="Tecnologia" {{ $job->setor === 'Tecnologia' ? 'selected' : ''}}>Tecnologia</option>
                                        <option value="Serviços" {{ $job->setor === 'Serviços' ? 'selected' : ''}}>Serviços</option>
                                    </select>
                                    @error('setor') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            --}}

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="cargo" class="label-floatlabel" class="form-label floatlabel-label">Setor</label>
                                    <select name="cargo" id="cargo" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="Copa & Cozinha" {{ $job->cargo === 'Copa & Cozinha' ? 'selected' : '' }} >Copa & Cozinha</option>
                                        <option value="Administrativo" {{ $job->cargo === 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                                        <option value="Camareiro(a) de Hotel" {{ $job->cargo === 'Camareiro(a) de Hotel' ? 'selected' : '' }}>Camareiro(a) de Hotel</option>
                                        <option value="Recepcionista" {{ $job->cargo === 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                                        <option value="Atendente de Lojas e Mercados (Comércio & Varejo)" {{ $job->cargo === 'Atendente de Lojas e Mercados (Comércio & Varejo)' ? 'selected' : '' }}>Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                                        <option value="Construção e Reparos" {{ $job->cargo === 'Construção e Reparos' ? 'selected' : '' }}>Construção e Reparos</option>
                                        <option value="Conservação e Limpeza" {{ $job->cargo === 'Conservação e Limpeza' ? 'selected' : '' }}>Conservação e Limpeza</option>
                                    </select>
                                    @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="cbo" class="label-floatlabel" class="form-label floatlabel-label">CBO</label>
                                    <select name="cbo" id="cbo" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="4110-10" {{ $job->cbo === '4110-10' ? 'selected' : '' }}>4110-10</option>
                                        <option value="4122-05" {{ $job->cbo === '4122-05' ? 'selected' : '' }}>4122-05</option>
                                        <option value="4221-05" {{ $job->cbo === '4221-05' ? 'selected' : '' }}>4221-05</option>
                                        <option value="5211-40" {{ $job->cbo === '5211-40' ? 'selected' : '' }}>5211-40</option>
                                        <option value="5211-25" {{ $job->cbo === '5211-25' ? 'selected' : '' }}>5211-25</option>
                                        <option value="4211-25" {{ $job->cbo === '4211-25' ? 'selected' : '' }}>4211-25</option>
                                        <option value="5133-15" {{ $job->cbo === '5133-15' ? 'selected' : '' }}>5133-15</option>
                                        <option value="5135-05" {{ $job->cbo === '5135-05' ? 'selected' : '' }}>5135-05</option>
                                        <option value="5134-05" {{ $job->cbo === '5134-05' ? 'selected' : '' }}>5134-05</option>
                                        <option value="5134-15" {{ $job->cbo === '5134-15' ? 'selected' : '' }}>5134-15</option>
                                        <option value="5134-35" {{ $job->cbo === '5134-35' ? 'selected' : '' }}>5134-35</option>
                                        <option value="5134-10" {{ $job->cbo === '5134-10' ? 'selected' : '' }}>5134-10</option>
                                        <option value="5134-40" {{ $job->cbo === '5134-40' ? 'selected' : '' }}>5134-40</option>
                                        <option value="5134-20" {{ $job->cbo === '5134-20' ? 'selected' : '' }}>5134-20</option>
                                        <option value="5134-30" {{ $job->cbo === '5134-30' ? 'selected' : '' }}>5134-30</option>
                                        <option value="5134-25" {{ $job->cbo === '5134-25' ? 'selected' : '' }}>5134-25</option>
                                        <option value="5142-25" {{ $job->cbo === '5142-25' ? 'selected' : '' }}>5142-25</option>
                                        <option value="7156-10" {{ $job->cbo === '7156-10' ? 'selected' : '' }}>7156-10</option>
                                        <option value="7166-10" {{ $job->cbo === '7166-10' ? 'selected' : '' }}>7166-10</option>
                                        <option value="7164-05" {{ $job->cbo === '7164-05' ? 'selected' : '' }}>7164-05</option>
                                        <option value="5143-25" {{ $job->cbo === '5143-25' ? 'selected' : '' }}>5143-25</option>
                                    </select>
                                    @error('cbo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-12">
                                <div class="floatlabel-wrapper form-textarea">
                                    <label for="descricao" class="label-floatlabel" class="form-label floatlabel-label">Atividades esperadas</label>
                                    <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{ $job->descricao }}</textarea>
                                    @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="genero" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                    <select name="genero" id="genero" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="Masculino" {{ $job->genero === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Feminino" {{ $job->genero === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                        <option value="Indiferente" {{ $job->genero === 'Indiferente' ? 'selected' : '' }}>Indiferente</option>
                                    </select>
                                    @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="number" placeholder="Quantidade de vagas" class="floatlabel form-control" id="qtd_vagas" name="qtd_vagas" required value="{{ $job->qtd_vagas }}">
                                @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-4">
                                <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required value="{{ $job->cidade }}">
                                @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-2">
                                <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required value="{{ $job->uf }}">
                                @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="text" placeholder="Salário" class="floatlabel form-control" id="salario" name="salario" required value="{{ $job->salario_formatted }}">
                                @error('salario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="text" placeholder="Dias da Semana" class="floatlabel form-control" id="dias_semana" name="dias_semana" required placeholder="Seg. à Sáb." value="{{ $job->dias_semana}}">
                                @error('dias_semana') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="text" placeholder="Horário" class="floatlabel form-control" id="horario" name="horario" required value="{{ $job->horario }}">
                                @error('horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="text" placeholder="Dia, Hora e Modalidade do Curso" class="floatlabel form-control" id="dias_curso" name="dias_curso" required value="{{ $job->dias_curso}}">
                                @error('dias_curso') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <input type="text" placeholder="Benefícios" class="floatlabel form-control" id="exp_profissional" name="exp_profissional" required value="{{ $job->exp_profissional }}">
                                @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 col-12">
                                <div class="floatlabel-wrapper form-textarea">
                                    <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Requisitos/Diferenciais</label>
                                    <textarea class="form-control active-floatlabel" id="beneficios" name="beneficios" required>{{ $job->beneficios }}</textarea>
                                    @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="informatica" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em informática?</label>
                                    <select name="informatica" id="informatica" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="Não" {{ $job->informatica === 'Não' ? 'selected' : '' }}>Não</option>
                                        <option value="Básico" {{ $job->informatica === 'Básico' ? 'selected' : '' }}>Básico</option>
                                        <option value="Intermediário" {{ $job->informatica === 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                        <option value="Avançado" {{ $job->informatica === 'Avançado' ? 'selected' : '' }}>Avançado</option>
                                    </select>
                                    @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="ingles" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em inglês?</label>
                                    <select name="ingles" id="ingles" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="Não" {{ $job->ingles === 'Não' ? 'selected' : '' }}>Não</option>
                                        <option value="Básico" {{ $job->ingles === 'Básico' ? 'selected' : '' }}>Básico</option>
                                        <option value="Intermediário" {{ $job->ingles === 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                        <option value="Avançado" {{ $job->ingles === 'Avançado' ? 'selected' : '' }}>Avançado</option>
                                    </select>
                                    @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                        </div>

                        <div class="col-12 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="{{ route('jobs.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </form>

                </div>

                <div class="col-4 border-start py-0 ps-5 form-r bloco-obs">

                    <h4>Contratação</h4>

                    <div class="row d-flex">

                        <div class="col bloco-data-contratacao">
                            @if (!$job->data_inicio_contratacao)
                                <form action="{{ route('jobs.startContraction', $job) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="data_inicio_contratacao" id="data_inicio_contratacao" value="start">
                                    <button type="submit" class="btn btn-secondary btn-iniciar btn-sm">Iniciar</button>
                                </form>

                            @else
                                <button class="btn btn-success btn-sm">Início: {{ $job->data_inicio_contratacao->format('d/m/Y')   }}</button>

                            @endif

                            @if (!$job->data_fim_contratacao)
                                <form action="{{ route('jobs.endContraction', $job) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="data_fim_contratacao" id="data_fim_contratacao" value="end">
                                    <button type="submit" class="btn btn-secondary btn-finalizar btn-sm">Finalizar</button>
                                </form>

                            @else
                                <button class="btn btn-danger btn-sm">Fim: {{ $job->data_fim_contratacao->format('d/m/Y')   }}</button>
                            @endif

                        </div>

                    </div>

                    <h4 class="fw-normal">Observações:</h4>

                    <div class="row">

                        <form class="form-padrao" action="{{ route('jobs.updateStatus', $job->id) }}" method="post">

                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="floatlabel-wrapper required">
                                    <label for="status" class="label-floatlabel" class="form-label floatlabel-label">Status</label>
                                    <select name="status" id="status" class="form-select active-floatlabel" onchange="this.form.submit()">
                                        <option value="aberta" {{ $job->status == 'aberta'? 'selected' : '' }} >Aberta</option>
                                        <option value="fechada" {{ $job->status == 'fechada'? 'selected' : '' }} >Fechada</option>
                                        <option value="espera" {{ $job->status == 'espera'? 'selected' : '' }} >Espera</option>
                                        <option value="cancelada" {{ $job->status == 'cancelada'? 'selected' : '' }} >Cancelada</option>
                                    </select>
                                </div>
                            </div>

                        </form>


                        @if (Auth::user()->role == 'admin')
                            <form class="form-padrao" action="{{ route('jobs.associateRecruiter', $job->id) }}" method="POST">

                                @csrf
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="recruiters" class="label-floatlabel" class="form-label floatlabel-label" style="padding-top: 8px !important">Recrutadores</label>
                                        <select name="recruiters[]" id="recruiters" class="form-select select-recrutadores" multiple onchange="this.form.submit()">
                                            @foreach ($recruiters as $recruiter)
                                                <option value="{{ $recruiter->id }}" {{ $job->recruiters->contains($recruiter->id) ? 'selected' : '' }}>
                                                    &bull; {{ $recruiter->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </form>

                        @endif

                    </div>

                    <div class="row mb-3 mt-3 bloco-observacoes">

                        <div class="card">
                            <div class="card-header bg-transparent">
                            <p>Observações:</p>
                            </div>
                            <div class="card-body">
                                @if ($job->observacoes->isNotEmpty())
                                    @foreach ($job->observacoes->sortByDesc('created_at') as $observacao )
                                        <p class="card-text"><b>{{$observacao->created_at->format('d/m/y')}}</b> - {{$observacao->observacao}} </p>
                                    @endforeach
                                @else
                                    Nenhuma observação.
                                @endif

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <form class="form-padrao d-flex justify-content-center" action="{{ route('jobs.storeHistory', $job->id)}}" method="post">

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

    <!-- Currículos Associados a esta Vaga-->
    <article class="f1">

        <div class="container">

            <div class="row">

                <div class="col-12 d-flex justify-content-between">

                    <h4>Currículos associados a esta vaga</h4>

                    <!-- Button trigger modal Associar um currículo a esta vaga -->
                    <button type="button" class="btn-padrao btn-associar-vaga" data-bs-toggle="modal" data-bs-target="#associarCurriculoModal">
                        Associar currículo
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="associarCurriculoModal" tabindex="-1" aria-labelledby="associarCurriculoModal" aria-hidden="true">

                       <div class="modal-dialog modal-dialog-centered modal-xl">

                           <div class="modal-content">

                               <div class="modal-header">
                                   <h5 class="modal-title" id="associarCurriculoModal">Currículos Ativos</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>

                               <div class="modal-body">

                                   <table class="table">

                                       <thead>
                                           <tr>
                                               <th>Nome</th>
                                               <th>Tipo de Vaga</th>
                                               <th>CNH</th>
                                               <th>Informática</th>
                                               <th>Inglês</th>
                                               <th>Ações</th>
                                           </tr>
                                       </thead>

                                       <tbody>

                                           @if ($curriculosAtivos->count() > 0)
                                               @foreach ($curriculosAtivos as $curriculo)

                                                   <tr>
                                                       <td>{{ $curriculo->informacoesPessoais->nome }}</td>
                                                       <td class="coluna-tipo-vaga">
                                                           @foreach ($curriculo->vagas_interesse as $vaga)
                                                               {{$vaga}},
                                                           @endforeach
                                                       </td>
                                                       <td>{{ $curriculo->informacoesPessoais->cnh }}</td>
                                                       <td>{{ $curriculo->escolaridade->informatica }}</td>
                                                       <td>{{ $curriculo->escolaridade->ingles }}</td>
                                                       <td>
                                                           {{-- Verifica se curriculo já está associado a vaga --}}
                                                           @if ($curriculo->jobs->contains($job->id))
                                                               <button disabled="disabled" class="btn btn-primagy btn-sm d-inline">Associado</button>

                                                           @else
                                                               <form action="{{ route('interviews.associarVaga') }}" method="POST" style="display:inline;">
                                                                   @csrf
                                                                   <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                                   <input type="hidden" name="resume_id" value="{{ $curriculo->id }}">
                                                                   <button type="submit" class="btn btn-success btn-sm">Associar</button>
                                                               </form>

                                                           @endif

                                                       </td>
                                                   </tr>
                                               @endforeach
                                           @else
                                               <tr><p>Nenhuma vaga encontrada</p></tr>
                                           @endif
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>


                </div>

                <div class="table-container lista-curriculos-associados">

                    <ul class="tit-lista">
                        <li class="col1">Nome</li>
                        <li class="col2">Tipo de vaga</li>
                        <li class="col3">Entrevistado</li>
                        <li class="col4">Status</li>
                    </ul>

                    @if ($job->resumes()->count() > 0)

                        @foreach ($job->resumes as $resume)
                        <ul onclick="window.location='{{ route('resumes.edit', $resume) }}'" >
                            <li class="col1">
                                <b>Nome</b>
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <span>
                                    <strong>{{ $resume->informacoesPessoais->nome }}</strong>
                                </span>
                            </li>
                            <li class="col2">
                                <b>Tipo de Vaga</b>
                                @foreach ($resume->vagas_interesse as $vaga)
                                    {{$vaga}},
                                @endforeach
                            </li>
                            <li class="col3">
                                <b>Entrevista</b>
                                @if ($resume->interview)
                                    <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                                @else
                                    <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                                @endif
                            </li>
                            <li class="col4">
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

                        </ul>
                        @endforeach

                    @else
                    <span class="sem-resultado">Nenhum currículo associado a esta vaga</span>
                    @endif

                </div>

            </div>

        </div>

        <div class="table-container mt-5">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de vaga</th>
                        <th>Entrevistado</th>
                        <th>Obs.:</th>
                        <th class="icone-status">#</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($job->resumes()->count() > 0)
                        @foreach ($job->resumes as $resume)
                        <tr style="cursor: pointer" onclick="window.location='{{ route('resumes.edit', $resume) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Currículo">
                                <td class="ico-v">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                    {{ $resume->informacoesPessoais->nome }}</td>
                                <td>
                                    @foreach ($resume->vagas_interesse as $vaga)
                                        {{$vaga}},
                                    @endforeach
                                </td>
                                <td>
                                    @if ($resume->interview)
                                        <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                                    @else
                                        <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                                    @endif



                                </td>
                                <td>
                                    Não
                                </td>
                                <td class="svg-status">
                                    @switch($resume->status)
                                        @case('inativo')
                                            <svg
                                                style="enable-background:new 0 0 16 16; fill: red;"
                                                version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                                <circle cx="8" cy="8" r="8"></circle>
                                            </svg>
                                            <span>Inativo</span>
                                            @break

                                        @case('em processo')
                                            <svg
                                                style="enable-background:new 0 0 16 16; fill: yellow;"
                                                version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                                <circle cx="8" cy="8" r="8"></circle>
                                            </svg> Em processo
                                            @break
                                        @case('efetivado')
                                            <svg
                                                style="enable-background:new 0 0 16 16; fill: green;"
                                                version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                                <circle cx="8" cy="8" r="8"></circle>
                                            </svg> Em processo
                                            @break


                                        @default
                                            <svg
                                                style="enable-background:new 0 0 16 16; fill: gray;"
                                                version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                                <circle cx="8" cy="8" r="8"></circle>
                                            </svg> <span>Ativo </span>
                                    @endswitch
                                </td>


                            </tr>
                        @endforeach
                    @else
                        <tr><p>Nenhum Associado a esta vaga!</p></tr>
                    @endif
                </tbody>
            </table>

        </div>
    </article>

    <!-- Processos seletivos a esta Vaga-->

    <article class="f1">

        <h4>Processos Seletivos para esta vaga</h4>


        <div class="table-container">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Candidato</th>
                        <th>Tipo de vaga</th>
                        <th>Status da Seleção</th>
                        <th>Avaliação</th>
                        <th>Obs.:</th>
                        <th>Status da Contratação</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($job->selections()->count() > 0)
                        @foreach ($job->selections as $selecao)
                            <tr style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#modal-selecao-{{$selecao->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                                <td class="ico-v">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                    {{ $selecao->resume->informacoesPessoais->nome }}</td>
                                <td>
                                    @foreach ($selecao->resume->vagas_interesse as $vaga)
                                        {{$vaga}},
                                    @endforeach
                                </td>
                                <td>{{ $selecao->status_selecao == 'aprovado' ? 'Contratado' : $selecao->status_selecao }} </td>

                                <td>{{ $selecao->avaliacao == 1 ? 'Positiva' : 'Negativa'}}  </td>
                                <td>{{ $selecao->observacao}}</td>
                                <td>{{ $selecao->status_contratacao }} </td>


                            </tr>
                             <!-- Modal -->
                             <div class="modal fade" id="modal-selecao-{{$selecao->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Vaga - Nº {{ $job->id}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card" style="width: 18rem;">
                                                    <h5 class="card-title">Processo Seletivo</h5>



                                                    <div class="card-body">

                                                        <form action="{{ route('selections.updateSelection', $selecao->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                    <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                        <option value="aprovado" {{ $selecao->status_selecao == 'aprovado' ? 'selected' : '' }} > Contratado</option>
                                                                        <option value="reprovado" {{ $selecao->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                        <option value="aguardando" {{ $selecao->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                    </select>
                                                                    @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                    <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                        <option value="0" {{$selecao->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                        <option value="1" {{ $selecao->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                    </select>
                                                                    @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-12">
                                                                <div class="floatlabel-wrapper form-textarea">
                                                                    <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selecao->observacao }}</textarea>
                                                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit" {{ $selecao->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button>
                                                            {{-- <button class="btn btn-primary" type="submit">Atualizar</button> --}}

                                                        </form>


                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>

                                </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr><p>Nenhum processo seletivo para esta vaga!</p></tr>
                    @endif
                </tbody>
            </table>

        </div>
    </article>

</section>
@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
$('#salario').mask('#.##0,00', {reverse: true});
/*
$('#setor').select2({
    placeholder: "Selecione um setor",
});
*/

$('#cargo').select2({
    placeholder: "Selecione",
});
$('#genero').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});

$("#form-jobs").validate({
    ignore: [],
    rules:{
        company_id:"required",
        //setor:"required",
        cargo:"required",
        genero:"required",
        qtd_vagas:"required",
        cidade:"required",
        uf:"required",
        salario:"required",
        dias_semana:"required",
        horario:"required",
        dias_curso:"required",
        exp_profissional:"required",
        beneficios:"required",
        informatica:"required",
        ingles:"required",
    }
});

// Validação inicial
var validator = $( "#form-jobs" ).validate();
validator.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

});
</script>
@endpush

@push('css-custom')
<style>
article.container-form-create{
    box-shadow: none;
    padding: 0;
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
.btn-iniciar{
    background: #0056b3;
}
.btn-iniciar:hover{
    background: #046dde;
}
.btn-finalizar{
    background: #008000;
}
.btn-finalizar:hover{
    background: #02a302;
}

label{
    font-size: 10px;
    font-weight: 600;
    color: #aaa;
}

/*.sessao p, */
#observacao::placeholder{
    font-weight: 500;
    font-size: 11px;
    color: #aaa;
}

.coluna-tipo-vaga{
    width: 250px !important;
}


</style>
@endpush