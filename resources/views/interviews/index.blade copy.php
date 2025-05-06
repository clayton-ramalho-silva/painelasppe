@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Entrevistas</h1>
    <a href="{{ route('interviews.create') }}" class="btn btn-primary mb-3">Nova Entrevista</a>

    <div class="row bg-light mb-3 mt-3 border rounded">
        <h4>Entrevistados</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Reservista</th>
                    <th>Cidade</th>
                    <th>Tipo Vaga</th>
                    <th>Exp. Profissional</th>
                    <th>Informática</th>
                    <th>Inglês</th>
                    <th>Entrevistador</th>
                    <th>Status</th>
                    <th>Obs.:</th>
                </tr>
            </thead>
            <tbody>
                @if ($interviews->count() > 0)
                    @foreach ($interviews as $interview)
                    <tr>
                        <td>{{ $interview->resume->nome_candidato }}</td>
                        <td>{{ $interview->job->titulo }} - {{ $interview->job->company->nome }}</td>
                        <td>{{ $interview->data_hora }}</td>
                        <td>{{ $interview->observacoes }}</td>
                        <td>{{ $interview->recruiter->name }}</td>                        
                        <td>
                            <!-- select para atualizar o status -->
                            <form action="{{ route('interviews.updateStatus', ['jobId' => $interview->job->id, 'resumeId' => $interview->resume->id]) }}" method="post">
                                @csrf
                                @method('PUT')
    
    
                                @php
                                    // Buscar a relação pivot entre Job e Resume
                                    // Verifica se exite a relação antes de acessar
    
                                    $pivot = $interview->job->resumes()->where('resume_id', $interview->resume->id)->first();
    
                                    $currentStatus = $pivot ? $pivot->pivot->status : null;
                                @endphp
    
    
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="em análise" {{ $currentStatus === 'em análise' ? 'selected' : '' }}>Em análise</option>
                                    <option value="entrevistado" {{ $currentStatus === 'entrevistado' ? 'selected' : '' }}>Entrevistado</option>
                                    <option value="aprovado" {{ $currentStatus === 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                                    <option value="lista de espera" {{ $currentStatus === 'lista de espera' ? 'selected' : '' }}>Lista de Espera</option>
                                    <option value="reprovado" {{ $currentStatus === 'reprovado' ? 'selected' : '' }}>Reprovado</option>
                                </select>
                            </form>                        
                        </td>
                        <td>                        
                            <form action="{{ route('interviews.destroy', $interview) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr><p>Nenhuma Entrevista Cadastrada!</p></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
