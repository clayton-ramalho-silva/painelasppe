@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Vagas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
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

    <article class="f1">

        <div class="container">

            <form id="form-jobs" class="form-padrao" action="{{ route('jobs.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="mb-3 col-12">
                        <div class="floatlabel-wrapper required">
                            <label for="company_id" class="label-floatlabel" class="form-label floatlabel-label">Escolhe Empresa</label>
                            <select name="company_id" id="company_id" class="form-select" required>
                                <option></option>
                                @foreach ($companies->sortBy('nome_fantasia') as $company )
                                    <option value="{{ $company->id}} "> {{ $company->nome_fantasia }} </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="cargo" class="label-floatlabel" class="form-label floatlabel-label">Setor</label>
                            <select name="cargo" id="cargo" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Copa & Cozinha">Copa & Cozinha</option>
                                <option value="Administrativo">Administrativo</option>
                                <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                                <option value="Recepcionista">Recepcionista</option>
                                <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                                <option value="Construção e Reparos">Construção e Reparos</option>
                                <option value="Conservação e Limpeza">Conservação e Limpeza</option>
                            </select>
                            @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="cbo" class="label-floatlabel" class="form-label floatlabel-label">CBO</label>
                            <select name="cbo" id="cbo" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="4110-10">4110-10</option>
                                <option value="4122-05">4122-05</option>
                                <option value="4221-05">4221-05</option>
                                <option value="5211-40">5211-40</option>
                                <option value="5211-25">5211-25</option>
                                <option value="4211-25">4211-25</option>
                                <option value="5133-15">5133-15</option>
                                <option value="5135-05">5135-05</option>
                                <option value="5134-05">5134-05</option>
                                <option value="5134-15">5134-15</option>
                                <option value="5134-35">5134-35</option>
                                <option value="5134-10">5134-10</option>
                                <option value="5134-40">5134-40</option>
                                <option value="5134-20">5134-20</option>
                                <option value="5134-30">5134-30</option>
                                <option value="5134-25">5134-25</option>
                                <option value="5142-25">5142-25</option>
                                <option value="7156-10">7156-10</option>
                                <option value="7166-10">7166-10</option>
                                <option value="7164-05">7164-05</option>
                                <option value="5143-25">5143-25</option>
                            </select>
                            @error('cbo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <div class="floatlabel-wrapper form-textarea">
                            <label for="descricao" class="label-floatlabel" class="form-label floatlabel-label">Atividades esperadas</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control"></textarea>
                            @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="genero" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                            <select name="genero" id="genero" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Indiferente">Indiferente</option>
                            </select>
                            @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="number" placeholder="Quantidade de vagas" class="floatlabel form-control" id="qtd_vagas" name="qtd_vagas" required>
                        @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-4 form-campo">
                        <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required>
                        @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 form-campo col-2">
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

                    {{-- <div class="mb-3 col-2 form-campo">
                        <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required>
                        @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div> --}}

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Salário" class="floatlabel form-control" id="salario" name="salario" required>
                        @error('salario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Dias da Semana" class="floatlabel form-control" id="dias_semana" name="dias_semana" required placeholder="Seg. à Sáb.">
                        @error('dias_semana') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Horário" class="floatlabel form-control" id="horario" name="horario" required>
                        @error('horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Dia, Hora e Modalidade do Curso" class="floatlabel form-control" id="dias_curso" name="dias_curso" required>
                        @error('dias_curso') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Benefícios" class="floatlabel form-control" id="exp_profissional" name="exp_profissional" required>
                        @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-12">
                        <div class="floatlabel-wrapper form-textarea">
                            <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Requisitos/Diferenciais</label>
                            <textarea class="form-control active-floatlabel" id="beneficios" name="beneficios" required></textarea>
                            @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="informatica" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em informática?</label>
                            <select name="informatica" id="informatica" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Não">Não</option>
                                <option value="Básico">Básico</option>
                                <option value="Intermediário">Intermediário</option>
                                <option value="Avançado">Avançado</option>
                            </select>
                            @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="ingles" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em inglês?</label>
                            <select name="ingles" id="ingles" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Não">Não</option>
                                <option value="Básico">Básico</option>
                                <option value="Intermediário">Intermediário</option>
                                <option value="Avançado">Avançado</option>
                            </select>
                            @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                <div class="col-12 bloco-submit mt-3 d-flex">
                    <button type="submit" class="btn-padrao btn-cadastrar">Salvar</button>
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
$('#salario').mask('#.##0,00', {reverse: true});
$('#company_id').select2({
    placeholder: "Selecione",
});
/*
$('#setor').select2({
    placeholder: "Selecione um setor",
});
*/
$('#uf').select2({
    placeholder: "Selecione",
});
$('#cbo').select2({
    placeholder: "Selecione",
});
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
</script>
@endpush

@push('css-custom')
<style>
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