@extends('layouts.app')

@section('content')

<section class="cabecario">
    <h1>Usuários</h1>

    <div class="cabExtras">

        <div class="btFiltros filtros">
            <figure>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
            </figure>
            <span>Filtros</span>
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

<section class="sessao">

    <article class="f-interna">


    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>E-mail</th>
                <th>Função</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr onclick="window.location='{{ route('users.edit', $user) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                <td class="ico-v">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                    {{ $user->name }}
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>

                {{--
                <td class="m-actions">
                    <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir ações">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                <circle cx="2" cy="8" r="2"></circle>
                                <circle cx="8" cy="8" r="2"></circle>
                                <circle cx="14" cy="8" r="2"></circle>
                        </svg>

                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-{{ $user->id }}">
                            <a href="{{ route('users.edit', $user) }}" class="editAqui">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar">
                                    <svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </span>

                </td>
                --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</article>

<article class="f4 bts-interna">
    <a href="{{ route('register') }}" class="btInt btCadastrar">Cadastrar <small>Cadastrar novo usuário</small></a>
    <a href="{{ route('companies.create') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
    <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
</article>
</section>
@endsection

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
</style>

@endpush
