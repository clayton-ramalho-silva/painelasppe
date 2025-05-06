<h1>Relatório de Candidatos por Vaga</h1>

<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <td>Vaga</td>
        <td>Candidatos</td>
    </tr>
</thead>
<tbody>
    @foreach ($jobs as $job)
        <tr>
            <td>{{ $job->titulo }}</td>
            <td>
                @foreach ($job->resumes as $resume )
                    {{ $resume->nome_candidato }} - {{ $resume->email }}
                @endforeach
            </td>
        </tr>
    @endforeach
</tbody>
</table>