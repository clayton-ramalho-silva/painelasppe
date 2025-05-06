@extends('layouts.app')

@section('content')

<section class="cabecario">
    <h1>Vagas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroVagas" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-jobs" class="dropdown-menu" aria-labelledby="dropdownFiltro">
                <div class="row d-flex flex-column">
                    <div class="col">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option value="">Selecione</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="cargo" class="form-label">Setor</label>
                        <select name="cargo" id="cargo" class="form-select" >
                            <option></option>
                            <option value="Copa & Cozinha">Copa & Cozinha</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                            <option value="Construção e Reparos">Construção e Reparos</option>
                            <option value="Conservação e Limpeza">Conservação e Limpeza</option>
                        </select>
                    </div>


                    <div class="col">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option></option>
                            <option value="aberta"> Aberta</option>
                            <option value="fechada"> Fechada</option>
                            <option value="espera"> Espera</option>
                            <option value="cancelada"> Cancelada</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="recruiters" class="form-label" >Recrutador</label>
                        <select name="recruiters" id="recruiters" class="form-select">
                            <option></option>
                            @foreach ($recruiters as $recruiter)
                                <option value="{{ $recruiter->name }}" > {{ $recruiter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select">
                            <option></option>
                            <option value="Masculino"> Masculino</option>
                            <option value="Feminino"> Feminino</option>
                            <option value="Indiferente"> Indiferente</option>
                        </select>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="cidade">Cidade:</label>
                            <input type="text" placeholder="Cidade" class="form-control" id="cidade" name="cidade">
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="cidade">UF:</label>
                            <input type="text" placeholder="UF" class="form-control" id="UF" name="uf">
                        </div>
                    </div>


                    <div class="col">
                        <label for="informatica" class="form-label">Informática</label>
                        <select name="informatica" id="informatica" class="form-select">
                            <option></option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select">
                            <option></option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col">
                        <label for="company" class="form-label" >Empresa</label>
                        <select name="company" id="company_id" class="form-select" >
                            <option ></option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->nome_fantasia }}" > {{ $company->nome_fantasia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="min_salario">Salário (min):</label>
                        <input type="text" name="min_salario" id="min_salario" class="form-control">
                    </div>
                    <div class="col">
                        <label for="max_salario">Salário (max):</label>
                        <input type="text" name="max_salario" id="max_salario" class="form-control">
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
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


<section class="sessao">

    <article class="f-interna">
        <h4>Vagas em Destaque</h4>

        <div class="table-container">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Título</th>
                        <th>Vagas</th>
                        <th>Recrutador</th>

                        <th class="icone-status">#</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($jobs->count() > 0)
                        @foreach ($jobs as $job)
                        <tr onclick="window.location='{{ route('jobs.edit', $job) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                <td class="ico-v">
                                    @if ($job->company->logotipo)
                                            <img src="{{ asset("documents/companies/images/{$job->company->logotipo}")}}" alt="" width="50" height="auto" class="rounded-circle me-2">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>

                                        @endif
                                    {{ $job->company->nome_fantasia }}
                                </td>
                                <td>{{ $job->cargo }}</td>
                                <td>{{ $job->qtd_vagas }}</td>
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
                                    <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais Informações">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-{{ $job->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><g><path d="m64.5,122.6c32,0 58-26 58-58s-26-58-58-58-58.1,26-58.1,58 26.1,58 58.1,58zm0-108c27.5,5.32907e-15 49.9,22.4 49.9,49.9s-22.4,49.9-49.9,49.9-49.9-22.4-49.9-49.9 22.4-49.9 49.9-49.9z"></path><path d="m54.8,90.1c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1h26.9c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-9.4v-36.1c0-2.3-1.8-4.1-4.1-4.1h-13.4c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h9.4v32h-9.4z"></path> <circle cx="62.7" cy="36.5" r="6.6"></circle> </g> </g></svg>

                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-{{ $job->id }}">
                                            <b>Cidade: </b>{{ $job->cidade }}<br><br>
                                            <b><a href="#" data-bs-toggle="modal" data-bs-target="#jobResumesModal-{{ $job->id }}">Candidatos Selecionados: </b>{{ $job->resumes->count()}}</a><br><br>
                                            <b>Data Abertura: </b>{{ $job->created_at->format('d/m/Y') }}<br><br>
                                            <b>Data Inicio: </b>0<br><br>
                                            <b>Data Fechamento: </b>0<br><br>

                                            <b>Observações: </b>
                                            @if ( count($job->observacoes) > 0)
                                                {{ str( $job->observacoes()->orderBy('created_at', 'desc')->first()->observacao )->limit(10, '...') }}
                                            @else
                                                Nenhuma.
                                            @endif



                                        </div>

                                    </span>

                                    <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir ações">
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
                                            <a class="editAqui" href="{{route('jobs.show', $job) }}">
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
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
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
                                <td>
                                    @php
                                        $aberta = true;
                                        $iniciada = false;
                                        $fechada = false;
                                        // Precisa criar lógica para mudar de cor quando a vaga for iniciada e fechada.
                                        $status = $job->status ;

                                        // Precisa criar a legenda das cores. Precisa ver se vai colocar tooltips, se for é melhor fazer usando um if, eleif, com svg de cada cor.
                                    @endphp
                                    <svg
                                        @style([
                                            'enable-background:new 0 0 16 16',
                                            'fill: green' => $aberta,
                                            'fill: yellow' => $iniciada,
                                            'fill: gray' => $fechada,
                                        ])
                                        version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                        <circle cx="8" cy="8" r="8"></circle>
                                    </svg>
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
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('jobs.create') }}" class="btInt btCadastrar">Cadastrar <small>Crie uma nova vaga</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>
</section>
@endsection



@push('scripts-custom')
<script>

$(document).ready(function() {
    $('#filter-form-jobs').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('jobs.index') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                $('.table-container').html($(response).find('.table-container').html());
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