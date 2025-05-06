<h1>Lista de Candidatos por Vaga</h1>

<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <th>Vagas</th>
        <th>Candidatos</th>
    </tr>
</thead>
<tbody>
    @foreach ($jobs as $job)
        <tr>
            <td>{{ $job->titulo }}</td>
            <td>
                @foreach ($job->resumes as $resume)
                    {{ $resume->nome_candidato }} - {{ $resume->email }}
                @endforeach
            </td>
        </tr>
    @endforeach
</tbody>
</table>

<a href="{{ route('reports.export.candidatesByJob.excel') }}">Exportar para Excel</a>
<a href="{{ route('reports.export.candidatesByJob.pdf')}}">Exportar para PDF</a>