@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('interviews.index') }}">Nova Entrevista</a></li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('interviews.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1">

        <div class="container">

            <form class="form-padrao" action="" method="get" id="resumeForm">

                <div class="row">

                    <div class="col-4 form-campo">

                        <div class="floatlabel-wrapper required">
                            <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Selecione o Candidato</label>
                            <select name="resume_id" id="resume_id" class="form-select">
                                <option></option>
                                @if ($resumes->isNotEmpty())
                                    @foreach ($resumes as $resume)
                                        <option value="{{$resume->id}}">{{ $resume->informacoesPessoais->nome }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Nenhum candidato disponível para entrevista</option>
                                @endif
                            </select>
                        </div>

                    </div>

                </div>

            </form>

        </div>

    </article>

</section>
@endsection

@push('scripts-custom')
<script>
$('#resume_id').select2({
    placeholder: "Selecione",
});

$('#resume_id').on('change', function(e) {
    console.dir('aaaa');
    let id = $(this).val();
    window.location.href = "{{ route('interviews.interviewResume', '') }}/" + id;
});
</script>
@endpush

@push('css-custom')
<style>
.breadcrumb-item{
    font-size: 23px;
    font-weight: 500;
}

.breadcrumb-item a{

    color: grey !important;
}

.breadcrumb-item.active{
    color: #009cff !important;
}
</style>
@endpush