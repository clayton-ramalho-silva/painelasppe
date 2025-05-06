@extends('layouts.app')

@section('content')
<section class="cabecario">
    <h1>Nova Entrevista</h1>

</section>
<section class="sessao">

    <article class="f1">
<div class="container">


    <form action="" method="get" id="resumeForm">
        <div class="row border-bottom mb-3">
            <div class="col-4">
                <div class="mb-3">
                    <label for="resume_id" class="form-label">Selecione o Candidato</label>
                    <select name="resume_id" id="resume_id" class="form-select">
                        <option value="" disabled selected>Escolher</option>

                        @if ($resumes->isNotEmpty())
                            @foreach ($resumes as $resume)
                                <option value="{{$resume->id}}">{{ $resume->informacoesPessoais->nome }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>Nenhum candidato disponível para entrevista</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

    </form>

    {{--
    <form action="{{ route('interviews.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome e Sobrenome" readonly disabled>
                    @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror

                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required readonly disabled>
                    @error('data_nascimento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="estado_civil" class="form-label">Estado Civil</label>
                    <select name="estado_civil" id="estado_civil" class="form-select" required>
                        <option selected> Escolher</option>
                        <option value="Solteiro"> Solteiro</option>
                        <option value="Casado"> Casado</option>
                        <option value="Divorciado"> Divorciado</option>
                        <option value="Viúvo"> Viúvo</option>
                        <option value="Separado"> Separado</option>
                    </select>
                    @error('estado_civil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="possui_filhos" class="form-label">Possui filhos?</label>
                    <select name="possui_filhos" id="possui_filhos" class="form-select" required>
                        <option selected> Escolher</option>
                        <option value="Sim"> Sim</option>
                        <option value="Não"> Não</option>
                    </select>
                    @error('possui_filhos') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" id="sexo" class="form-select" required>
                        <option selected> Escolher</option>
                        <option value="Homem"> Homem</option>
                        <option value="Mulher"> Mulher</option>
                        <option value="Prefiro não dizer"> Prefiro não dizer</option>
                    </select>
                    @error('sexo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <p>Tem Reservista?</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim">
                        @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        <label class="form-check-label" for="reservista1">
                          Sim
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não">
                        @error('reservista') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        <label class="form-check-label" for="reservista2">
                          Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="rg" class="form-label">RG</label>
                    <input type="text" class="form-control" id="rg" name="rg" required placeholder="RG" readonly>
                    @error('rg') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required placeholder="CPF">
                    @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                    @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="numero" class="form-label">Numero</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                    @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" required>
                    @error('complemento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                    @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                    @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control" id="uf" name="uf" required>
                    @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                    @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="telefone_residencial" class="form-label">Telefone Residencial</label>
                    <input type="text" class="form-control" id="telefone_residencial" name="telefone_residencial" required>
                    @error('telefone_residencial') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="telefone_celular" class="form-label">Telefone Celular</label>
                    <input type="text" class="form-control" id="telefone_celular" name="telefone_celular" required>
                    @error('telefone_celular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Copa & Cozinha" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Copa & Cozinha
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Administrativo" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Administrativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Camareiro(a) de Hotel" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Camareiro(a) de Hotel
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Recepcionista" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Recepcionista
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Atendente de Lojas e Mercados (Comércio & Varejo)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Construção e Reparos" name="vagas_interesse[]">
                        <label class="form-check-label" for="vagas_interesse">
                            Construção e Reparos
                        </label>
                    </div>
                    @error('vagas_interesse') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Nenhuma por enquanto" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Nenhuma por enquanto
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Copa & Cozinha" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Copa & Cozinha
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Administrativo" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Administrativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Camareiro(a) de Hotel" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Camareiro(a) de Hotel
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Recepcionista" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Recepcionista
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Atendente de Lojas e Mercados (Comércio & Varejo)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            TI (Tecnologia da Informação)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Construção e Reparos" name="experiencia_profissional[]">
                        <label class="form-check-label" for="experiencia_profissional">
                            Construção e Reparos
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Outro" name="experiencia_profissional[]">
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
                            <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade1" value="Ensino Médio Incompleto">
                            <label class="form-check-label" for="escolaridade1">
                                Ensino Médio Incompleto
                            </label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade2" value="Ensino Médio Completo">
                            <label class="form-check-label" for="escolaridade2">
                                Ensino Médio Completo
                            </label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade3" value="Outro">
                            <label class="form-check-label" for="escolaridade3">
                              Outro
                            </label>
                        </div>
                        @error('escolaridade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="telefone_celular" class="form-label">Já participou de alguma seleção nossa?</label>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao1" value="Sim, já fui chamado(a) para 1ª fase de um Processo Seletivo.">
                        <label class="form-check-label" for="participou_selecao1">
                            Sim, já fui chamado(a) para 1ª fase de um Processo Seletivo.
                        </label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao2" value="Sim, já fui encaminhado(a) para teste na Empresa parceira.">
                        <label class="form-check-label" for="participou_selecao2">
                            Sim, já fui encaminhado(a) para teste na Empresa parceira.
                        </label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Enviei currículo mas não fui chamado(a).">
                        <label class="form-check-label" for="participou_selecao3">
                            Enviei currículo mas não fui chamado(a).
                        </label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Não participei ainda.">
                        <label class="form-check-label" for="participou_selecao3">
                            Não participei ainda.
                        </label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="radio" name="participou_selecao" id="participou_selecao3" value="Outro">
                        <label class="form-check-label" for="participou_selecao3">
                            Outro
                        </label>
                    </div>
                    @error('participou_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
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
                        <option selected> Escolher</option>
                        <option value="Básico"> Básico</option>
                        <option value="Intermediário"> Intermediário</option>
                        <option value="Avançado"> Avançado</option>
                        <option value="Nenhum"> Nenhum</option>
                    </select>
                    @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="ingles" class="form-label">Possui conhecimento de Inglês?</label>
                    <select name="ingles" id="ingles" class="form-select" required>
                        <option selected> Escolher</option>
                        <option value="Básico"> Básico</option>
                        <option value="Intermediário"> Intermediário</option>
                        <option value="Avançado"> Avançado</option>
                        <option value="Nenhum"> Nenhum</option>
                    </select>
                    @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>
                    <select name="tamanho_uniforme" id="tamanho_uniforme" class="form-select" required>
                        <option selected> Escolher</option>
                        <option value="FEMININO: Baby Look P"> FEMININO: Baby Look P</option>
                        <option value="FEMININO: Baby Look M"> FEMININO: Baby Look M</option>
                        <option value="FEMININO: Baby Look G"> FEMININO: Baby Look G</option>
                        <option value="FEMININO: Baby Look GG"> FEMININO: Baby Look GG</option>
                        <option value="MASCULINO:  P"> MASCULINO:  P</option>
                        <option value="MASCULINO:  M"> MASCULINO:  M</option>
                        <option value="MASCULINO:  G"> MASCULINO:  G</option>
                        <option value="MASCULINO:  GG"> MASCULINO:  GG</option>
                    </select>
                    @error('tamanho_uniforme') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="curriculo_doc" class="form-label">Envie seu currículo</label>

                    <input type="file" class="form-control" id="curriculo_doc" name="curriculo_doc">
                    @error('curriculo_doc') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>

        </div>

        <div class="mb-3">
            <label for="resume_id" class="form-label">Candidato</label>
            <select class="form-control" id="resume_id" name="resume_id" required>
                <option selected disabled >Escolher Candidato</option>

                @foreach ($resumes as $resume)
                <option value="{{ $resume->id }}">{{ $resume->nome_candidato }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="job_id" class="form-label">Vaga</label>
            <select class="form-control" id="job_id" name="job_id" required>
                <option selected disabled>Vagas Disponíveis</option>
                @foreach ($jobs as $job)
                <option value="{{ $job->id }}">{{ $job->titulo }} - {{ $job->company->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" required>
        </div>
        <div class="mb-3">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    --}}
</div>

</article>

</section>
@endsection


<script>

document.addEventListener("DOMContentLoaded", function () {
        let selectResume = document.getElementById('resume_id');

        if (selectResume) { // Garante que o elemento existe
            selectResume.addEventListener('change', function () {
                let selectedResumeId = this.value;
                if (selectedResumeId) {
                    window.location.href = "{{ route('interviews.interviewResume', '') }}/" + selectedResumeId;
                }
            });
        }
    });

/*
document.addEventListener('DOMContentLoaded', function(){
    const resumeSelect = document.getElementById('resume_id');

    if (resumeSelect){
        resumeSelect.addEventListener('change', function () {
        const resumeId = this.value;

        // Realiza a requisição AJAX para buscar os dados do candidato
        fetch(`/interviews/resume/${resumeId}`);
    });
    }

});
*/


</script>