@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('resumes.index') }}">Currículos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Currículo: {{ $resume->informacoesPessoais->nome }} </li>
        </ol>
      </nav>


      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('resumes.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}


</section>

{{-- Botões Ação --}}
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                @if (!$resume->interview()->exists())
                    <!--<div class="box-entrevistar"> -->
                        <a href="{{ route('interviews.interviewResume', $resume) }}#form-interview"  class="link-entrevista d-flex align-items-center" >Iniciar Entrevista</a>
                    <!--</div>-->
                 @endif
            </div>
            @if(!$resume->jobs()->exists())
            <div class="col">
                 <!-- Button trigger modal -->
                <button type="button" class="btn-padrao btn-associar-vaga" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Associar a uma vaga
                </button>
                @include('components.modal-associar-vaga')
            </div>
            @endif


            {{-- @if (Auth::user()->role === 'admin') --}}
            <div class="col">

                <form action="{{ route('resumes.destroy', $resume) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-padrao btn-cancelar ms-3 d-flex align-items-center justify-content-center"
                            onclick="return confirm('Tem certeza que deseja deletar este currículo? Esta ação não pode ser desfeita.')"
                            id="delete-resume">
                        Deletar Currículo
                    </button>
                </form>

            </div>
            {{-- @endif --}}
        </div>
    </div>

</section>
{{-- Fim Botões Ação --}}


<section class="sessao">

    {{-- Sessão Edição Currículo --}}
    <article class="f1 container-form-create">

        <div class="container">

            <div class="row form-padrao">
                <div class="col-12 py-0 pe-5 form-1">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between mb-4">
                            <h4 class="fw-normal">Cadastro de Currículo</h4>


                            <p class="fw-bold">Data do cadastro: {{ $resume->created_at ? \Carbon\Carbon::parse($resume->created_at)->format('d/m/Y') : '—' }}</p>
                        </div>

                    </div>

                     {{-- Botão mudar status --}}
                     {{-- {{ dd($resume)}} --}}

                    <x-status-button :resume="$resume" :status="$resume->status" />
                            {{-- Fim Botão mudar status --}}
                    {{-- Botão mudar status --}}
                    {{-- <div class="col-9 bloco-ativo d-flex mb-3">
                        <h5>Status</h5>

                            <form id="statusForm" action="{{ route('resumes.updateStatus', $resume->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Campo hidden para armazenar o status -->
                                <input type="hidden" name="status" id="statusInput" value="{{ $resume->status }}">

                                <div class="btn-group">
                                    <!-- Botão principal que mostra o status atual -->
                                    <button type="button" class="btn
                                        @if($resume->status == 'ativo') status-ativo
                                        @elseif($resume->status == 'inativo') status-inativo
                                        @elseif($resume->status == 'processo') status-processo
                                        @elseif($resume->status == 'contratado') status-contratado
                                        @endif">
                                        {{ ucfirst($resume->status) }}
                                    </button>

                                    <!-- Botão do dropdown -->
                                    <button type="button" id="btn-dropdown-toggle" class="btn
                                        @if($resume->status == 'ativo') status-ativo
                                        @elseif($resume->status == 'inativo') status-inativo
                                        @elseif($resume->status == 'processo') status-processo
                                        @elseif($resume->status == 'contratado') status-contratado
                                        @endif
                                        dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                        <svg style="width: 13px;{{ $resume->status == 'processo'? 'fill:#000' : 'fill:#fff' }}" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 386.257 386.257" style="enable-background:new 0 0 386.257 386.257;" xml:space="preserve"><polygon points="0,96.879 193.129,289.379 386.257,96.879 "></polygon><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>                                            </button>

                                    <!-- Itens do dropdown -->
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item @if($resume->status == 'ativo') active status-ativo @endif"
                                            href="#" onclick="updateStatus('ativo')">Ativo</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item @if($resume->status == 'inativo') active status-inativo @endif"
                                            href="#" onclick="updateStatus('inativo')">Inativo</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item @if($resume->status == 'processo') active status-processo @endif"
                                            href="#" onclick="updateStatus('processo')">Em processo</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item @if($resume->status == 'contratado') active status-contratado @endif"
                                            href="#" onclick="updateStatus('contratado')">Contratado</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>

                    </div>
                     --}}
                    {{-- Fim Botão mudar status --}}


                    {{-- Formulário Edição Currículo --}}
                    <form class="form-padrao" id="form-companies-create" action="{{ route('resumes.update', $resume) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-resume-edit-form
                            :resume="$resume"
                            :academicData="$academicData"
                            :editResume="true"
                        />
                    </form>
                    {{-- Fim Formulário Edição Currículo --}}

                </div>

                 {{-- Formulário Observação Currículo --}}
                <div class="col-12 border-top py-0 ps-5 form-r bloco-obs pt-5">

                    <div class="row mb-3 mt-3 bloco-observacoes">

                        <div class="card">
                            <div class="card-header bg-transparent">
                            <p>Observações:</p>
                            </div>
                            <div class="card-body">
                                @if ($resume->observacoes->isNotEmpty())
                                    @foreach ($resume->observacoes->sortByDesc('created_at') as $observacao)
                                        <div class="d-flex justify-content-between align-items-start gap-3 {{ $loop->last ? '' : 'border-bottom pb-2 mb-2' }}">
                                            <p class="card-text mb-0 flex-grow-1"><b>{{ $observacao->created_at->format('d/m/y') }}</b> - {{ $observacao->observacao }}</p>

                                            <div class="d-flex align-items-center gap-2 flex-shrink-0 obs-acoes">
                                                {{-- Editar observação --}}
                                                <button type="button" class="btn btn-link p-0 text-primary"
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
                                                <form action="{{ route('resumes.deleteHistory', ['resume' => $resume->id, 'historyId' => $observacao->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta observação?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-danger" title="Excluir observação" aria-label="Excluir observação">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3.5a1 1 0 0 1 1 1zM6 1v1h4V1H6zm6 3H4v9a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Formulário de edição da observação --}}
                                        <div class="collapse mt-2" id="editar-obs-{{ $observacao->id }}">
                                            <form class="form-padrao" action="{{ route('resumes.updateHistory', ['resume' => $resume->id, 'historyId' => $observacao->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="observacao" id="observacao-{{ $observacao->id }}" class="form-control" rows="3" required>{{ $observacao->observacao }}</textarea>
                                                @error('observacao')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="d-flex gap-2">
                                                    <button class="btn-padrao btn-cadastrar mt-3" type="submit">Salvar</button>
                                                    <button class="btn-padrao btn-cancelar mt-3" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#editar-obs-{{ $observacao->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="editar-obs-{{ $observacao->id }}">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    Nenhuma observação.
                                @endif

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <form class="form-padrao d-flex justify-content-center" action="{{ route('resumes.storeHistory', $resume->id)}}" method="post">

                            @csrf
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Escreva sua observação</label>
                                <textarea name="observacao" id="observacao" class="form-control"></textarea>
                            </div>
                            <button class="btn-padrao btn-cadastrar mt-3" type="submit">Salvar</button>

                        </form>

                    </div>

                </div>
                {{-- Fim Formulário Observação Currículo --}}
            </div>

        </div>

    </article>
    {{-- Fim Sessão Edição Currículo --}}

    {{-- Componente Tabela Vagas Associadas --}}
    <x-resume-jobs-table :resume="$resume" />

    {{-- Fim Componente Tabela Vagas Associadas --}}


    {{-- Componente Tabela Processos Seletivos --}}
    <x-resume-selections-table :resume="$resume" />
    {{-- Fim Componente Tabela Processos Seletivos --}}

