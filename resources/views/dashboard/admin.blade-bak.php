@extends('layouts.app')

@section('content')
<section class="cabecario">
    <h1>Dashboard - Admin</h1>

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


    <article class="f4 resumo" onclick="window.location='{{ route('companies.index') }}'" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver todas as empresas">

        <figure>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g>
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path>
                    </g>
                </svg>


            <figcaption>
                Empresas <span>ativas</span>
            </figcaption>
        </figure>

        <h3>{{ $totalEmpresasAtivas }}</h3>

        <small><b>{{ $totalEmpresasInativas }} empresas</b> inativas</small>

    </article>



    <article class="f4 resumo" onclick="window.location='{{ route('jobs.index') }}'" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver todas as vagas">

        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g id="_21-30" data-name="21-30"><g id="Document"><path d="M25.535,6.121,22.879,3.465A4.969,4.969,0,0,0,19.343,2H10A5.006,5.006,0,0,0,5,7V25a5.006,5.006,0,0,0,5,5H22a5.006,5.006,0,0,0,5-5V9.657A4.969,4.969,0,0,0,25.535,6.121ZM24.121,7.535A3.042,3.042,0,0,1,24.5,8H22a1,1,0,0,1-1-1V4.5a3.042,3.042,0,0,1,.465.38ZM22,28H10a3,3,0,0,1-3-3V7a3,3,0,0,1,3-3h9V7a3,3,0,0,0,3,3h3V25A3,3,0,0,1,22,28Z"></path><path d="M11,11h4a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Z"></path><path d="M21,13H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M21,17H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M19,21H11a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z"></path></g></g></svg>


            <figcaption>
                Vagas <span>totais</span>
            </figcaption>
        </figure>

        <h3>{{ $totalJobs }}</h3>

        <small><b>20 vagas</b> inativas</small>

    </article>

    <article class="f4 resumo" onclick="window.location='{{ route('companies.index') }}'" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver vagas abertas">

        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g id="_21-30" data-name="21-30"><g id="Document"><path d="M25.535,6.121,22.879,3.465A4.969,4.969,0,0,0,19.343,2H10A5.006,5.006,0,0,0,5,7V25a5.006,5.006,0,0,0,5,5H22a5.006,5.006,0,0,0,5-5V9.657A4.969,4.969,0,0,0,25.535,6.121ZM24.121,7.535A3.042,3.042,0,0,1,24.5,8H22a1,1,0,0,1-1-1V4.5a3.042,3.042,0,0,1,.465.38ZM22,28H10a3,3,0,0,1-3-3V7a3,3,0,0,1,3-3h9V7a3,3,0,0,0,3,3h3V25A3,3,0,0,1,22,28Z"></path><path d="M11,11h4a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Z"></path><path d="M21,13H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M21,17H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M19,21H11a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z"></path></g></g></svg>


            <figcaption>
                Vagas <span>abertas</span>
            </figcaption>
        </figure>

        <h3>{{ $openJobs }}</h3>

        <small><b>20 vagas</b> concluidas</small>

    </article>

    <article class="f4 resumo" onclick="window.location='{{ route('resumes.index') }}'" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver todos currÃ­culos">

        <figure>
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <defs>
                <style>
                    .cls-1 {
                        fill: #000;
                        stroke-width: 0px;
                    }
                </style>
            </defs>
            <path class="cls-1" d="M39.544,10.124l-6.62-6.651c-.931-.936-2.223-1.473-3.544-1.473H12c-2.757,0-5,2.243-5,5v34c0,2.757,2.243,5,5,5h24c2.757,0,5-2.243,5-5V13.651c0-1.331-.517-2.583-1.456-3.527ZM37.594,11h-4.594c-.551,0-1-.449-1-1v-4.62l5.594,5.62ZM39,41c0,1.654-1.346,3-3,3H12c-1.654,0-3-1.346-3-3V7c0-1.654,1.346-3,3-3h17.38c.209,0,.417.025.62.069v5.931c0,1.654,1.346,3,3,3h5.923c.047.212.077.429.077.651v27.349Z"></path>
            <path class="cls-1" d="M34,19h-6c-.552,0-1,.448-1,1s.448,1,1,1h6c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,25H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,31H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,37H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M16,22h6c1.654,0,3-1.346,3-3,0-2.282-1.546-4.191-3.639-4.788.989-.729,1.639-1.892,1.639-3.212,0-2.206-1.794-4-4-4s-4,1.794-4,4c0,1.32.65,2.483,1.639,3.212-2.093.597-3.639,2.506-3.639,4.788,0,1.654,1.346,3,3,3ZM19,9c1.103,0,2,.897,2,2s-.897,2-2,2-2-.897-2-2,.897-2,2-2ZM18,16h2c1.654,0,3,1.346,3,3,0,.551-.449,1-1,1h-6c-.551,0-1-.449-1-1,0-1.654,1.346-3,3-3Z"></path>
        </svg>

            <figcaption>
                Curr&iacute;culos <span>dispon&iacute;veis</span>
            </figcaption>
        </figure>

        <h3>{{ $totalResumes }}</h3>

        <small><b>198 curr&iacute;culos</b> inativos</small>

    </article>



    <article class="f2-1">
        <h4>Vagas abertas</h4>

        <table class="table table-borderless">
            <thead>
                <tr>


                    <th>Empresa</th>
                    <th>Cargo</th>
                    <!--<th>Cidade</th>-->
                    <th>
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Vagas DisponÃ­vel/Preenchidas">
                            Vagas
                          </span>
                    </th>
