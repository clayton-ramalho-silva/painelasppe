<!-- Bootstrap Modal -->
<div class="modal fade" id="jobResumesModal-{{ $job->id }}" tabindex="-1" aria-labelledby="jobResumesModalLabel-{{ $job->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="modal-title" id="jobResumesModalLabel-{{ $job->id }}">Candidatos Selecionados - {{ $job->cargo }}</h5>                
                        </div>
                        <div class="col-5">
                            <div class="buscar">
                                <form class="formulario">
                                    <input type="text" placeholder="Buscar">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="btFiltros filtros">
                                <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                </figure>
                                <span>Filtros</span>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="modal-body">
                <div class="container-fluid tabela-modal">
                    <!-- Cabeçalho da "tabela" -->
                    <div class="row p-2 tabela-modal-header">
                      <div class="col-3">Nome</div>
                      <div class="col-4">Email</div>
                      <div class="col-4">Telefone</div>
                      <div class="col-1">Ações</div>
                    </div>
          
                    @if ($resumes->count() > 0)
                        @foreach ($resumes as $resume)
                            <!-- Linha 1 -->
                            <div class="row p-2 tabela-modal-linha">
                      
                                <div class="col-3">{{ $resume->informacoesPessoais->nome }}</div>
                                <div class="col-4">{{ $resume->contato->email }}</div>
                                <div class="col-4">{{ $resume->contato->telefone_residencial }}</div>
                                <div class="col-1">
                                    <a href="{{route('resumes.edit', $resume->id) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar currículo">
                                        <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                                .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;}
                                            </style>
                                            <polyline class="st0" points="19,3 19,9 25,9 19,3 7,3 7,29 25,29 25,22.7 "></polyline>
                                            <circle class="st0" cx="21" cy="19" r="2"></circle>
                                            <line class="st0" x1="25" y1="9" x2="25" y2="15"></line>
                                            <path class="st0" d="M29,19c0,0-3.6,5-8,5s-8-5-8-5s3.6-5,8-5S29,19,29,19z"></path>
                                            </svg>
                                        </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhum candidato selecionado para esta vaga.</p>
                    @endif          
                    
                  </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
