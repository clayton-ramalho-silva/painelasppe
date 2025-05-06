@extends('layouts.app')

@section('content')
<section class="cabecario">

    <h1>Empresas3</h1>

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
                        <!--
                        <select name="status" id="status" class="form-select">
                            <option></option>
                            <option value="ativo"> Ativo</option>
                            <option value="inativo"> Inativo</option>
                        </select>
                        -->
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
                            <input type="text" placeholder="Cidade" class="form-control" id="cidade" name="cidade">
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="cidade" class="form-label">UF:</label>
                            <select name="uf" id="uf" class="form-select">
                                <option>Todos</option>
                                @php
                                echo get_estados();
                                @endphp
                            </select>
                            {{-- <input type="text" placeholder="UF" class="form-control" id="UF" name="uf"> --}}
                        </div>
                    </div>

                    <div class="col d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
                    </div>

                </div>

            </form>

        </div>

        <div class="btFiltros datas">
            <figure>
                <svg width="18px" height="20px" viewBox="0 0 18 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                    <title>date_range</title>
                    <desc>Created with Sketch.</desc>
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded" transform="translate(-307.000000, -244.000000)">
                            <g id="Action" transform="translate(100.000000, 100.000000)">
                                <g id="-Round-/-Action-/-date_range" transform="translate(204.000000, 142.000000)">
                                    <g>
                                        <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M19,4 L18,4 L18,3 C18,2.45 17.55,2 17,2 C16.45,2 16,2.45 16,3 L16,4 L8,4 L8,3 C8,2.45 7.55,2 7,2 C6.45,2 6,2.45 6,3 L6,4 L5,4 C3.89,4 3.01,4.9 3.01,6 L3,20 C3,21.1 3.89,22 5,22 L19,22 C20.1,22 21,21.1 21,20 L21,6 C21,4.9 20.1,4 19,4 Z M19,19 C19,19.55 18.55,20 18,20 L6,20 C5.45,20 5,19.55 5,19 L5,9 L19,9 L19,19 Z M7,11 L9,11 L9,13 L7,13 L7,11 Z M11,11 L13,11 L13,13 L11,13 L11,11 Z M15,11 L17,11 L17,13 L15,13 L15,11 Z" id="?Icon-Color" fill="#1D1D1D"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </figure>

            <span>Este m&ecirc;s</span>
        </div>

    </div>

</section>

@if (count($filtros) > 0)

@php
var_dump($filtros);
@endphp

    <div class="bloco-filtros-ativos">
        <b>Filtros:</b>

        @foreach ($filtros as $filtro)

        @endforeach

    </div>

@endif