<!--                    <th>
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Candidatos Selecionados">
                            Candi. Selec.
                          </span>
                    </th>-->
                    <th>Status</th>
<!--                    <th>Data Aber.</th>
                    <th>Data Ini.</th>
                    <th>Data Fech.</th>-->
                    <th>Recrutador</th>
                    <!--<th>Obs.:</th>-->
                    {{--<th style="text-align: center">A&ccedil;&otilde;es</th>--}}
                </tr>
            </thead>
            <tbody>
                @if ($jobs->count() > 0)
                    @foreach ($jobs as $job)
                        <tr onclick="window.location='{{ route('jobs.edit', $job) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Vaga">
                            <td class="ico-v">

                                @if ($job->company->logotipo)
                                    <img src="{{ asset("documents/companies/images/{$job->company->logotipo}")}}" alt="" width="50" height="auto" class="rounded-circle me-2">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                                {{ $job->company->nome_fantasia }}
                            </td>
                            <td>{{ $job->cargo }}</td>

                            <td>{{ $job->filled_positions }}/{{$job->qtd_vagas}}</td>
<!--                            <td>
                                <a href="#" class="btn btn-info btn-sm text-light" data-bs-toggle="modal" data-bs-target="#jobResumesModal-{{ $job->id }}">
                                    {{ $job->resumes->count()}}

                                </a>
                            </td>-->
                            <td>{{ $job->status }}</td>

                            <td>
                                @if (count($job->recruiters) <= 0)
                                    Nenhum recrutador associado
                                @else
                                    @foreach ($job->recruiters as $recruiter)
                                        {{ $recruiter->name }}
                                    @endforeach
                                @endif
                            </td>
                            {{--
                            <td class="m-actions">
                                <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais InformaÃ§Ãµes">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-{{ $job->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><g><path d="m64.5,122.6c32,0 58-26 58-58s-26-58-58-58-58.1,26-58.1,58 26.1,58 58.1,58zm0-108c27.5,5.32907e-15 49.9,22.4 49.9,49.9s-22.4,49.9-49.9,49.9-49.9-22.4-49.9-49.9 22.4-49.9 49.9-49.9z"></path><path d="m54.8,90.1c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1h26.9c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-9.4v-36.1c0-2.3-1.8-4.1-4.1-4.1h-13.4c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h9.4v32h-9.4z"></path> <circle cx="62.7" cy="36.5" r="6.6"></circle> </g> </g></svg>

                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-{{ $job->id }}">
                                        <b>Cidade: </b>{{ $job->cidade }}<br><br>
                                        <b><a href="#" data-bs-toggle="modal" data-bs-target="#jobResumesModal-{{ $job->id }}">Candidatos Selecionados: </b>{{ $job->resumes->count()}}</a><br><br>
                                        <b>Data Abertura: </b>{{ $job->created_at->format('d/m/Y') }}<br><br>
                                        <b>Data Inicio: </b>0<br><br>
                                        <b>Data Fechamento: </b>0<br><br>

                                        <b>ObservaÃ§Ãµes: </b>
                                        @if ( count($job->observacoes) > 0)
                                            {{ str( $job->observacoes()->orderBy('created_at', 'desc')->first()->observacao )->limit(10, '...') }}
                                        @else
                                            Nenhuma.
                                        @endif



                                    </div>

                                </span>

                                <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir aÃ§Ãµes">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuActions-{{ $job->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                <circle cx="2" cy="8" r="2"></circle>
                                                <circle cx="8" cy="8" r="2"></circle>
                                                <circle cx="14" cy="8" r="2"></circle>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuActions-{{ $job->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                        <a class="editAqui" href="{{route('jobs.edit', $job) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>
                                    </div>



                                </span>
                            </td>
                            --}}
                        </tr>
                        <!-- Componente de Modal para cada Job -->
                        <x-job-resume-modal :jobId="$job->id" />
                    @endforeach
                @else
                    <tr><p>Nenhuma vaga Cadastrada!</p></tr>
                @endif
            </tbody>
        </table>
    </article>


    <article class="f1-2 b-Blue">
        <h4>CurrÃ­culos Recentes</h4>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Nome</th>
                    {{--<th>AÃ§Ãµes</th>--}}
                </tr>
            </thead>
            <tbody>
                @if ($resumes->count() > 0)
                    @foreach ($resumes as $resume)
                    <tr onclick="window.location='{{ route('resumes.edit', $resume) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar CurrÃ­culo">
                            <td class="ico-v">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title></title><g id="User"><path d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z"></path></g></svg>
                                {{ $resume->informacoesPessoais->nome }}
                            </td>

                              {{--
                            <td class="m-actions">

                                <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir aÃ§Ãµes">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuResumeActions-{{ $resume->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                            <circle cx="2" cy="8" r="2"></circle>
                                            <circle cx="8" cy="8" r="2"></circle>
                                            <circle cx="14" cy="8" r="2"></circle>
                                    </svg>
                                    </button>


                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuResumeActions-{{ $job->id }}">
                                        <a href="{{ route('resumes.edit', $resume) }}" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>
                                        <form action="{{ route('resumes.destroy', $resume) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                            </svg></button>
                                        </form>

                                        @if ($resume->interview)
                                            <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                                        @else
                                            <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">NÃ£o</a>
                                        @endif


                                        @if (!$resume->interview)
                                            <form action="{{ route('interviews.interviewResume') }}" method="get" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="resume_id" value="{{ $resume->id}}">
                                                <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Entrevistar"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                                    <defs>
                                                      <style>
                                                        .cls-1 {
                                                          fill: #000;
                                                          stroke-width: 0px;
                                                        }
                                                      </style>
                                                    </defs>
                                                    <path class="cls-1" d="M38.044,29.161c1.766-1.046,2.956-2.965,2.956-5.161,0-3.309-2.691-6-6-6s-6,2.691-6,6c0,2.197,1.19,4.116,2.956,5.161-2.207.464-4.057,1.9-5.084,3.839h-1.872v-3.5c0-3.606-2.559-6.625-5.956-7.339,1.766-1.046,2.956-2.965,2.956-5.161,0-3.309-2.691-6-6-6s-6,2.691-6,6c0,2.197,1.19,4.116,2.956,5.161-3.397.714-5.956,3.732-5.956,7.339v3.5h-1c-1.103,0-2,.897-2,2v2c0,.737.405,1.375,1,1.722v5.278c0,1.103.897,2,2,2h34c1.654,0,3-1.346,3-3v-6.5c0-3.606-2.559-6.625-5.956-7.339ZM35,20c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4ZM16,13c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4ZM9,29.5c0-3.033,2.467-5.5,5.5-5.5h3c3.033,0,5.5,2.467,5.5,5.5v3.5h-14v-3.5ZM6,35h20.151c-.099.485-.151.986-.151,1.5v.5H6v-2ZM7,39h19v4c0,.352.072.686.184,1H7v-5ZM42,43c0,.551-.449,1-1,1h-12c-.551,0-1-.449-1-1v-6.5c0-3.033,2.467-5.5,5.5-5.5h3c3.033,0,5.5,2.467,5.5,5.5v6.5Z"></path>
                                                    <path class="cls-1" d="M41,2h-11c-1.654,0-3,1.346-3,3v5.333c0,.215-.071.428-.2.6l-2,2.667c-.343.458-.397,1.059-.141,1.57.255.512.77.829,1.341.829h15c1.654,0,3-1.346,3-3V5c0-1.654-1.346-3-3-3ZM42,13c0,.551-.449,1-1,1h-14l1.4-1.867c.387-.516.6-1.155.6-1.8v-5.333c0-.551.449-1,1-1h11c.551,0,1,.449,1,1v8Z"></path>
                                                    <path class="cls-1" d="M39,6h-7c-.552,0-1,.448-1,1s.448,1,1,1h7c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
                                                    <path class="cls-1" d="M37,10h-5c-.552,0-1,.448-1,1s.448,1,1,1h5c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
                                                  </svg></button>
                                            </form>

                                        @else

                                            <a href="{{ route('interviews.show', $resume->interview->id) }}" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visualizar entrevista"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 49H24C24.2652 49 24.5196 48.8946 24.7071 48.7071C24.8946 48.5196 25 48.2652 25 48V44C25 42.6739 24.4732 41.4021 23.5355 40.4645C22.5979 39.5268 21.3261 39 20 39H10C8.67392 39 7.40215 39.5268 6.46447 40.4645C5.52678 41.4021 5 42.6739 5 44V48C5 48.2652 5.10536 48.5196 5.29289 48.7071C5.48043 48.8946 5.73478 49 6 49ZM7 44C7 43.2044 7.31607 42.4413 7.87868 41.8787C8.44129 41.3161 9.20435 41 10 41H20C20.7956 41 21.5587 41.3161 22.1213 41.8787C22.6839 42.4413 23 43.2044 23 44V47H7V44Z" fill="black"></path>
                                                <path d="M15 37C15.9889 37 16.9556 36.7068 17.7779 36.1574C18.6001 35.6079 19.241 34.8271 19.6194 33.9134C19.9978 32.9998 20.0969 31.9945 19.9039 31.0246C19.711 30.0546 19.2348 29.1637 18.5355 28.4645C17.8363 27.7652 16.9454 27.289 15.9755 27.0961C15.0055 26.9031 14.0002 27.0022 13.0866 27.3806C12.173 27.759 11.3921 28.3999 10.8427 29.2222C10.2932 30.0444 10 31.0111 10 32C10 33.3261 10.5268 34.5979 11.4645 35.5355C12.4021 36.4732 13.6739 37 15 37ZM15 29C15.5933 29 16.1734 29.1759 16.6667 29.5056C17.1601 29.8352 17.5446 30.3038 17.7716 30.852C17.9987 31.4001 18.0581 32.0033 17.9424 32.5853C17.8266 33.1672 17.5409 33.7018 17.1213 34.1213C16.7018 34.5409 16.1672 34.8266 15.5853 34.9424C15.0033 35.0581 14.4001 34.9987 13.8519 34.7716C13.3038 34.5446 12.8352 34.1601 12.5056 33.6667C12.1759 33.1734 12 32.5933 12 32C12 31.2044 12.3161 30.4413 12.8787 29.8787C13.4413 29.3161 14.2044 29 15 29V29Z" fill="black"></path>
                                                <path d="M32 13C32.5523 13 33 12.5523 33 12C33 11.4477 32.5523 11 32 11C31.4477 11 31 11.4477 31 12C31 12.5523 31.4477 13 32 13Z" fill="black"></path>
                                                <path d="M62 18H39V13C39 11.1435 38.2625 9.36301 36.9497 8.05025C35.637 6.7375 33.8565 6 32 6C30.1435 6 28.363 6.7375 27.0503 8.05025C25.7375 9.36301 25 11.1435 25 13V18H2C1.73478 18 1.48043 18.1054 1.29289 18.2929C1.10536 18.4804 1 18.7348 1 19V57C1 57.2652 1.10536 57.5196 1.29289 57.7071C1.48043 57.8946 1.73478 58 2 58H62C62.2652 58 62.5196 57.8946 62.7071 57.7071C62.8946 57.5196 63 57.2652 63 57V19C63 18.7348 62.8946 18.4804 62.7071 18.2929C62.5196 18.1054 62.2652 18 62 18ZM27 13C27 11.6739 27.5268 10.4021 28.4645 9.46447C29.4021 8.52678 30.6739 8 32 8C33.3261 8 34.5979 8.52678 35.5355 9.46447C36.4732 10.4021 37 11.6739 37 13V22H27V13ZM61 56H3V20H25V22H23V24H41V22H39V20H61V56Z" fill="black"></path>
                                                <path d="M59 52H5V54H59V52Z" fill="black"></path>
                                                <path d="M59 35H41V37H59V35Z" fill="black"></path>
                                                <path d="M59 39H32V41H59V39Z" fill="black"></path>
                                                <path d="M59 43H32V45H59V43Z" fill="black"></path>
                                                <path d="M59 47H32V49H59V47Z" fill="black"></path>
                                                </svg></a>

                                        @endif
                                        --}}
                                    </div>
                                </span>
                            </td>
                        </tr>
                        <!-- Componente de Modal para cada Job -->
                        <x-job-resume-modal :jobId="$job->id" />
                    @endforeach
                @else
                    <tr><p>Nenhuma vaga Cadastrada!</p></tr>
                @endif
            </tbody>
        </table>
    </article>






</section>

@endsection


@push('css-custom')


<style>
       .linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.resumo{
    cursor: pointer;
}

.resumo:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.3);
}


</style>

@endpush

@push('scripts-custom')

@endpush