</section>

@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};




document.addEventListener("DOMContentLoaded", function () {


    // Upload Foto Candidato
    document.getElementById('foto_candidato').addEventListener('change', function(event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_foto_candidato').src = e.target.result; // Atualiza a imagem
        };
        reader.readAsDataURL(file);

    });



    // Upload Curriculo
    document.getElementById('file-upload').addEventListener('change', function (event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        // Verifica se o arquivo é um PDF
        if (file.type !== "application/pdf") {
            alert("Por favor, selecione um arquivo PDF.");
            event.target.value = ""; // Limpa o campo
            return;
        }

        // Atualiza a prévia do documento
        document.getElementById("file-name").textContent = file.name;
        document.getElementById("file-download").href = URL.createObjectURL(file);
        document.getElementById("preview-doc").style.display = "block";
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Função genérica para toggle
    function toggleVisibility(checkboxId, containerSelector) {
        const checkbox = document.getElementById(checkboxId);
        const container = document.querySelector(containerSelector);

        if (checkbox && container) {
            // Define o estado inicial
            container.style.display = checkbox.checked ? 'block' : 'none';

            // Adiciona o listener
            checkbox.addEventListener('change', function() {
                container.style.display = this.checked ? 'block' : 'none';
            });
        }
    }

    // Aplica para cada caso
    toggleVisibility('escolaridade5', '#fundamentalCursandoContainer');
    toggleVisibility('escolaridade1', '#medioCursandoContainer'); // Médio Cursando
    toggleVisibility('escolaridade6', '#tecnicoCompletoContainer');
    toggleVisibility('escolaridade7', '#tecnicoCursandoContainer');
    toggleVisibility('escolaridade8', '#superiorCompletoContainer');
    toggleVisibility('escolaridade9', '#superiorCursandoContainer');
    toggleVisibility('escolaridade3', '.check-escolaridade'); // Outro
});







$('#uf').select2({
    placeholder: "Selecione",
});
$('#estado_civil').select2({
    placeholder: "Selecione",
});
$('#possui_filhos').select2({
    placeholder: "Selecione",
});
$('#sexo').select2({
    placeholder: "Selecione",
});
$('#cnh').select2({
    placeholder: "Selecione",
});
$('#tipo_cnh').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});
$('#tamanho_uniforme').select2({
    placeholder: "Selecione",
});
$('#nacionalidade').select2({
    placeholder: "Selecione",
});
$('#pcd').select2({
    placeholder: "Selecione",
});
$('#reservista').select2({
    placeholder: "Selecione",
});

