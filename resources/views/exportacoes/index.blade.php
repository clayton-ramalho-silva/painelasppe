@extends('layouts.app')

@section('content')
<section class="cabecario">
    <h1>Exportações</h1>
    <div class="cabExtras"></div>
</section>

<section class="sessao">
    <article class="f-interna">

        {{-- Mensagens flash --}}
        {{-- @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif --}}
        @if (session('error'))
            <div class="alert alert-danger mb-3">{{ session('error') }}</div>
        @endif

        {{-- Tabela de exportações geradas --}}
        <div class="table-container lista-exportacoes">

            <ul class="tit-lista">
                <li class="col1">Tipo</li>
                <li class="col2">Gerada em</li>
                <li class="col3">Status</li>
                <li class="col4">Tamanho</li>
                <li class="col5">Baixada em</li>
                <li class="col6">Ações</li>
            </ul>

            @if ($exports->count() > 0)
                @foreach ($exports as $export)
                    <ul class="row-list" data-export-id="{{ $export->id }}" data-export-status="{{ $export->status }}">

                        <li class="col1">
                            <b>Tipo</b>
                            {{ $export->getTypeLabel() }}
                        </li>

                        <li class="col2">
                            <b>Gerada em</b>
                            {{ $export->created_at->format('d/m/Y H:i') }}
                        </li>

                        <li class="col3">
                            <b>Status</b>
                            <span class="badge-status badge-status--{{ $export->status }}">
                                {{ $export->getStatusLabel() }}
                            </span>
                        </li>

                        <li class="col4">
                            <b>Tamanho</b>
                            {{ $export->getFileSizeFormatted() }}
                        </li>

                        <li class="col5">
                            <b>Baixada em</b>
                            {{ $export->downloaded_at ? $export->downloaded_at->format('d/m/Y H:i') : '—' }}
                        </li>

                        <li class="col6">
                            <div class="acoes-exportacao">
                                {{-- Botão baixar --}}
                                @if ($export->isReady())
                                    <a href="{{ route('exportacoes.download', $export) }}"
                                       class="btn-deletar-entidades"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="Baixar exportação">
                                        <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                    </a>
                                @endif

                                {{-- Botão deletar --}}
                                <form action="{{ route('exportacoes.destroy', $export) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-deletar-entidades"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Remover exportação"
                                            onclick="event.preventDefault(); if(confirm('Remover esta exportação?')){ this.closest('form').submit() }">
                                        <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>
                @endforeach
            @else
                <span class="sem-resultado">Nenhuma exportação gerada ainda</span>
            @endif

        </div>

        <div class="pagination-wrapper mt-3">
            {{ $exports->links('vendor.pagination.custom') }}
            @if ($exports->total() > 0)
                <p class="pagination-info mt-3">
                    Mostrando {{ $exports->firstItem() }} a {{ $exports->lastItem() }} de {{ $exports->total() }} exportações
                </p>
            @endif
        </div>

    </article>

    {{-- Sidebar com botões de gerar exportação --}}
    <article class="f4 bts-interna">
        <form action="{{ route('exportacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="curriculos">
            <button type="submit" class="btInt btCadastrar">
                Currículos <small>Exportar para Excel</small>
            </button>
        </form>

        <form action="{{ route('exportacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="entrevistas">
            <button type="submit" class="btInt btExportar">
                Entrevistas <small>Exportar para Excel</small>
            </button>
        </form>

        <form action="{{ route('exportacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="empresas">
            <button type="submit" class="btInt btHistorico">
                Empresas <small>Exportar para Excel</small>
            </button>
        </form>

        <form action="{{ route('exportacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="vagas">
            <button type="submit" class="btInt" style="background-color: #6c757d;">
                Vagas <small>Exportar para Excel</small>
            </button>
        </form>
    </article>

</section>

{{-- Dados para o polling JS --}}
@php
    $activeExports = $exports->filter(fn($e) => $e->isActive());
@endphp

@if ($activeExports->isNotEmpty())
    <div id="polling-data"
         data-active-ids="{{ $activeExports->pluck('id')->join(',') }}"
         data-status-url="{{ route('exportacoes.status') }}">
    </div>
