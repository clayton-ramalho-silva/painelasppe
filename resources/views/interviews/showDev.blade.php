@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Entrevista</a>ShowDev</li>
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

    <article class="f1">

        <div class="container">

            <div class="row mb-3 mt-3">
                <div class="col-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Associar a uma vaga
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vagas abertas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Empresa</th>
                                                    <th>Título</th>
                                                    <th>Quantidade</th>
                                                    <th>Cidade</th>
                                                    <th>Vagas Preenchidas</th>
                                                    <th>Candidatos Selecionados</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($jobs->count() > 0)
                                                    @foreach ($jobs as $job)

                                                        <tr>
                                                            <td>{{ $job->company->nome_fantasia }}</td>
                                                            <td>{{ $job->cargo }}</td>
                                                            <td>{{ $job->qtd_vagas }}</td>
                                                            <td>{{ $job->cidade }}</td>
                                                            <td>{{ $job->filled_positions }}</td>
                                                            <td>@if ($job->resumes->count() > 0)
                                                                {{$job->resumes->count()}} candidatos
                                                            @else
                                                                Nenhum candidato selecionado
                                                            @endif</td>
                                                            <td>
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
                </div>

            </div>

            <form action="{{ route('resumes.update', $resume) }}" class="form-padrao" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Nome Completo" id="nome" name="nome" required value="{{ $resume->informacoesPessoais->nome }}">
                            @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="{{ $resume->informacoesPessoais->data_nascimento }}" required >
                                @error('data_nascimento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" required>
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

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                                <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" required>
                                    <option value="Sim" {{ $resume->informacoesPessoais->possui_filhos === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ $resume->informacoesPessoais->possui_filhos === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('possui_filhos') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                <select name="sexo" id="sexo" class="form-select active-floatlabel" required>
                                    <option value="Homem" {{ $resume->informacoesPessoais->sexo === 'Homem' ? 'selected' : '' }}> Homem</option>
                                    <option value="Mulher" {{ $resume->informacoesPessoais->sexo === 'Mulher' ? 'selected' : '' }}> Mulher</option>
                                    <option value="Prefiro não dizer" {{ $resume->informacoesPessoais->sexo === 'Prefiro não dizer' ? 'selected' : '' }} > Prefiro não dizer</option>
                                </select>
                                @error('sexo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <p>Tem Reservista?</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim" {{ $resume->informacoesPessoais->reservista === 'Sim' ? 'checked' : ''}}>
                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                <label class="form-check-label" for="reservista1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não" {{ $resume->informacoesPessoais->reservista === 'Não' ? 'checked' : ''}}>
                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                <label class="form-check-label" for="reservista2">
                                Não
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento" {{ $resume->informacoesPessoais->reservista === 'Em andamento' ? 'checked' : ''}}>
                                @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                <label class="form-check-label" for="reservista2">
                                Em andamento
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="RG" id="rg" name="rg" required value="{{ $resume->informacoesPessoais->rg }}">
                            @error('rg') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="CPF" id="cpf" name="cpf" required value="{{ $resume->informacoesPessoais->cpf }}">
                            @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Rua" id="logradouro" name="logradouro" required value="{{ $resume->contato->logradouro }}">
                            @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Número" id="numero" name="numero" required value="{{ $resume->contato->numero }}">
                            @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Complemento" id="complemento" name="complemento" value="{{ $resume->contato->complemento }}">
                            @error('complemento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Bairro" id="bairro" name="bairro" required value="{{ $resume->contato->bairro }}">
                            @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Cidade" id="cidade" name="cidade" required value="{{ $resume->contato->cidade }}">
                            @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="UF" id="uf" name="uf" required value="{{ $resume->contato->uf }}">
                            @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="CEP" id="cep" name="cep" required value="{{ $resume->contato->cep }}">
                            @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="email" class="form-control floatlabel" placeholder="E-mail" id="email" name="email" required value="{{ $resume->contato->email }}">
                            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Telefone Celular" id="telefone_celular" name="telefone_celular" required value="{{ $resume->contato->telefone_celular }}">
                            @error('telefone_celular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Telefone de Contato" id="telefone_residencial" name="telefone_residencial" value="{{ $resume->contato->telefone_residencial }}">
                            @error('telefone_residencial') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Nome de Contato" id="nome_contato" name="nome_contato" value="{{ $resume->contato->nome_contato }}">
                            @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                    <option value="Sim" {{ $resume->informacoesPessoais->cnh === 'Sim' ? 'selected' : '' }}> Sim</option>
                                    <option value="Não" {{ $resume->informacoesPessoais->cnh === 'Não' ? 'selected' : '' }}> Não</option>
                                    <option value="Em andamento" {{ $resume->informacoesPessoais->cnh === 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                                </select>
                                @error('cnh') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram" value="{{ $resume->informacoesPessoais->instagram }}">
                            @error('instagram') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin" value="{{ $resume->informacoesPessoais->linkedin }}">
                            @error('linkedin') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Copa & Cozinha" name="vagas_interesse[]" @checked(in_array('Copa & Cozinha', $resume->vagas_interesse ?? [])) >
                                <label class="form-check-label" for="vagas_interesse">
                                    Copa & Cozinha
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Administrativo" name="vagas_interesse[]" @checked(in_array('Administrativo', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse">
                                    Administrativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Camareiro(a) de Hotel" name="vagas_interesse[]" @checked(in_array('Camareiro(a) de Hotel', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse">
                                    Camareiro(a) de Hotel
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Recepcionista" name="vagas_interesse[]" @checked(in_array('Recepcionista', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse">
                                    Recepcionista
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]" @checked(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse">
                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Construção e Reparos" name="vagas_interesse[]" @checked(in_array('Construção e Reparos', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse">
                                    Construção e Reparos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]" @checked(in_array('Conservação e Limpeza', $resume->vagas_interesse ?? []))>
                                <label class="form-check-label" for="vagas_interesse7">
                                    Conservação e Limpeza
                                </label>
                            </div>
                            @error('vagas_interesse') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Nenhuma por enquanto" name="experiencia_profissional[]" @checked(in_array('Nenhuma por enquanto', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Nenhuma por enquanto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Copa & Cozinha" name="experiencia_profissional[]" @checked(in_array('Copa & Cozinha', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Copa & Cozinha
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Administrativo" name="experiencia_profissional[]" @checked(in_array('Administrativo', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Administrativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Camareiro(a) de Hotel" name="experiencia_profissional[]" @checked(in_array('Camareiro(a) de Hotel', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Camareiro(a) de Hotel
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Recepcionista" name="experiencia_profissional[]" @checked(in_array('Recepcionista', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Recepcionista
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]" @checked(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]" @checked(in_array('TI (Tecnologia da Informação)', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    TI (Tecnologia da Informação)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Construção e Reparos" name="experiencia_profissional[]" @checked(in_array('Construção e Reparos', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
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
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Outro" name="experiencia_profissional[]" @checked(in_array('Outro', $resume->experiencia_profissional ?? []))>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Outro:
                                </label>
                            </div>
                            @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_celular" class="form-label">Formação/Escolaridade*
                                (Especifique no campo "OUTRO" caso tenha Ensino Superior, Técnico ou outro)</label>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade1" value="Ensino Médio Incompleto" {{ $resume->escolaridade->escolaridade === 'Ensino Médio Incompleto' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="escolaridade1">
                                        Ensino Médio Incompleto
                                    </label>
                                </div>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade2" value="Ensino Médio Completo" {{ $resume->escolaridade->escolaridade === 'Ensino Médio Completo' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="escolaridade2">
                                        Ensino Médio Completo
                                    </label>
                                </div>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade3" value="Outro" {{ $resume->escolaridade->escolaridade === 'Outro' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="escolaridade3">
                                    Outro
                                    </label>
                                </div>
                                @error('escolaridade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Esconder coluna "Já participou de uma seleção nossa?  - Depois deletar
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_celular" class="form-label">Já participou de alguma seleção nossa?</label>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao1" value="Sim, já fui chamado(a) para 1ª fase de um Processo Seletivo." {{ $resume->participou_selecao === 'Sim, já fui chamado(a) para 1ª fase de um Processo Seletivo.' ? 'checked' : ''}}>
                                <label class="form-check-label" for="participou_selecao1">
                                    Sim, já fui chamado(a) para 1ª fase de um Processo Seletivo.
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao2" value="Sim, já fui encaminhado(a) para teste na Empresa parceira." {{ $resume->participou_selecao === 'Sim, já fui encaminhado(a) para teste na Empresa parceira.' ? 'checked' : ''}}>
                                <label class="form-check-label" for="participou_selecao2">
                                    Sim, já fui encaminhado(a) para teste na Empresa parceira.
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Enviei currículo mas não fui chamado(a)." {{ $resume->participou_selecao === 'Enviei currículo mas não fui chamado(a).' ? 'checked' : ''}}>
                                <label class="form-check-label" for="participou_selecao3">
                                    Enviei currículo mas não fui chamado(a).
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Não participei ainda." {{ $resume->participou_selecao === 'Não participei ainda.' ? 'checked' : ''}}>
                                <label class="form-check-label" for="participou_selecao3">
                                    Não participei ainda.
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Outro" {{ $resume->participou_selecao === 'Outro' ? 'checked' : ''}}>
                                <label class="form-check-label" for="participou_selecao3">
                                    Outro
                                </label>
                            </div>
                            @error('participou_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    --}}

                    <div class="col-4">
                        <div class="mb-3">
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
                                <label class="form-check-label" for="participou_selecao3">
                                    Não
                                </label>
                            </div>
                            @error('foi_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="informatica" class="form-label">Possui conhecimento de Informática?</label>
                            <select name="informatica" id="informatica" class="form-select" required>
                                <option value="Básico" {{$resume->escolaridade->informatica === 'Básico' ? 'selected' : ' '}}> Básico</option>
                                <option value="Intermediário" {{$resume->escolaridade->informatica === 'Intermediário' ? 'selected' : ' '}}> Intermediário</option>
                                <option value="Avançado" {{$resume->escolaridade->informatica === 'Avançado' ? 'selected' : ' '}}> Avançado</option>
                                <option value="Nenhum" {{$resume->escolaridade->informatica === 'Nenhum' ? 'selected' : ' '}}> Nenhum</option>
                            </select>
                            @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="ingles" class="form-label">Possui conhecimento de Inglês?</label>
                            <select name="ingles" id="ingles" class="form-select" required>
                                <option value="Básico" {{ $resume->escolaridade->ingles === 'Básico' ? 'selected' : '' }}> Básico</option>
                                <option value="Intermediário" {{ $resume->escolaridade->ingles === 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                                <option value="Avançado" {{ $resume->escolaridade->ingles === 'Avançado' ? 'selected' : '' }}> Avançado</option>
                                <option value="Nenhum" {{ $resume->escolaridade->ingles === 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                            </select>
                            @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>
                            <select name="tamanho_uniforme" id="tamanho_uniforme" class="form-select" required>
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

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="curriculo_doc" class="form-label">Envie seu currículo</label>

                            @php
                                $curriculo = $resume->curriculo_doc;
                                $curriculoPath = $curriculo ? asset("documents/resumes/curriculos/{$curriculo}") : "https://github.com/mdo.png";
                            @endphp
                            <a href="{{ $curriculoPath }}" target="_blank" > Curriculo atual </a>
                            <input type="file" class="form-control" id="curriculo_doc" name="curriculo_doc" value="{{ $resume->curriculo_doc }}">
                            @error('curriculo_doc') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                <div class="row bg-light p-3 mb-2">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Salvar Alterações no Currículo</button>

                    </div>
                </div>

            </form>
        </div>
            </article>
        </section>
        <section class="sessao mt-5">

            <article class="f1">

        <div class="container">
            <div class="row mb-3 mt-3">
                <div class="col-4">
                    <h4>Entrevista</h4>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Data Entrevista: {{ $interview->created_at->format('d/m/Y') }}</p>

                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Hora Entrevista: {{ $interview->created_at->format('H:i:s') }}</p>

                    </div>
                </div>
            </div>

            <form action="{{ route('interviews.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                <div class="row mb-3 mt-3">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="saude_candidato" class="form-label">Saúde do Candidato:</label>
                            <input type="text" class="form-control" id="saude_candidato" name="saude_candidato" required value="{{ $interview->saude_candidato }}">
                            @error('saude_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="vacina_covid" class="form-label">Vacina COVID:</label>
                            <input type="text" class="form-control" id="vacina_covid" name="vacina_covid" required value="{{ $interview->vacina_covid }}">
                            @error('vacina_covid') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil" class="form-label">Perfil:</label>
                            <input type="text" class="form-control" id="perfil" name="perfil" required value="{{ $interview->perfil }}">
                            @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil_santa_casa" class="form-label">Perfil Santa Casa:</label>
                            <input type="text" class="form-control" id="perfil_santa_casa" name="perfil_santa_casa" required value="{{ $interview->perfil_santa_casa }}">
                            @error('perfil_santa_casa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="classificacao" class="form-label">Classificação:</label>
                            <input type="text" class="form-control" id="classificacao" name="classificacao" required value="{{ $interview->classificacao }}">
                            @error('classificacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_formadora" class="form-label">Qual a formadora?(Caso já tenha sido jovem aprendiz.)</label>
                            <input type="text" class="form-control" id="qual_formadora" name="qual_formadora" required value="{{ $interview->qual_formadora }}">
                            @error('qual_formadora') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="parecer_recrutador" class="form-label">Parecer do Entrevistador:</label>
                            <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador" >{{ $interview->parecer_recrutador }}</textarea>
                            @error('parecer_recrutador') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="curso_extracurricular" class="form-label">Cursos Extracurriculares:</label>
                            <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" >{{ $interview->curso_extracurricular }}</textarea>
                            @error('curso_extracurricular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="apresentacao_pessoal" class="form-label">Apresentação Pessoal:</label>
                            <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" >{{ $interview->apresentacao_pessoal }}</textarea>
                            @error('apresentacao_pessoal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="experiencia_profissional" class="form-label">Experiência Profissional (Tempo de Empresa/Motivo da Saída):</label>
                            <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" >{{ $interview->experiencia_profissional }}</textarea>
                            @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="caracteristicas_positivas" class="form-label">Características Positivas:</label>
                            <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" >{{ $interview->caracteristicas_positivas }}</textarea>
                            @error('caracteristicas_positivas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="habilidades" class="form-label">Habilidades:</label>
                            <textarea class="form-control" id="habilidades" name="habilidades" >{{ $interview->habilidades }}</textarea>
                            @error('habilidades') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="porque_ser_jovem_aprendiz" class="form-label">Porque gostaria de ser Jovem Aprendiz?</label>
                            <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" >{{ $interview->porque_ser_jovem_aprendiz }}</textarea>
                            @error('porque_ser_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_motivo_demissao" class="form-label">Por qual motivo pediria demissão:</label>
                            <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" >{{ $interview->qual_motivo_demissao }}</textarea>
                            @error('qual_motivo_demissao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pretencao_candidato" class="form-label">Pretenções do candidato:</label>
                            <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" >{{ $interview->pretencao_candidato }}</textarea>
                            @error('pretencao_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="objetivo_longo_prazo" class="form-label">Objetivos longo prazo:</label>
                            <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" >{{ $interview->objetivo_longo_prazo }}</textarea>
                            @error('objetivo_longo_prazo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontos_melhoria" class="form-label">Pontos de Melhoria:</label>
                            <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" >{{ $interview->pontos_melhoria }}</textarea>
                            @error('pontos_melhoria') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia" class="form-label">Família:</label>
                            <textarea class="form-control" id="familia" name="familia" >{{ $interview->familia }}</textarea>
                            @error('familia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="disponibilidade_horario" class="form-label">Disponibilidade de Horário:</label>
                            <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" >{{ $interview->disponibilidade_horario }}</textarea>
                            @error('disponibilidade_horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sobre_candidato" class="form-label">Fale um pouco sobre você:</label>
                            <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" >{{ $interview->sobre_candidato }}</textarea>
                            @error('sobre_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="rotina_candidato" class="form-label">Qual a sua rotina?</label>
                            <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" >{{ $interview->rotina_candidato }}</textarea>
                            @error('rotina_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia_cras" class="form-label">Sua família é atendida no CRAS?</label>
                            <select name="familia_cras" id="familia_cras" class="form-select" required>
                                <option value="Sim" {{ $interview->familia_cras === 'Sim' ? 'selected' : ''}}> Sim</option>
                                <option value="Não" {{ $interview->familia_cras === 'Não' ? 'selected' : ''}}> Não</option>
                            </select>
                            @error('familia_cras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="outros_idiomas" class="form-label">Outros idiomas?</label>
                            <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" >{{ $interview->outros_idiomas }}</textarea>
                            @error('outros_idiomas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="fonte_curriculo" class="form-label">Fonte de Captação do Currículo</label>
                            <input type="text" class="form-control" id="fonte_curriculo" name="fonte_curriculo" required value="{{ $interview->fonte_curriculo }}">
                            @error('fonte_curriculo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sugestao_empresa" class="form-label">Sugestão Empresa</label>
                            <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" >{{ $interview->sugestao_empresa }}</textarea>
                            @error('sugestao_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações:</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" >{{ $interview->observacoes }}</textarea>
                            @error('observacoes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontuacao" class="form-label">Pontuação</label>
                            <input type="text" class="form-control" id="pontuacao" name="pontuacao" required value="{{ $interview->pontuacao }}">
                            @error('pontuacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row bg-light p-3 mb-2">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary" disabled>Salvar Entrevista</button>

                    </div>
                </div>

            </form>

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