// $('#fundamental_periodo').select2({
//     placeholder: "Selecione",
// });
// $('#medio_periodo').select2({
//     placeholder: "Selecione",
// });
// $('#tecnico_periodo').select2({
//     placeholder: "Selecione",
// });

// $('#superior_periodo').select2({
//     placeholder: "Selecione",
// });

$('#fundamental_select_periodo, #fundamental_select_modalidade, #medio_select_periodo, #medio_select_modalidade, #tecnico_select_periodo, #tecnico_select_modalidade, #superior_select_periodo, #superior_select_modalidade, #outro_select_periodo, #outro_select_modalidade ').select2({
    placeholder: "Selecione",
});

$('#rg').mask('00.000.000-A');
$('#cpf').mask('000.000.000-00');
$('#cep').mask('00000-000');
$('#telefone_celular').mask('(00) 00000-0000');
$('#telefone_residencial').mask(SPMaskBehavior, spOptions);

$('#cep').on('input', function(){

    var cep     = $(this).val(),
        digitos = cep.length;

    if(digitos === 9){

        $('.fa-spinner').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url : "{{ url('getCep') }}",
            data : {'cep': cep},
            type : 'POST',
            dataType : 'json',
            success : function(result){

                $('.fa-spinner').hide();

                if(result.msg === '1'){

                    $('#cidade').val(result.cidade);
                    $('#bairro').val(result.bairro);
                    $('#uf').val(result.uf).select2();
                    $('#logradouro').val(result.rua);

                    setTimeout(function(){
                        $('.floatlabel').trigger('change');
                    }, 150)

                } else if(result.msg === '3'){

                    $.message('CEP enválido, por favor verifique o número informado', 2);

                } else {

                    $.message('CEP não encontrado, por favor verifique o número informado', 2);

                }

            }
        });

    }

});

