@extends('layouts.app')

@section('content')
<section class="cabecario">
    <h1>Currículos</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltro"  data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>
            
            <form id="filter-form" method="GET" action="{{ route('resumes.index') }}" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltro">

                <div class="row d-flex">
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome do Candidato</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}" placeholder="Buscar por nome...">                        
                    </div>
                    <div class="col-6">
                        <label for="vagas_interesse" class="form-label">Vagas de Interesse</label>
                        <select name="vagas_interesse[]" id="vagas_interesse" class="form-select" multiple>
                            @foreach (  
                                        ['Copa & Cozinha', 'Administrativo', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)',
                                        'Construção e Reparos', 'Conservação e Limpeza'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('vagas_interesse', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                           
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="experiencia_profissional" class="form-label">Experiência Profissional</label>
                        <select name="experiencia_profissional[]" id="experiencia_profissional" class="form-select" multiple>
                            @foreach (  
                                        ['Nenhuma por enquanto', 'Copa & Cozinha', 'Administrativo', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)', 'TI (Tecnologia da Informação',
                                        'Construção e Reparos', 'Conservação e Limpeza'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('experiencia_profissional', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                            
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }} > Disponível</option>
                            <option value="processo" {{ request('status') == 'processo' ? 'selected' : '' }}> Em processo</option>
                            <option value="contratado" {{ request('status') == 'contratado' ? 'selected' : '' }} > Contratado</option>
                            <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}> Inativo</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Homem" {{ request('sexo') == 'Homem' ? 'selected' : '' }}> Homem</option>
                            <option value="Mulher" {{ request('sexo') == 'Mulher' ? 'selected' : '' }}> Mulher</option>
                            <option value="Prefiro não dizer" {{ request('sexo') == 'Prefiro não dizer' ? 'selected' : '' }}> Prefiro não dizer</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cnh" class="form-label">Possui CNH?</label>
                        <select name="cnh" id="cnh" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim"  {{ request('cnh') == 'Sim' ? 'selected' : '' }}> Sim</option>
                            <option value="Não"  {{ request('cnh') == 'Não' ? 'selected' : '' }}> Não</option>
                            <option value="Em andamento"  {{ request('cnh') == 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="min_age" class="form-label">Idade mínima:</label>
                        <input type="number" name="min_age" id="min_age" class="form-control" value="{{ request('min_age')}}" >
                    </div>

                    <div class="col-6">
                        <label for="reservista" class="form-label">Possui Reservista?</label>
                        <select name="reservista" id="reservista" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" {{ request('reservista') == 'Sim' ? 'selected' : '' }}> Sim</option>
                            <option value="Não" {{ request('reservista') == 'Não' ? 'selected' : '' }}> Não</option>
                            <option value="Em andamento" {{ request('reservista') == 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="foi_jovem_aprendiz" class="form-label">Já foi Jovem Aprendiz?</label>
                        <select name="foi_jovem_aprendiz" id="foi_jovem_aprendiz" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim, da ASPPE"  {{ request('foi_jovem_aprendiz') == 'Sim, da ASPPE' ? 'selected' : '' }}> Sim, da ASPPE</option>
                            <option value="Sim, de Outra Qualificadora"  {{ request('foi_jovem_aprendiz') == 'Sim, de Outra Qualificadora' ? 'selected' : '' }}> Sim, de Outra Qualificadora</option>
                            <option value="Não"  {{ request('foi_jovem_aprendiz') == 'Não' ? 'selected' : '' }}> Não</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="escolaridade" class="form-label">Formação/Escolaridade</label>
                        <select name="escolaridade" id="escolaridade" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Ensino Médio Incompleto" {{ request('escolaridade') == 'Ensino Médio Incompleto' ? 'selected' : '' }}> Ensino Médio Incompleto</option>
                            <option value="Ensino Médio Completo" {{ request('escolaridade') == 'Ensino Médio Completo' ? 'selected' : '' }}> Ensino Médio Completo</option>
                            <option value="Outro" {{ request('escolaridade') == 'Outro' ? 'selected' : '' }}> Outro</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="informatica" class="form-label">Informática</label>
                        <select name="informatica" id="informatica" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" {{ request('informatica') == 'Básico' ? 'selected' : '' }}> Básico</option>
                            <option value="Intermediário" {{ request('informatica') == 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                            <option value="Avançado" {{ request('informatica') == 'Avançado' ? 'selected' : '' }}> Avançado</option>
                            <option value="Nenhum" {{ request('informatica') == 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" {{ request('ingles') == 'Básico' ? 'selected' : '' }}> Básico</option>
                            <option value="Intermediário" {{ request('ingles') == 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                            <option value="Avançado" {{ request('ingles') == 'Avançado' ? 'selected' : '' }}> Avançado</option>
                            <option value="Nenhum" {{ request('ingles') == 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select select2">
                            <option>Todas</option>
                            @php
                            echo get_cidades($resumes, 3);
                            @endphp
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="entrevistado" class="form-label">Entrevistado</label>
                        <select name="entrevistado" id="entrevistado" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="1" {{ request('entrevistado') == '1' ? 'selected' : '' }}>Já entrevistado</option>
                            <option value="0" {{ request('entrevistado') == '0' ? 'selected' : '' }}>Não entrevistado</option>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select select2">
                            <option value="">Todas</option>
                            <option value="7" {{ request('filtro_data') == '7' ? 'selected' : '' }}>Últimos 7 dias</option>
                            <option value="15" {{ request('filtro_data') == '15' ? 'selected' : '' }}>Últimos 15 dias</option>
                            <option value="30" {{ request('filtro_data') == '30' ? 'selected' : '' }}>Últimos 30 dias</option>
                            <option value="90" {{ request('filtro_data') == '90' ? 'selected' : '' }}>Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="data_min" class="form-label">Data Cadastro (de):</label>
                        <input type="date" name="data_min" id="data_min" class="form-control" value="{{ request('data_min') }}">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="data_max" class="form-label">Data Cadastro (até):</label>
                        <input type="date" name="data_max" id="data_max" class="form-control" value="{{ request('data_max') }}">
                    </div>

                    <div class="col mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>                        
                        <a href="{{ route('resumes.index') }}" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

<div class="bloco-filtros-ativos">
    Filtros ativos <span></span>
</div>


<section class="sessao">

    <article class="f-interna">

        <h4>Currículos em Destaque</h4>        

        <div class="table-container lista-curriculos">

            <ul class="tit-lista">
                <li class="col1">Nome</li>
                <li class="col2">Tipo de vaga</li>
                <li class="col3">CNH</li>
                <li class="col4">Informática</li>
                <li class="col5">Inglês</li>
                <li class="col6">Entrevistado</li>
                <li class="col7">Status</li>
            </ul>

            @if ($resumes->count() > 0)

                

                @foreach ($resumes as $resume)
                <ul onclick="window.location='{{ route('resumes.edit', $resume) }}'" >
                    @php                       

                        $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                        $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                        $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';

                        //Verifica se a idade é maior que 22 anos e 8 meses
                        $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                        $limiteEmMeses = (22 * 12) + 8;
                    @endphp
                    <li class="col1">
                        <div class="col-icon">
                            <b>Nome</b>
                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>

                        </div>
                        <div class="col-info">
                            <span class="info-nome">
                                <strong>{{ $resume->informacoesPessoais->nome ?? '' }}</strong>
                            </span>
                            @if ($idadeEmMeses > $limiteEmMeses)
                                <p class="badge bg-danger">{{ $idadeFormatada }}</p>
                            @else
                                <p class="badge bg-light text-dark">{{ $idadeFormatada }}</p>
                            @endif

                        </div>

                    </li>
                    <li class="col2">
                        <b>Tipo de Vaga</b>
                        @if ($resume->vagas_interesse && is_array($resume->vagas_interesse))
                            @foreach ($resume->vagas_interesse as $vaga)
                                {{$vaga}},
                            @endforeach                            
                        @else
                            Nenhuma vaga de interesse informada.
                        @endif
                    </li>
                    <li class="col3">
                        <b>CNH</b>
                        {{ $resume->informacoesPessoais->cnh ?? '' }}
                    </li>
                    <li class="col4">
                        <b>Informática</b>
                        {{ $resume->escolaridade->informatica ?? '' }}
                    </li>
                    <li class="col5">
                        <b>Inglês</b>
                        {{ $resume->escolaridade->ingles ?? '' }}
                    </li>
                    <li class="col6">
                        <b>Entrevista</b>
                        @if ($resume->interview)
                            <a href="{{ route('interviews.show', $resume->interview->id) }}#form-interview" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        @else
                            <a href="{{ route('interviews.interviewResume', $resume) }}#form-interview"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        @endif
                    </li>
                    <li class="col7">
                        <b>Status</b>                    

                        
                        @switch($resume->status)
                            @case('ativo')
                                <i class="status-ativo" title="Disponível"></i>Disponível
                                @break
                            @case('inativo')
                                <i class="status-inativo" title="Inativo"></i>Inativo
                                @break
                            @case('processo')
                                <i class="status-em-processo" title="Em processo"></i>Em processo
                                @break
                            @case('contratado')
                                <i class="status-contratado" title="Contratado"></i>Contratado
                                @break                           
                                
                        @endswitch
                       
                    </li>

                </ul>
                @endforeach

            @else
            <span class="sem-resultado">Nenhum currículo encontrado</span>
            @endif

            
        </div>
        <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper">
            {{ $resumes->appends(request()->query())->links('vendor.pagination.custom') }}
            <p class="pagination-info">Mostrando {{ $resumes->firstItem() }} a {{ $resumes->lastItem() }} de {{ $resumes->total() }} currículos</p>
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('resumes.create') }}" class="btInt btCadastrar">Cadastrar <small>Criar um novo currículo</small></a>
        @if (Auth::user()->email == 'clayton@email.com')
            <a href="{{ route('reports.export.resumes') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        @endif
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>
</section>
@endsection


@push('scripts-custom')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>

$(document).ready(function(){
    // Inicializa o Select2
    $('.bloco-filtros .select2').select2({
        placeholder: "Selecione",
    });

    // Botão limpar - redireciona para URL sem parâmetros
    $('button[name="limpar"]').on('click', function(e){
        e.preventDefault();
        window.location.href = "{{ route('resumes.index') }}";
    });

    // Atualiza filtros ativos quando a página carrega
    updateActiveFilters();
});

// Função para mostrar filtros ativos
function updateActiveFilters(){
    let params = new URLSearchParams(window.location.search);
    let activeFilters = [];
    let filtersContainer = $('.bloco-filtros-ativos span');
    filtersContainer.empty(); // Limpa os filtros anteriores

    params.forEach((value, key) => {
        // Ignora parâmetros de paginação e vazios
        if( key !== 'page' && value && value !== 'Todos' && value !== 'Todas'){
            // Para arrays (selects múltiplos)
            if (key.endsWith('[]')){
                activeFilters.push(createFilterBadge(key.replace('[]', ''), value));
            } else {
                activeFilters.push(createFilterBadge(key, value));
            }
        }
    });

    if(activeFilters.length > 0) {
        filtersContainer.append(activeFilters);
        $('.bloco-filtros-ativos').slideDown(150);
    } else {
        $('.bloco-filtros-ativos').slideUp(150);
    }
}

// Cria um badge para cada filtro com botão de remover
function createFilterBadge(key, value) {
    // Cria um elemento span para o badge
    let badge = $('<span class="filter-badge"></span>');

    // Adiciona o valor do filtro
    badge.append(document.createTextNode(value));

    // Adciona o botão de remover (x)
    let removeBtn = $('<button class="remove-filter" data-key="'+key+'" data-value="'+value+'">x</button>');
    badge.append(removeBtn);

    return badge;
}

// Remove um filtro especifico e recarrega a pagina
$(document).on('click', '.remove-filter', function(){
    let key = $(this).data('key');
    let value = $(this).data('value');
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);

    // Para filtros multiplos (array)
    if (key.endsWith('[]')){
        let currentValues = params.getAll(key);
        let newValues = currentValues.filter(v => v !== value);

        // Remove o parametro completamente se não houver mais valores
        params.delete(key);
        newValues.forEach(v => params.append(key, v));
    }
    // Para filtro simples
    else {
        params.delete(key);
    }

    // Remove também a página para voltar a primeira
    params.delete('paga');

    // Atualiza a URL e recarrega
    window.location.href = url.pathname + '?' + params.toString();

});

</script>
@endpush



@push('css-custom')
<style>
.subtitulo{
    font-weight: 500;
    font-size: 12px;
    color: #aaa;
}
.btInt{
flex-wrap: nowrap;
}

.lista-curriculos{
    overflow: scroll;
    height: 500px;
}

.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.col-icon{
    width: 20%;
}

.col-info{
    width: 80%;
}

.col-info .info-nome{
    float: left;
    width: 100%;
}

.bloco-filtros .col-12{
    margin-bottom: 11px;
}
.bloco-filtros .col-12 .form-label {
    width: 100%;
    margin: 0 !important;
    font-weight: 700;
    padding-bottom: 7px;
    color: #333333;
}

/* Estilo dos badges de filtro*/
.bloco-filtros-ativos {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    font-weight: 700;
    font-size: 12px;
    margin: 10px 0;
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    -ms-border-radius: 20px;
    padding: 3px 14px;
    background-color: #F2F2F2;
    letter-spacing: normal;
}

.filter-badge {
    display: inline-block;
    margin-right: 8px;   
    padding: 5px 10px;
    padding-left: 24px;
    background: #fff;
    border-radius: 15px;
    font-size: 12px;
    position: relative;
}

.remove-filter {
    margin-left: 5px;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0 5px;
    color: #ff0000;
    font-size: 15px;
    position: absolute;
    top: 3px;
    left: 0;
    font-weight: 700;
    font-family: 'Montserrat';
    line-height: 1em;
}

.remove-filter:hover {
    color: #dc3545;
}




/* css paginate */
/* Em seu arquivo CSS */
.pagination-container {
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    display: block;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.2s;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #fff;
    border-color: #ddd;
}

.page-link:hover {
    background-color: #f8f9fa;
}

/* Estilo responsivo */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
    }
    
    .page-item {
        margin-bottom: 5px;
    }
}

</style>
@endpush