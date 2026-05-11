 <article class="f1">

        <h4>Processos Seletivos</h4>        

        <div class="table-container lista-processos-seletivos">

            <ul class="tit-lista">
                <li class="col1">Empresa</li>
                <li class="col2">Título</li>
                <li class="col3">Vagas</li>
                <li class="col4">Seleção</li>
                <li class="col5">Associador</li>
                <li class="col5">Recrutador</li>
                <li class="col6">Status</li>
                @if (Auth::user()->role == 'admin')
                    <li class="col7">Ações</li>
                @endif
            </ul>

            {{-- @if ($selections) --}}

            {{-- Job Aprovado --}}
                @if ($jobAprovado)

                    {{-- Empresa selação aprovada --}}
                    @php
                    $selection = $resume->selections->where('job_id', $jobAprovado->id)->first();
                    
                    @endphp

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-{{$jobAprovado->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="col1">
                            @if ($jobAprovado->company->logotipo)
                                <b>Empresa</b>
                                @if (file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" alt="{{ $jobAprovado->company->nome_fantasia }}" title="{{ $jobAprovado->company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $jobAprovado->company->nome_fantasia }}</strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            {{ $jobAprovado->setor }}
                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{ $jobAprovado->filled_positions }} / {{ $jobAprovado->qtd_vagas }}
                        </li>
                        <li class="col4">
                            <b>Status da Seleção</b>
                            {{ $selection->status_selecao == 'aprovado' ? 'Contratado' : $selection->status_selecao }}
                        </li>
                        <li class="col5">
                             <b>Associador</b>
                             @if ($jobAprovado->recruiters()->exists())
                             {{-- @if (count($jobAprovado->recruiters) <= 0) --}}
                                @foreach ($jobAprovado->recruiters as $recruiter)                            
                                    {{-- pivot->associator retorna o User que fez a associação --}}
                                    {{ $recruiter->pivot->associator?->name ?? '—' }}                                    
                                @endforeach
                            @endif
                        </li>
                        <li class="col5">
                            <b>Recrutador</b>
                            @if ($jobAprovado->recruiters()->exists())                              
                            
                            {{-- @if (count($jobAprovado->recruiters) <= 0) --}}
                            Nenhum recrutador associado
                            @else
                            @foreach ($jobAprovado->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col6">
                            <b>Status</b>
                            <button disabled="disabled" class="btn btn-success">Contratado</button>
                        </li>

                    </ul>

                    <!-- Modal Seleção aprovado -->
                    <div class="modal fade modal-vagas" id="modal-selection-{{$jobAprovado->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº {{ $jobAprovado->id}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

                                                <ul>
                                                    <li class="col1">
                                                        @if ($jobAprovado->company->logotipo)
                                                            <b>Empresa</b>
                                                            @if (file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo)))
                                                                <img src="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" alt="{{ $jobAprovado->company->nome_fantasia }}" title="{{ $jobAprovado->company->nome_fantasia }}">
                                                            @else
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$jobAprovado->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            @endif
                                                        @else
                                                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                        @endif
                                                        <span>
                                                            <strong>{{ $jobAprovado->company->nome_fantasia }}</strong>
                                                        </span>
                                                    </li>
                                                    <li class="col2">
                                                        <b>Setor</b>
                                                        {{ $jobAprovado->setor }}
                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        {{ $jobAprovado->filled_positions }} / {{ $jobAprovado->qtd_vagas }}
                                                        @if ($jobAprovado->filled_positions >= $jobAprovado->qtd_vagas)
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        @endif
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        @if (count($jobAprovado->recruiters) <= 0)
                                                            Nenhum recrutador associado
                                                        @else
                                                            @foreach ($jobAprovado->recruiters as $recruiter)
                                                            {{ $recruiter->name }}
                                                            @endforeach
                                                        @endif
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>                                           
                                            
                                            @php
                                                $selection = $resume->selections->where('job_id', $jobAprovado->id)->first();
                                            @endphp

                                                <form class="form-padrao d-flex" action="{{ route('selections.updateSelection', $selection->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="job_id" value="{{$jobAprovado->id}}">
                                                    <input type="hidden" name="resume_id" value="{{$resume->id}}">
                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aguardando" {{ $selection->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                    <option value="aprovado" {{ $selection->status_selecao == 'aprovado' ? 'selected' : '' }} > Aprovado</option>
                                                                    <option value="reprovado" {{ $selection->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                    <option value="desistente" {{ $selection->status_selecao == 'desistente' ? 'selected' : '' }}> Desistente</option>
                                                                    <option value="cancelada" {{ $selection->status_selecao == 'cancelada' ? 'selected' : '' }}> Vaga Cancelada</option>                                                                    
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option value="0" {{$selection->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                    <option value="1" {{ $selection->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selection->observacao }}</textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        {{-- <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit" {{ $selecao->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button> --}}
                                                        <button class="btn btn-primary" type="submit">Atualizar</button>

                                                    </div>

                                                </form>
                                            {{-- @endif --}}

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    {{-- Fim selação aprovada --}}

                  
                    {{-- Job Aprovado --}}
                @endif

                {{-- {{ dd($selections) }} --}}
                <hr>
                @foreach ($selections as $selecao)               
                    

                        <ul @if ($jobAprovado && $selecao->job->id == $jobAprovado->id) style="display:none;"@endif  data-bs-toggle="modal" data-bs-target="#modal-selection-{{$selecao->job->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                            <li class="col1">
                                @if ($selecao->job->company->logotipo)
                                    <b>Empresa</b>
                                    @if (file_exists(public_path('documents/companies/images/'.$selecao->job->company->logotipo)))
                                        <img src="{{ asset("documents/companies/images/{$selecao->job->company->logotipo}") }}" alt="{{ $selecao->job->company->nome_fantasia }}" title="{{ $selecao->job->company->nome_fantasia }}">
                                    @else
                                        <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$selecao->job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                    @endif
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                                <span>
                                    <strong>{{ $selecao->job->company->nome_fantasia }}</strong>
                                </span>
                            </li>
                            <li class="col2">
                                <b>Título</b>
                                {{ $selecao->job->setor }}
                            </li>
                            <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                <b>Vagas</b>
                                {{$selecao->job->filled_positions}} / {{ $selecao->job->qtd_vagas }}
                            </li>
                            <li class="col4">
                                    <b>Status da Seleção</b>
                                    {{ $selecao->status_selecao == 'aprovado' ? 'Contratado' : $selecao->status_selecao }}
                                </li>                               

                            <li class="col5">
                                <b>Associador</b>
                                @if($selecao->job->recruiters()->exists())
                                
                                    @foreach ($selecao->job->recruiters as $recruiter)                            
                                        {{-- pivot->associator retorna o User que fez a associação --}}
                                        {{ $recruiter->pivot->associator?->name ?? '—' }}                                    
                                    @endforeach
                                @endif
                            </li>
                            <li class="col5">
                                <b>Recrutador</b>
                                @if($selecao->job->recruiters()->exists())
                                Nenhum recrutador associado
                                @else
                                @foreach ($selecao->job->recruiters as $recruiter)
                                {{ $recruiter->name }}
                                @endforeach
                                @endif
                            </li>
                            <li class="col6">                            

                                <b>Status</b>
                               
                                  @switch($selecao->status_selecao)
                                    @case('reprovado')
                                            @if ($selecao->avaliacao == 0)
                                                <i class="status-ativo" title="Inativo"></i>Reprovado - Avaliação Negativa        
                                            @else
                                                <i class="status-ativo" title="Disponível"></i>Reprovado - Avaliação Positiva                                                
                                            @endif
                                        @break
                                    @case('aguardando')
                                        <i class="status-ativo" title="Disponível"></i>Disponível - Aguardando
                                        @break
                                    @case('desistente')
                                        <i class="status-ativo" title="Disponível"></i>Disponível - Desistente
                                        @break
                                    @case('contratado')
                                        <i class="status-contratado" title="Contratado"></i>Contratado
                                        @break          
                                    @case('cancelada')
                                        <i class="status-inativo" title="Inativo"></i>Disponível - Vaga Cancelada
                                        @break                  
                                        
                                @endswitch 


                            </li>
                            @if (Auth::user()->role == 'admin')
                            <li class="col7">
                                <b>Ações</b>
                                <div class="d-flex gap-2">
                                    {{-- Ação para deletar uma seleção --}}
                                    <form action="{{ route('selections.deleteSelection', $selecao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta seleção?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:36px; height:36px;" data-bs-toggle="tooltip" title="Desfazer Seleção" aria-label="Desfazer Seleção">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" aria-hidden="true">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h3.5a1 1 0 0 1 1 1zM6 1v1h4V1H6zm6 3H4v9a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @endif

                        </ul>

                        <!-- Modal -->
                        <div class="modal fade modal-vagas" id="modal-selection-{{$selecao->job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4>Vaga - Nº {{ $selecao->job->id}}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-12">

                                                <div class="table-container lista-info-vaga">

                                                    <ul>
                                                        <li class="col1">
                                                            @if ($selecao->job->company->logotipo)
                                                                <b>Empresa</b>
                                                                @if (file_exists(public_path('documents/companies/images/'.$selecao->job->company->logotipo)))
                                                                    <img src="{{ asset("documents/companies/images/{$selecao->job->company->logotipo}") }}" alt="{{ $selecao->job->company->nome_fantasia }}" title="{{ $selecao->job->company->nome_fantasia }}">
                                                                @else
                                                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$selecao->job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                                @endif
                                                            @else
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            @endif
                                                            <span>
                                                                <strong>{{ $selecao->job->company->nome_fantasia }}</strong>
                                                            </span>
                                                        </li>
                                                        <li class="col2">
                                                            <b>Setor</b>
                                                            {{ $selecao->job->setor }}
                                                        </li>
                                                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                            <b>Vagas</b>
                                                            {{$selecao->job->filled_positions}} / {{ $selecao->job->qtd_vagas }}
                                                            @if ($selecao->job->filled_positions >= $selecao->job->qtd_vagas)
                                                                <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                            @endif
                                                        </li>
                                                        <li class="col4">
                                                            <b>Recrutador</b>
                                                            @if (count($selecao->job->recruiters) <= 0)
                                                                Nenhum recrutador associado
                                                            @else
                                                                @foreach ($selecao->job->recruiters as $recruiter)
                                                                {{ $recruiter->name }}
                                                                @endforeach
                                                            @endif
                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <h4>Processo Seletivo</h4>

                                                    <form class="form-padrao d-flex" action="{{ route('selections.updateSelection', $selecao->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="job_id" value="{{$selecao->job->id}}">
                                                        <input type="hidden" name="resume_id" value="{{$resume->id}}">

                                                        <div class="col-6">

                                                            <div class="mb-3 col-12">

                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                    <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                        <option value="aprovado" {{ $selecao->status_selecao == 'aprovado' ? 'selected' : '' }} > Contratado</option>
                                                                        <option value="reprovado" {{ $selecao->status_selecao == 'reprovado' ? 'selected' : '' }} > Reprovado</option>
                                                                        <option value="aguardando" {{ $selecao->status_selecao == 'aguardando' ? 'selected' : '' }}> Aguardando</option>
                                                                        <option value="desistente" {{ $selecao->status_selecao == 'desistente' ? 'selected' : '' }}> Desistente</option>
                                                                        <option value="cancelada" {{ $selecao->status_selecao == 'cancelada' ? 'selected' : '' }}> Vaga Cancelada</option>                                                                    
                                                                        {{-- <option value="Fila de Espera" {{ $selecao->status_selecao == 'Fila de Espera' ? 'selected' : '' }}> Fila de Espera</option> --}}
                                                                    </select>
                                                                    @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-12">

                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                    <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                        <option value="0" {{$selecao->avaliacao == 0 ? 'selected' : '' }} > Negativa</option>
                                                                        <option value="1" {{ $selecao->avaliacao == 1 ? 'selected' : ''}}> Positiva</option>
                                                                    </select>
                                                                    @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-6">

                                                            <div class="floatlabel-wrapper form-textarea">
                                                                <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observação</label>
                                                                <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ $selecao->observacao }}</textarea>
                                                                @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12 d-flex justify-content-center">

                                                            {{-- <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit" {{ $selection->status_selecao == 'aprovado' ? 'disabled' : ''}}>Atualizar</button> --}}
                                                            <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Atualizar</button>

                                                        </div>

                                                        {{-- <button class="btn btn-primary" type="submit">Atualizar</button> --}}

                                                    </form>
                                                {{-- @endif --}}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    {{-- @endif --}}

                @endforeach              


        </div>

    </article>


@push('css-custom')
    
<style>

.lista-processos-seletivos ul .col1{
width: 30% !important;
}

.lista-processos-seletivos ul .col2{
width: 20% !important;
}
.lista-processos-seletivos ul .col3{
width: 5% !important;
}
.lista-processos-seletivos ul .col4{
width: 10% !important;
}
.lista-processos-seletivos ul .col5{
width: 10% !important;
}
.lista-processos-seletivos ul .col6{
width: 10% !important;
}


.lista-info-vaga ul li.col1{
width: 100% !important;
border-right: none !important;
}

.lista-info-vaga ul li.col2{
width: 33% !important;
border-bottom: none !important;
border-right: 1px solid #dedede;
}
.lista-info-vaga ul li.col3{
width: 33% !important;
}
.lista-info-vaga ul li.col4{
width: 33% !important;
}




</style>
@endpush