@extends('layouts.app')

@section('content')
<section class="cabecario">

    <h1>Empresas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroEmpresas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-companies" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroEmpresas">

                <div class="row d-flex flex-column">

                    <div class="col d-flex flex-wrap justify-content-start">

                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <label class="form-check-label" for="status1">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status1" value="ativo" checked>Ativo
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label" for="status2">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status2" value="inativo" checked>Inativo
                            </label>
                        </div>

                    </div>

                    <div class="col">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select">
                            <option>Todas</option>
                            @php
                            echo get_cidades($companies);
                            @endphp
                        </select>
                    </div>

                    <div class="col">
                        <label for="cidade" class="form-label">UF:</label>
                        <select name="uf" id="uf" class="form-select">
                            <option>Todos</option>
                            @php
                            echo get_estados();
                            @endphp
                        </select>
                    </div>

                    <div class="col mb-4">
                        <label for="filtro_data" class="form-label">Data:</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
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

        <div class="table-container lista-empresas">
            @php
                $isAdmin = Auth::user()->role == 'admin' ? true : false;                        
            @endphp 
            <ul class="tit-lista">
                <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">Nome</li>
                <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">E-mail</li>
                <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}">Telefone</li>
                <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">Endereço</li>
                <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}">Status</li>  
                
                @if ($isAdmin)
                    <li class="col6 {{ $isAdmin ? 'col6-admin' : ''}}">Ações</li>                            
                @endif            
            </ul>

            @if ($companies->count() > 0)

                @foreach ($companies as $company)
                <a href="{{ route('companies.edit', $company) }}"{!! ($company->status === 'inativo') ? ' class="inativo"' : '' !!} data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Empresa">
                    <ul>
                        <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">
                            <b>Nome</b>
                           
                            @if ($company->logotipo)
                                @if (file_exists(public_path('documents/companies/images/'.$company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$company->logotipo}") }}" alt="{{ $company->nome_fantasia }}" title="{{ $company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $company->nome_fantasia }}</strong><br>{{ $company->cnpj }}
                            </span>
                        </li>
                        <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">
                            <b>E-mail</b>
                            {{ $company->contacts->email }}
                        </li>
                        <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}">
                            <b>Telefone</b>
                            {{ $company->contacts->telefone }}
                        </li>
                        <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">
                            <b>Endereço</b>
                            {{ $company->location->logradouro.', '.$company->location->numero }}
                        </li>
                        <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}">
                            <b>Status</b>
                            <i title="{{ $company->status === 'inativo' ? 'Inativo' : 'Ativo' }}"></i>
                        </li>
                        @if ($isAdmin) 
                        <li class="col6 {{ $isAdmin ? 'col6-admin' : ''}}">
                            <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-deletar-entidades" data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar Empresa" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir esta Empresa? Junto você deletará as vagas associadas a ela.')){this.closest('form').submit()}">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                   
                                </button>
                            </form>
                        </li>
                        @endif                     

                    </ul>
                </a>
                @endforeach

            @else
            <span class="sem-resultado">Nenhuma empresa encontrada</span>
            @endif

        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('companies.create') }}" class="btInt btCadastrar">Cadastrar <small>Crie uma nova empresa</small></a>
        <a href="{{ route('reports.export.companies') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>

@endsection

@push('scripts-custom')
<script>
var envio   = '',
    filtros = [];

$(document).ready(function() {

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-companies').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "{{ route('companies.index') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                $('.table-container').html($(response).find('.table-container').html());
                $('.dropdown-menu').removeClass('show');
            },
            error: function(xhr, status, error) {
                console.error("Erro ao buscar dados:", error);
            }
        });

    });

});
</script>
@endpush

@push('css-custom')
<style>
    td,tr{
        font-size: 12px;
    }
    .btInt{
    flex-wrap: nowrap;
}


.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}
.col1-admin{
width: 25% !important;
}
.col2-admin{
    width: 25% !important;
}
.col3-admin{
    width: 10% !important;
}
.col4-admin{
    width: 15% !important;
}
.col5-admin{
    width: 10% !important;
}
.col6-admin{
    width: 10% !important;
}

.btn-deletar-entidades{    
    z-index: 0;
    background-color: #e4e4e4;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    -ms-border-radius: 50px;
    width: 34px;
    height: 34px;
    transition: all 0.25s ease-in-out;
}
.btn-deletar-entidades:hover{    
   background-color: #fff;
}




</style>

@endpush