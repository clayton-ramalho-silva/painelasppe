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

            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="mb-3 col-6">
                        <label for="company_id" class="form-label">Empresa</label>
                        <select name="company_id" id="company_id" class="form-select" required>
                            <option selected disabled>Escolher Empresa</option>
                            @foreach ($companies as $company )
                                <option value="{{ $company->id}} "> {{ $company->nome_fantasia }} </option>
                            @endforeach
                        </select>
                        @error('company_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="setor" class="form-label">Setor</label>
                        <select name="setor" id="setor" class="form-select" required>
                            <option disabled selected>Escolha Setor</option>
                            <option value="Industria">Industria</option>
                            <option value="Varejo">Varejo</option>
                            <option value="Tecnologia">Tecnologia</option>
                            <option value="Serviços">Serviços</option>
                        </select>
                        @error('setor') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select name="cargo" id="cargo" class="form-select" required>
                            <option disabled selected>Escolha Cargo</option>
                            <option value="Copa & Cozinha">Copa & Cozinha</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                            <option value="Construção e Reparos">Construção e Reparos</option>
                        </select>
                        @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="cbo" class="form-label">CBO</label>
                        <input type="text" name="cbo" id="cbo" class="form-control">
                        @error('cbo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-12">
                        <label for="descricao" class="form-label">Atividades esperadas</label>
                        <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control"></textarea>
                        @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="genero" class="form-label">Gênero</label>
                        <select name="genero" id="genero" class="form-select" required>
                            <option disabled selected>Escolher</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Indiferente">Indiferente</option>
                        </select>
                        @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="qtd_vagas" class="form-label">Quantidade de vagas</label>
                        <input type="number" class="form-control" id="qtd_vagas" name="qtd_vagas" required>
                        @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                        @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-2">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" class="form-control" id="uf" name="uf" required>
                        @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="salario" class="form-label">Salário</label>
                        <input type="text" class="form-control" id="salario" name="salario" required>
                        @error('salario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="dias_semana" class="form-label">Dias de Semana</label>
                        <input type="text" class="form-control" id="dias_semana" name="dias_semana" required placeholder="Seg. à Sáb.">
                        @error('dias_semana') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="horario" class="form-label">Horário</label>
                        <input type="text" class="form-control" id="horario" name="horario" required>
                        @error('horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="dias_curso" class="form-label">Dias de Curso</label>
                        <input type="text" class="form-control" id="dias_curso" name="dias_curso" required>
                        @error('dias_curso') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="exp_profissional" class="form-label">Experiência Profissional</label>
                        <input type="text" class="form-control" id="exp_profissional" name="exp_profissional" required>
                        @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-12">
                        <label for="beneficios" class="form-label">Benefícios</label>
                        <textarea class="form-control" id="beneficios" name="beneficios" required></textarea>
                        @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="informatica" class="form-label">Conhecimento em informática?</label>
                        <select name="informatica" id="informatica" class="form-select" required>
                            <option disabled selected>Escolher</option>
                            <option value="Não">Não</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermediário">Intermediário</option>
                            <option value="Avançado">Avançado</option>
                        </select>
                        @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="ingles" class="form-label">Conhecimento em inglês?</label>
                        <select name="ingles" id="ingles" class="form-select" required>
                            <option disabled selected>Escolher</option>
                            <option value="Não">Não</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermediário">Intermediário</option>
                            <option value="Avançado">Avançado</option>
                        </select>
                        @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                </div>

                <button type="submit" class="btn-padrao btn-cadastrar">Salvar</button>

            </form>
        </div>

    </article>

</section>
@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/floatlabels.min.js') }}"></script>
<script>
$("#form-companies-create").validate({
    rules:{
        cnpj:"required",
        razao_social:"required",
        nome_fantasia:"required",
        cep:"required",
        logradouro:"required",
        numero:"required",
        bairro:"required",
        pais:"required",
        cidade:"required",
        uf:"required",
        nome_contato:"required",
        telefone:"required",
        whatsapp:"required",
        email:{required: true, email:true},
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