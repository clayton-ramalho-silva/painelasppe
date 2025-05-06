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

            <div class="row">

                <div class="col-8 py-0 pe-5">

                    <h4 class="fw-normal mb-4">Detalhes da Vaga:</h4>

                    <form id="form-jobs" class="form-padrao" action="{{ route('jobs.update', $job) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="company_id" class="form-label">Empresa</label>
                                <input type="text" name="company_id" id="company_id" class="form-control" placeholder="{{ $job->company->nome_fantasia}}" disabled>
                                @error('company_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="setor" class="form-label">Setor</label>
                                <select name="setor" id="setor" class="form-select" required>
                                    <option value="Industria" {{ $job->setor === 'Industria' ? 'selected' : ''}}>Industria</option>
                                    <option value="Varejo" {{ $job->setor === 'Varejo' ? 'selected' : ''}}>Varejo</option>
                                    <option value="Tecnologia" {{ $job->setor === 'Tecnologia' ? 'selected' : ''}}>Tecnologia</option>
                                    <option value="Serviços" {{ $job->setor === 'Serviços' ? 'selected' : ''}}>Serviços</option>
                                </select>
                                @error('setor') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="cargo" class="form-label">Cargo</label>
                                <select name="cargo" id="cargo" class="form-select" required>
                                    <option disabled selected>Escolha Cargo</option>
                                    <option value="Copa & Cozinha" {{ $job->cargo === 'Copa & Cozinha' ? 'selected' : '' }} >Copa & Cozinha</option>
                                    <option value="Administrativo" {{ $job->cargo === 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                                    <option value="Camareiro(a) de Hotel" {{ $job->cargo === 'Camareiro(a) de Hotel' ? 'selected' : '' }}>Camareiro(a) de Hotel</option>
                                    <option value="Recepcionista" {{ $job->cargo === 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                                    <option value="Atendente de Lojas e Mercados (Comércio & Varejo)" {{ $job->cargo === 'Atendente de Lojas e Mercados (Comércio & Varejo)' ? 'selected' : '' }}>Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                                    <option value="Construção e Reparos" {{ $job->cargo === 'Construção e Reparos' ? 'selected' : '' }}>Construção e Reparos</option>
                                </select>
                                @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="cbo" class="form-label">CBO</label>
                                <input type="text" name="cbo" id="cbo" class="form-control" value="{{ $job->cbo }}">
                                @error('cbo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <label for="descricao" class="form-label">Atividades esperadas</label>
                                <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{ $job->descricao }}</textarea>
                                @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="genero" class="form-label">Gênero</label>
                                <select name="genero" id="genero" class="form-select" required>
                                    <option value="Masculino" {{ $job->genero === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Feminino" {{ $job->genero === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Indiferente" {{ $job->genero === 'Indiferente' ? 'selected' : '' }}>Indiferente</option>
                                </select>
                                @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="qtd_vagas" class="form-label">Quantidade de vagas</label>
                                <input type="number" class="form-control" id="qtd_vagas" name="qtd_vagas" required value="{{ $job->qtd_vagas }}">
                                @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required value="{{ $job->cidade }}">
                                @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-2">
                                <label for="uf" class="form-label">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" required value="{{ $job->uf }}">
                                @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="salario" class="form-label">Salário</label>
                                <input type="text" class="form-control" id="salario" name="salario" required value="{{ $job->salario_formatted }}">
                                @error('salario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="dias_semana" class="form-label">Dias de Semana</label>
                                <input type="text" class="form-control" id="dias_semana" name="dias_semana" required placeholder="Seg. à Sáb." value="{{ $job->dias_semana}}">
                                @error('dias_semana') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="horario" class="form-label">Horário</label>
                                <input type="text" class="form-control" id="horario" name="horario" required value="{{ $job->horario }}">
                                @error('horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="dias_curso" class="form-label">Dias de Curso</label>
                                <input type="text" class="form-control" id="dias_curso" name="dias_curso" required value="{{ $job->dias_curso}}">
                                @error('dias_curso') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="exp_profissional" class="form-label">Experiência Profissional</label>
                                <input type="text" class="form-control" id="exp_profissional" name="exp_profissional" required value="{{ $job->exp_profissional }}">
                                @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <label for="beneficios" class="form-label">Benefícios</label>
                                <textarea class="form-control" id="beneficios" name="beneficios" required>{{ $job->beneficios }}</textarea>
                                @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="informatica" class="form-label">Conhecimento em informática?</label>
                                <select name="informatica" id="informatica" class="form-select" required>
                                    <option value="Não" {{ $job->informatica === 'Não' ? 'selected' : '' }}>Não</option>
                                    <option value="Básico" {{ $job->informatica === 'Básico' ? 'selected' : '' }}>Básico</option>
                                    <option value="Intermediário" {{ $job->informatica === 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                    <option value="Avançado" {{ $job->informatica === 'Avançado' ? 'selected' : '' }}>Avançado</option>
                                </select>
                                @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="ingles" class="form-label">Conhecimento em inglês?</label>
                                <select name="ingles" id="ingles" class="form-select" required>
                                    <option disabled selected>Escolher</option>
                                    <option value="Não" {{ $job->ingles === 'Não' ? 'selected' : '' }}>Não</option>
                                    <option value="Básico" {{ $job->ingles === 'Básico' ? 'selected' : '' }}>Básico</option>
                                    <option value="Intermediário" {{ $job->ingles === 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                    <option value="Avançado" {{ $job->ingles === 'Avançado' ? 'selected' : '' }}>Avançado</option>
                                </select>
                                @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>


                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="{{ route('jobs.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </form>

                </div>

                <div class="col-4 border-start py-0 ps-5">
                    <h4 class="fw-normal mb-4">Observações:</h4>
                    <div class="row">
                        <form action="{{ route('jobs.updateStatus', $job->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required onchange="this.form.submit()">
                                    <option value="aberta" {{ $job->status == 'aberta'? 'selected' : '' }} >Aberta</option>
                                    <option value="fechada" {{ $job->status == 'fechada'? 'selected' : '' }} >Fechada</option>
                                    <option value="espera" {{ $job->status == 'espera'? 'selected' : '' }} >Espera</option>
                                    <option value="cancelada" {{ $job->status == 'cancelada'? 'selected' : '' }} >Cancelada</option>
                                </select>
                            </div>
                        </form>

                        <form action="{{ route('jobs.associateRecruiter', $job->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recruiters" class="form-label">Recrutadores</label>
                                <select name="recruiters[]" id="recruiters" class="form-select" multiple onchange="this.form.submit()">
                                    @foreach ($recruiters as $recruiter)
                                        <option value="{{ $recruiter->id }}" {{ $job->recruiters->contains($recruiter->id) ? 'selected' : '' }}>
                                            {{ $recruiter->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </form>
                    </div>

                    <div class="row mb-3 mt-3">
                        <div class="card">
                            <div class="card-header bg-transparent">
                            <p>Observações:</p>
                            </div>
                            <div class="card-body">
                                @if ($job->observacoes->isNotEmpty())
                                    @foreach ($job->observacoes->sortByDesc('created_at') as $observacao )
                                        <p class="card-text mb-2">{{$observacao->created_at->format('d/m/y')}} - {{$observacao->observacao}} </p>
                                    @endforeach
                                @else
                                    Nenhuma observação.
                                @endif

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <form action="{{ route('jobs.storeHistory', $job->id)}}" method="post">
                            @csrf
                            <textarea name="observacao" id="observacao" class="form-control" placeholder="Escreva sua observação"></textarea>
                            <button class="btn-padrao btn-cadastrar mt-3" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>


            </div>






        </div>
    </article>

</section>
@endsection

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

label{
    font-size: 10px;
    font-weight: 600;
    color: #aaa;
}

.sessao p,
#observacao::placeholder{
    font-weight: 500;
    font-size: 11px;
    color: #aaa;
}

</style>
@endpush