$('#escolaridade3').on('click', function(){

    if($(this).is(':checked')){
        $('.check-escolaridade').slideDown(150);
        $('#escolaridade_outro').prop('disabled', false);
    } else {
        $('.check-escolaridade').slideUp(150);
        $('#escolaridade_outro').prop('disabled', true);
    }

});

$('#experiencia_profissional10').on('click', function(){

    console.dir('aaa');

    if($(this).is(':checked')){
        $('.check-experiencia').slideDown(150);
        $('#experiencia_profissional_outro').prop('disabled', false);
    } else {
        $('.check-experiencia').slideUp(150);
        $('#experiencia_profissional_outro').prop('disabled', true);
    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        // escolaridade:"required",
        // nome:"required",
        // email:"required",
        // rg:"required",
        // cpf:"required",
        // telefone_celular:"required",
        // telefone_residencial:"required",
        // nome_contato:"required",
        // data_nascimento:"required",
        // estado_civil:"required",
        // possui_filhos:"required",
        // sexo:"required",
        // cnh:"required",
        // cep:"required",
        // logradouro:"required",
        // numero:"required",
        // complemento:"required",
        // bairro:"required",
        // cidade:"required",
        // uf:"required",
        // informatica:"required",
        // ingles:"required",
        // tamanho_uniforme:"required",
    }
});

// Validação inicial
var validator = $( ".form-padrao" ).validate();
validator.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})


// Atualização de status
function updateStatus(newStatus) {
    const statusInput = document.getElementById('statusInput');

    // Se for mudar para inativo, pede confirmação especial
    if (newStatus === 'inativo') {
        if (!confirm("Se o currículo estiver associado a alguma vaga, será automaticamente desassociado. Deseja continuar?")) {
            return false; // Cancela se o usuário não confirmar
        }
    }

    // Atualiza o valor do campo hidden
    statusInput.value = newStatus;

    // Envia o formulário
    document.getElementById('statusForm').submit();

    return true;
}


</script>
@endpush

@push('css-custom')
<style>
/*Botãos submit e cancelar*/
.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.link-entrevista{
    margin-bottom: 15px;
    padding: 10px 30px;
    background-color: #ff9d0a;
    color: #fff;
    border-radius: 30px;
    transition: ease-in-out all 0.5s;
}

.link-entrevista:hover{
    background-color: #ffab2e;
    color: #fff;
}

.table-container.lista-processos-seletivos .col4,
.table-container.lista-processos-seletivos .col5{
    width: 10%;
}

.table-container.lista-processos-seletivos .col6{
    width: 5%;
}

.form-padrao .bloco-obs .bloco-observacoes .card-text{
    font-size: 15px !important;
    color: #333 !important;
    font-weight: 400 !important;
}

.form-padrao .bloco-obs .bloco-observacoes .card-text b{
    font-size: 13px !important;
    color: #287FC0 !important;
    font-weight: bold !important;
}

.form-padrao .bloco-obs .bloco-observacoes .obs-acoes .btn{
    line-height: 1;
    box-shadow: none;
}

.form-padrao .bloco-obs .bloco-observacoes .obs-acoes .btn:hover{
    opacity: .7;
}


.status-ativo,
.status-ativo:hover{
color: #fff;
background-color: gray !important;
}

.status-ativo.dropdown-toggle-split:hover{
color: #fff;
background-color: rgb(94, 94, 94) !important;
}



.status-processo,
.status-processo:hover {
    color: #000;
background-color: yellow !important;
}
.status-processo.dropdown-toggle-split:hover{
color: #fff;
background-color: rgb(228, 228, 0) !important;
}

.status-contratado,
.status-contratado:hover{
    color: #fff;
background-color: green !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;
background-color: rgb(0, 105, 0) !important;
}


.status-inativo,
.status-inativo:hover{
    color: #fff;
    background-color: red !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;
background-color: rgb(225, 0, 0) !important;
}


.dropdown-menu.show{
    z-index: 9999;
}

.status-aberta{
    background-color: #ffff00 !important;
}
.status-fechada{
    background-color: #008000 !important;
}
.status-espera{
    background-color: #808080 !important;
}
.status-cancelada{
    background-color: #ff0000 !important;
}


</style>
@endpush
