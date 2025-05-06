@extends('layouts.app')

@section('content')

<section class="cabecario">
    <h1>Entrevistas</h1>

    <div class="cabExtras">

        <div class="dropdown">

            <button class="dropdown-toggle" id="dropdownFiltroInterview" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>
            <form id="filter-form-interviews" class="dropdown-menu" aria-labelledby="dropdownFiltroInterview">
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
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option></option>
                            <option value="ativo"> Ativo</option>
                            <option value="inativo"> Inativo</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="entrevistado" class="form-label">Entrevistado</label>
                        <select name="entrevistado" id="entrevistado" class="form-select">
                            <option value="">Todos</option>
                            <option value="1">Já entrevistado</option>
                            <option value="0">Não entrevistado</option>
                        </select>
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

     <h4>Últimos currículos</h4>


     <div class="table-container">
         <table class="table table-borderless">
             <thead>
                 <tr>
                     <th>Nome</th>
                     <th>Tipo de vaga</th>
                     <th>Entrevistado</th>
                     <th>Obs.:</th>
                     <th class="icone-status">#</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($resumes->count() > 0)
                     @foreach ($resumes as $resume)
                     <tr onclick="window.location='{{ route('resumes.edit', $resume) }}'" class="linha-tabela" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Currículo">
                             <td class="ico-v">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                 {{ $resume->informacoesPessoais->nome }}</td>
                             <td>
                                 @foreach ($resume->vagas_interesse as $vaga)
                                     {{$vaga}},
                                 @endforeach
                             </td>
                             <td>
                                 @if ($resume->interview)
                                     <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                                 @else
                                     <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                                 @endif


                                 {{-- $resume->interview ? 'Sim' : 'Não' --}}
                             </td>
                             <td>
                                 {{-- Precisa lógica para puxar informação --}}
                                 Não
                             </td>
                             <td class="svg-status">
                                 @switch($resume->status)
                                     @case('inativo')
                                         <svg
                                             style="enable-background:new 0 0 16 16; fill: red;"
                                             version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                             <circle cx="8" cy="8" r="8"></circle>
                                         </svg>
                                         <span>Inativo</span>
                                         @break

                                     @case('em processo')
                                         <svg
                                             style="enable-background:new 0 0 16 16; fill: yellow;"
                                             version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                             <circle cx="8" cy="8" r="8"></circle>
                                         </svg> Em processo
                                         @break
                                     @case('efetivado')
                                         <svg
                                             style="enable-background:new 0 0 16 16; fill: green;"
                                             version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                             <circle cx="8" cy="8" r="8"></circle>
                                         </svg> Em processo
                                         @break


                                     @default
                                         <svg
                                             style="enable-background:new 0 0 16 16; fill: gray;"
                                             version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                             <circle cx="8" cy="8" r="8"></circle>
                                         </svg> <span>Ativo </span>
                                 @endswitch
                             </td>

                             {{--
                             <td class="m-actions">

                                 <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais Informações">
                                     <button class="dropdown-toggle" type="button" id="dropdownMenuInfo-{{ $resume->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                         <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><g><path d="m64.5,122.6c32,0 58-26 58-58s-26-58-58-58-58.1,26-58.1,58 26.1,58 58.1,58zm0-108c27.5,5.32907e-15 49.9,22.4 49.9,49.9s-22.4,49.9-49.9,49.9-49.9-22.4-49.9-49.9 22.4-49.9 49.9-49.9z"></path><path d="m54.8,90.1c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1h26.9c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-9.4v-36.1c0-2.3-1.8-4.1-4.1-4.1h-13.4c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h9.4v32h-9.4z"></path> <circle cx="62.7" cy="36.5" r="6.6"></circle> </g> </g></svg>

                                     </button>

                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuInfo-{{ $resume->id }}">
                                         <b>Cidade: </b>{{ $resume->contato->cidade }}<br><br>
                                         <b>Data Nascimento: </b>{{ $resume->informacoesPessoais->data_nascimento }}<br><br>
                                     </div>

                                 </span>

                                 <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir ações">
                                     <button class="dropdown-toggle" type="button" id="dropdownMenuActions-{{ $resume->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                         <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                 <circle cx="2" cy="8" r="2"></circle>
                                                 <circle cx="8" cy="8" r="2"></circle>
                                                 <circle cx="14" cy="8" r="2"></circle>
                                         </svg>
                                     </button>
                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuActions-{{ $resume->id }}">
                                         <a class="editAqui" href="{{ route('resumes.edit', $resume) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                         </a>
                                         <form action="{{ route('resumes.destroy', $resume) }}" method="POST" style="display:inline;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                                 <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                             </svg></button>
                                         </form>
                                         @if (!$resume->interview)
                                             <form action="{{ route('interviews.interviewResume') }}" method="get" class="d-inline">
                                                 @csrf
                                                 <input type="hidden" name="resume_id" value="{{ $resume->id}}">
                                                 <button type="submit" class="btn-icon"  data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">
                                                     <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><defs><style>.cls-1{fill:#2d3e50;}.cls-2{fill:#1d75b8;}</style></defs><title>Entrevistar</title><path class="cls-1" d="M20.04038,81.40185a10.92793,10.92793,0,0,0,21.45375,0l1.66818-8.59863A11.51116,11.51116,0,0,0,31.758,59.7408H29.77648A11.51114,11.51114,0,0,0,18.37222,72.80321Z"></path><path class="cls-1" d="M53.58929,97.7169,41.9426,93.58061,30.76722,104.7559,19.59193,93.58061,7.94524,97.7169a3.24658,3.24658,0,0,0-2.08909,2.38444l-3.97894,18.726H59.65732l-3.97894-18.726A3.24643,3.24643,0,0,0,53.58929,97.7169Z"></path><path class="cls-1" d="M84.83771,72.80321l1.66816,8.59863a10.92793,10.92793,0,0,0,21.45375,0l1.66818-8.59863A11.51116,11.51116,0,0,0,98.22352,59.7408H96.242A11.51114,11.51114,0,0,0,84.83771,72.80321Z"></path><path class="cls-1" d="M122.14387,100.10134a3.24642,3.24642,0,0,0-2.08911-2.38444l-11.64668-4.13629H86.05741L74.41072,97.7169a3.2466,3.2466,0,0,0-2.08911,2.38444l-3.97892,18.726h57.7801Z"></path><path class="cls-2" d="M35.79326,51.04554,47.07233,48.9469a16.10147,16.10147,0,1,0-3.33642-17.80663c-.27891.63888-6.70164,14.27649-8.81881,18.7707A.8052.8052,0,0,0,35.79326,51.04554Z"></path><path class="cls-2" d="M61.18658,18.54242A14.12527,14.12527,0,0,1,84.00271,35.17285l-.58592.8634,3.76062,9.51886c-2.838-.71928-6.76036-1.70933-10.21825-2.5824a19.09912,19.09912,0,0,1-1.5031,3.69262c3.51024.88451,12.9869,3.28261,16.70182,4.22284a.80494.80494,0,0,0,.94547-1.07708l-5.26358-13.32A18.07357,18.07357,0,1,0,56.51784,18.4556,19.165,19.165,0,0,1,61.18658,18.54242Z"></path></svg>
                                                 </button>
                                             </form>

                                         @else

                                         <a href="{{ route('interviews.show', $resume->interview->id) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">
                                             <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><defs><style>.cls-1{fill:#1d75b8;}.cls-2{fill:#2d3e50;}</style></defs><title>Ver Entrevista</title><path class="cls-1" d="M38.109,58.652c-2.33047.96751-4.48018,2.20618-5.346,4.79444-.17461.52383-.92951,4.64863-1.27669,6.56721a.826.826,0,0,0,.81448.97472H69.68485a.8171.8171,0,0,0,.41187-.10989.82619.82619,0,0,0,.40157-.86484c-.34611-1.91858-1.10205-6.04338-1.27669-6.56721-.86479-2.58826-3.0145-3.82693-5.34495-4.79444-.29787-.12326-.5988-.24241-.89975-.35949q-3.04735-1.18169-6.09372-2.36334a6.39833,6.39833,0,0,1-11.78071,0q-3.04742,1.18166-6.09374,2.36334C38.70782,58.40961,38.40686,58.52876,38.109,58.652Z"></path><path class="cls-1" d="M50.992,53.74957a7.51008,7.51008,0,0,0,7.3692-6.07387l1.14635-5.90717a7.90851,7.90851,0,0,0-7.8349-8.974H50.31139a7.90766,7.90766,0,0,0-7.83422,8.974l1.146,5.90717A7.51028,7.51028,0,0,0,50.992,53.74957Z"></path><path class="cls-2" d="M123.79879,95.88317a6.36343,6.36343,0,0,0-3.42983-4.618c-5.96369-2.97475-19.051-7.36776-19.051-7.36776V79.57689l.36476-.27451a12.50068,12.50068,0,0,0,4.74555-7.94683l.07437-.45867h.35588a4.82817,4.82817,0,0,0,4.46918-3.00836,5.24188,5.24188,0,0,0,.657-2.54623,4.83546,4.83546,0,0,0-.34361-1.792,2.50437,2.50437,0,0,0-.96854-1.55822L109.465,61.259l.301-1.3103c2.17976-9.50861-5.18631-18.0717-15.07564-18.309-.2408-.00342-.47987-.007-.71533-.00173-.23734-.00529-.47457-.00168-.7154.00173-9.89105.23734-17.2572,8.80043-15.07573,18.309L78.485,61.259l-1.20763.73306A2.50686,2.50686,0,0,0,76.307,63.5503a4.87245,4.87245,0,0,0-.34347,1.792,5.26193,5.26193,0,0,0,.65686,2.54623,4.83265,4.83265,0,0,0,4.47106,3.00836h.35591l.07262.45867a12.49592,12.49592,0,0,0,4.74716,7.94683l.36476.27451v4.32051s-13.08719,4.393-19.05083,7.36776a6.3588,6.3588,0,0,0-3.42986,4.618,138.5869,138.5869,0,0,0-1.20234,16.02476H125.001A138.57227,138.57227,0,0,0,123.79879,95.88317Z"></path><path class="cls-2" d="M77.50834,79.79419a19.62084,19.62084,0,0,1-1.656-3.22917,11.63934,11.63934,0,0,1-1.24964-.73527H9.22473V24.27027a1.51964,1.51964,0,0,1,1.30991-1.66852H91.445a1.52662,1.52662,0,0,1,1.31485,1.66852V34.76253c.11176-.00421.22227-.01434.33435-.017l.069-.00125c.28305-.004.54926-.00633.8115-.00337.2618-.0038.52633-.00043.7934.00315l.08756.00147a24.08007,24.08007,0,0,1,4.13.4611V21.88953a5.79657,5.79657,0,0,0-5.79746-5.79746H8.79643A5.79657,5.79657,0,0,0,2.999,21.88953V80.16292a5.80086,5.80086,0,0,0,5.79746,5.7875H37.71394L32.315,99.7368a1.37008,1.37008,0,0,0,1.275,1.87269H56.55368c.18989-2.39048.44856-4.83662.80033-6.89049A13.3026,13.3026,0,0,1,64.509,85.09125C67.89218,83.40344,73.213,81.35785,77.50834,79.79419Z"></path></svg>
                                         </a>

                                         @endif
                                     </div>

                                 </span>



                             </td>
                             --}}

                         </tr>
                     @endforeach
                 @else
                     <tr><p>Nenhuma Currículo Cadastrada!</p></tr>
                 @endif
             </tbody>
         </table>

     </div>
    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('interviews.create') }}" class="btInt btCadastrar">Entrevistar <small>Realize uma entrevista</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>
</section>
@endsection

@push('scripts-custom')
<script>
    $(document).ready(function() {
    $('#filter-form-interviews').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('interviews.index') }}",
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

.link-entrevista{
    transition: all ease-in-out 0.25s;
}
.link-entrevista:hover{
    text-decoration: underline;
}
</style>

@endpush