@endif

@endsection

@push('scripts-custom')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const pollingEl = document.getElementById('polling-data');
    if (!pollingEl) return; // Sem exports ativos, não inicia polling

    const statusUrl = pollingEl.dataset.statusUrl;
    const activeIds = pollingEl.dataset.activeIds.split(',').map(Number);
    let pendingIds  = [...activeIds];
    let interval;

    function checkStatus() {
        const params = new URLSearchParams();
        pendingIds.forEach(id => params.append('ids[]', id));

        fetch(`${statusUrl}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {

            // Atualiza badge de status na linha de cada export ativo
            data.actives.forEach(exp => {
                const row = document.querySelector(`[data-export-id="${exp.id}"]`);
                if (row) {
                    const badge = row.querySelector('.badge-status');
                    if (badge) {
                        badge.className = `badge-status badge-status--${exp.status}`;
                        badge.textContent = statusLabels[exp.status] ?? exp.status;
                    }
                }
            });

            // Exports que ficaram prontos
            if (data.ready.length > 0) {
                const nomes = data.ready.map(e => typeLabels[e.type] ?? e.type).join(', ');
                alert(`Exportação pronta para download: ${nomes}.\nRecarregue a página para baixar.`);
                clearInterval(interval);
                location.reload();
            }

            // Remove da lista de pendentes os que já não estão mais ativos
            const activeNow = data.actives.map(e => e.id);
            pendingIds = pendingIds.filter(id => activeNow.includes(id));

            // Se não sobrou nenhum ativo, para o polling
            if (pendingIds.length === 0) {
                clearInterval(interval);
                location.reload();
            }
        })
        .catch(err => console.error('Erro no polling:', err));
    }

    const statusLabels = {
        pending:    'Aguardando',
        processing: 'Gerando',
        ready:      'Pronta para baixar',
        failed:     'Falhou',
        downloaded: 'Baixada',
    };

    const typeLabels = {
        curriculos:  'Currículos',
        empresas:    'Empresas',
        vagas:       'Vagas',
        entrevistas: 'Entrevistas',
    };

    interval = setInterval(checkStatus, 5000); // Consulta a cada 5 segundos
});

// Impede o loader de travar em cliques de download
document.querySelectorAll('a[href*="download"]').forEach(function (link) {
    link.addEventListener('click', function () {
        setTimeout(function () {
            document.getElementById('loader').style.display = 'none';
        }, 5000);
    });
});
</script>
@endpush

@push('css-custom')
<style>
    .table-container.lista-exportacoes {
        height: 450px;
        overflow: auto;
    }

    .table-container.lista-exportacoes ul {
        flex-wrap: nowrap;
        min-width: 100%;
        width: fit-content;
    }

    .table-container.lista-exportacoes .tit-lista {
        width: fit-content;
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 4;
        min-width: 100%;
    }

    .col1 { width: 160px !important; justify-content: start !important; }
    .col2 { width: 160px !important; justify-content: start !important; }
    .col3 { width: 180px !important; justify-content: start !important; }
    .col4 { width: 120px !important; justify-content: start !important; }
    .col5 { width: 160px !important; justify-content: start !important; }
    .col6 { width: 120px !important; justify-content: center !important; }

    .acoes-exportacao {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .btn-deletar-entidades {
        z-index: 0;
        background-color: #e4e4e4;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        width: 34px;
        height: 34px;
        transition: all 0.25s ease-in-out;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .btn-deletar-entidades:hover {
        background-color: #fff;
    }

    /* Badges de status */
    .badge-status {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .badge-status--pending    { background: #f1efe8; color: #5f5e5a; }
    .badge-status--processing { background: #faeeda; color: #854f0b; }
    .badge-status--ready      { background: #eaf3de; color: #3b6d11; }
    .badge-status--failed     { background: #fcebeb; color: #a32d2d; }
    .badge-status--downloaded { background: #e6f1fb; color: #185fa5; }

    .btInt {
        flex-wrap: nowrap;
    }

    .btInt.btHistorico{
        display: flex !important;
    }
</style>
@endpush