<section class="sessao">

    <article class="f-interna">

        <div class="table-container">

            <ul class="tit-lista">
                <li class="col1">Nome</li>
                <li class="col2">E-mail</li>
                <li class="col3">Telefone</li>
                <li class="col4">Endereço</li>
                <li class="col5">Status</li>
                {{-- <li class="col-acoes">Ações</li> --}}
            </ul>

            @if ($companies->count() > 0)

                @foreach ($companies as $company)
                <a href="{{ route('companies.edit', $company) }}"{!! ($company->status === 'inativo') ? ' class="inativo"' : '' !!}>
                    <ul>
                        <li class="col1">
                            <!--<a href="{{ route('companies.edit', $company) }}">-->
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
                                <b>{{ $company->nome_fantasia }}</b><br>{{ $company->cnpj }}
                            </span>
                        </li>
                        <li class="col2">{!! limite($company->contacts->email, 28) !!}</li>
                        <li class="col3">{!! limite($company->contacts->telefone, 25) !!}</li>
                        <li class="col4">{!! limite($company->location->logradouro.', '.$company->location->numero, 35) !!}</li>
                        <li class="col5">
                            <i title="{{ $company->status === 'inativo' ? 'Inativo' : 'Ativo' }}"></i>
                        </li>
                        {{-- <li class="col-acoes">

                            <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais Informações">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><g><path d="m64.5,122.6c32,0 58-26 58-58s-26-58-58-58-58.1,26-58.1,58 26.1,58 58.1,58zm0-108c27.5,5.32907e-15 49.9,22.4 49.9,49.9s-22.4,49.9-49.9,49.9-49.9-22.4-49.9-49.9 22.4-49.9 49.9-49.9z"></path><path d="m54.8,90.1c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1h26.9c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-9.4v-36.1c0-2.3-1.8-4.1-4.1-4.1h-13.4c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h9.4v32h-9.4z"></path> <circle cx="62.7" cy="36.5" r="6.6"></circle> </g> </g></svg>

                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-">
                                    <b>CNPJ: </b>{{ $company->cnpj }}<br><br>
                                    <b>Endereço: </b>{{ $company->location->logradouro.', '.$company->location->numero }}<br><br>
                                    <b>Estado: </b>{{ $company->location->uf }}<br><br>
                                </div>

                            </span>

                            <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir ações">

                                <button class="dropdown-toggle" type="button" id="dropdownMenuActions-{{ $company->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                            <circle cx="2" cy="8" r="2"></circle>
                                            <circle cx="8" cy="8" r="2"></circle>
                                            <circle cx="14" cy="8" r="2"></circle>
                                    </svg>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuActions-{{ $company->id }}" data-bs-toggle="tooltip" data-bs-placement="top">

                                    <div class="dropdown-content">

                                        <a class="editAqui" href="{{ route('companies.edit', $company) }}" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>

                                        <a class="editAqui" href="{{ route('companies.show', $company) }}" title="Alterar status">
                                            <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0{fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;}
                                                    .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;}
                                                    .st2{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                                    .st3{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}
                                                    .st4{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:3;}
                                                </style>
                                                <path class="st1" d="M29,16c0,0-5.8,8-13,8S3,16,3,16s5.8-8,13-8S29,16,29,16z"></path>
                                                <circle class="st1" cx="16" cy="16" r="4"></circle>
                                                </svg>
                                        </a>

                                        <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                            </svg></button>
                                        </form>

                                    </div>

                                </div>

                            </span>

                        </li> --}}

                    </ul>
                </a>
                @endforeach

            @else
            <span class="sem-resultado">Nenhuma empresa encontrada</span>
            @endif

            <!--
            <table class="table table-borderless">
                <thead>

                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Status</th>
                    {{--<th>Ações</th>--}}
                </thead>
                <tbody>
                    @if ($companies->count() > 0)
                        @foreach ($companies as $company)

                            <tr onclick="window.location='{{ route('companies.edit', $company) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">

                                    <td class="ico-v">
                                        @if ($company->logotipo)
                                            <img src="{{ asset("documents/companies/images/{$company->logotipo}")}}" alt="" width="50" height="auto" class="rounded-circle me-2">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>

                                        @endif
                                        {{ $company->nome_fantasia }}
                                    </td>
                                    <td>{{ $company->contacts->email }}</td>
                                    <td>{{ $company->contacts->telefone }}</td>
                                    <td>{{ $company->location->logradouro }}, {{ $company->location->numero }}</td>
                                    <td>{{ $company->status }}</td>

                                    {{--
                                    <td class="m-actions">
                                        <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-{{ $company->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                    <circle cx="2" cy="8" r="2"></circle>
                                                    <circle cx="8" cy="8" r="2"></circle>
                                                    <circle cx="14" cy="8" r="2"></circle>
                                            </svg>

                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-{{ $company->id }}">
                                            <a href="{{ route('companies.edit', $company) }}" class="editAqui">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                            </a>
                                            <form action="{{ route('companies.destroy', $company) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                                    <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                                </svg></button>
                                            </form>
                                            </div>

                                        </span>
                                    </td>
                                    --}}
                            </tr>

                        @endforeach
                    @else
                    <tr><p>Nenhuma empresa Cadastrada!</p></tr>
                    @endif

                </tbody>

            </table>
            -->

        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('companies.create') }}" class="btInt btCadastrar">Cadastrar <small>Crie uma nova empresa</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>

@endsection

@push('scripts-custom')
<script>
var envio = '';

$(document).ready(function() {

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#uf').select2({
        placeholder: "Selecione",
    });

    $('#filter-form-companies').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        $.ajax({
            url: "{{ route('companies.index') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                $('.table-container').html($(response).find('.table-container').html());
                $('.dropdown-menu').removeClass('show');
                console.dir($(response).find('.bloco-filtros-ativos').html());
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
</style>

@endpush