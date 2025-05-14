@extends('layouts.app')

@section('content')

<section class="cabecario">
    <h1>Usuários</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroUsuarios" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-users" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroUsuarios">

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
                        <label for="funcao" class="form-label">Função:</label>
                        <select name="funcao" id="funcao" class="form-select">
                            <option>Todas</option>
                            <option value="admin">Administrador</option>
                            <option value="recruiter">Recrutador</option>
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

        <div class="table-container lista-usuarios">
            @php
                $isAdmin = Auth::user()->role == 'admin' ? true : false;                        
            @endphp 
            <ul class="tit-lista">
                <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">Usuário</li>
                <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">E-mail</li>
                <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}">Função</li>
                <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">Status</li>
                 @if ($isAdmin)
                    <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}">Ações</li>                            
                @endif
            </ul>

            @if ($users->count() > 0)

                @foreach ($users as $user)
                <a href="{{ route('users.edit', $user) }}"{!! ($user->status === 1) ? '' : ' class="inativo"' !!}>
                    <ul>
                        <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">
                            <b>Usuário</b>
                            @if ($user->image)
                                @if (file_exists(public_path('documents/users/image/'.$user->image)))
                                    <img src="{{ asset("documents/users/image/{$user->image}") }}" alt="{{ $user->name }}" title="{{ $user->name }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/users/image/{$user->image}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $user->name }}</strong>
                            </span>
                        </li>
                        <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">
                            <b>E-mail</b>
                            {{ $user->email }}
                        </li>
                        <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}">
                            <b>Função</b>
                            {{ $user->role === 'recruiter' ? 'Recrutador' : 'Administrador' }}
                        </li>
                        <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">
                            <b>Status</b>
                            <i title="{{ $user->status === '1' ? 'Ativo' : 'Inativo' }}"></i>                        
                        </li>
                         @if ($isAdmin) 
                        <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}">
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-deletar-entidades" data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar Usuário" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir este Usuário?')){this.closest('form').submit()}">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                   
                                </button>
                            </form>
                        </li>
                        @endif 

                    </ul>
                </a>
                @endforeach

            @else
            <span class="sem-resultado">Nenhum usuário encontrada</span>
            @endif

        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('register') }}" class="btInt btCadastrar">Cadastrar <small>Cadastrar novo usuário</small></a>
        <a href="{{ route('reports.export.users') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
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
            $('#funcao').val('Todas').select2();
        }

    });

    $('#funcao').select2({
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

    $('#filter-form-users').on('submit', function(e) {

        console.dir('aaa');

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "{{ route('users.index') }}",
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

    .subtitulo{
        font-weight: 500;
        font-size: 12px;
        color: #aaa;
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
