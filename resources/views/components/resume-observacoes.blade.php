@props(['resume'])

@php
    $observacoes = $resume->observacoes->sortByDesc('created_at');
@endphp

{{-- Lista de observações do currículo com editar e excluir.
     Sem formulários: as ações são enviadas por fetch, porque esta lista aparece dentro
     do formulário da entrevista e form dentro de form é inválido no HTML. --}}

<div class="row mb-3 mt-3 bloco-observacoes" data-obs-lista>
    <div class="card">
        <div class="card-header bg-transparent">
            <p>Observações:</p>
        </div>
        <div class="card-body">
            <span class="d-none" data-obs-csrf>{{ csrf_token() }}</span>

            <p class="obs-vazio {{ $observacoes->isNotEmpty() ? 'd-none' : '' }}">Nenhuma observação.</p>

            @foreach ($observacoes as $observacao)
                <div data-obs-item="{{ $observacao->id }}"
                     data-obs-update-url="{{ route('resumes.observacoes.update', ['resume' => $resume->id, 'historyId' => $observacao->id]) }}"
                     data-obs-delete-url="{{ route('resumes.observacoes.destroy', ['resume' => $resume->id, 'historyId' => $observacao->id]) }}">

                    <div class="d-flex justify-content-between align-items-start gap-3 {{ $loop->last ? '' : 'border-bottom pb-2 mb-2' }}" data-obs-linha>
                        <p class="card-text mb-0 flex-grow-1"><b>{{ $observacao->created_at->format('d/m/y') }}</b> - <span data-obs-texto>{{ $observacao->observacao }}</span></p>

                        <div class="d-flex align-items-center gap-2 flex-shrink-0 obs-acoes">
                            {{-- Editar observação --}}
                            <button type="button" class="btn btn-link p-0 text-primary"
                                    data-obs-acao="editar"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#editar-obs-{{ $observacao->id }}"
                                    aria-expanded="false"
                                    aria-controls="editar-obs-{{ $observacao->id }}"
                                    title="Editar observação" aria-label="Editar observação">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>

                            {{-- Excluir observação --}}
                            <button type="button" class="btn btn-link p-0 text-danger"
                                    data-obs-acao="excluir"
                                    title="Excluir observação" aria-label="Excluir observação">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3.5a1 1 0 0 1 1 1zM6 1v1h4V1H6zm6 3H4v9a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Editor da observação --}}
                    <div class="collapse mt-2" id="editar-obs-{{ $observacao->id }}">
                        <textarea class="form-control" rows="3" data-obs-editor>{{ $observacao->observacao }}</textarea>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn-padrao btn-cadastrar mt-3" data-obs-acao="salvar">Salvar</button>
                            <button type="button" class="btn-padrao btn-cancelar mt-3"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#editar-obs-{{ $observacao->id }}"
                                    aria-expanded="true"
                                    aria-controls="editar-obs-{{ $observacao->id }}">Cancelar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.bloco-observacoes .obs-vazio {
    margin-bottom: 0;
}

.bloco-observacoes .obs-acoes .btn {
    line-height: 1;
    box-shadow: none;
}

.bloco-observacoes .obs-acoes .btn:hover {
    opacity: .7;
}
</style>

<script>
(function () {
    if (window.observacoesAjax) {
        return;
    }
    window.observacoesAjax = true;

    function token() {
        var el = document.querySelector('[data-obs-csrf]');

        return el ? el.textContent.trim() : '';
    }

    function fecharEditor(item) {
        var editor = item.querySelector('.collapse');

        if (!editor || !window.bootstrap || !bootstrap.Collapse) {
            return;
        }

        bootstrap.Collapse.getOrCreateInstance(editor, { toggle: false }).hide();
    }

    function ajustarSeparadores(lista) {
        var linhas = lista.querySelectorAll('[data-obs-linha]');

        linhas.forEach(function (linha, indice) {
            var ultima = indice === linhas.length - 1;

            linha.classList.toggle('border-bottom', !ultima);
            linha.classList.toggle('pb-2', !ultima);
            linha.classList.toggle('mb-2', !ultima);
        });

        var vazio = lista.querySelector('.obs-vazio');

        if (vazio) {
            vazio.classList.toggle('d-none', linhas.length > 0);
        }
    }

    async function enviar(url, metodo, dados) {
        var resposta = await fetch(url, {
            method: metodo,
            headers: {
                'X-CSRF-TOKEN': token(),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: dados ? JSON.stringify(dados) : undefined
        });

        var corpo = {};

        try {
            corpo = await resposta.json();
        } catch (erro) {
            corpo = {};
        }

        if (!resposta.ok) {
            var mensagem = corpo.message || 'Não foi possível concluir a operação.';

            if (corpo.errors) {
                var primeiroErro = Object.values(corpo.errors)[0];

                mensagem = Array.isArray(primeiroErro) ? primeiroErro[0] : mensagem;
            }

            throw new Error(mensagem);
        }

        return corpo;
    }

    document.addEventListener('click', async function (evento) {
        var botao = evento.target.closest('[data-obs-acao]');

        if (!botao) {
            return;
        }

        var item = botao.closest('[data-obs-item]');

        if (!item) {
            return;
        }

        var acao = botao.dataset.obsAcao;

        // O lápis só abre o editor (o collapse é do Bootstrap).
        if (acao === 'editar') {
            return;
        }

        var lista = item.closest('[data-obs-lista]');

        if (acao === 'salvar') {
            var editor = item.querySelector('[data-obs-editor]');
            var observacao = editor ? editor.value.trim() : '';

            if (!observacao) {
                alert('Escreva a observação.');

                return;
            }

            botao.disabled = true;

            try {
                var retorno = await enviar(item.dataset.obsUpdateUrl, 'PUT', { observacao: observacao });
                var texto = item.querySelector('[data-obs-texto]');

                if (texto) {
                    texto.textContent = retorno.observacao ? retorno.observacao.observacao : observacao;
                }

                fecharEditor(item);
            } catch (erro) {
                alert(erro.message);
            } finally {
                botao.disabled = false;
            }

            return;
        }

        if (acao === 'excluir') {
            if (!confirm('Tem certeza que deseja excluir esta observação?')) {
                return;
            }

            botao.disabled = true;

            try {
                await enviar(item.dataset.obsDeleteUrl, 'DELETE');

                item.remove();

                if (lista) {
                    ajustarSeparadores(lista);
                }
            } catch (erro) {
                alert(erro.message);

                botao.disabled = false;
            }
        }
    });
})();
</script>
