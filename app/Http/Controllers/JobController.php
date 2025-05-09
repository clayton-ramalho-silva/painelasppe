<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogsActivity;
use Carbon\Carbon;

class JobController extends Controller
{

    use LogsActivity;

    public function index(Request $request)
    {

        $vagas = Job::where('status', 'espera')->get();
        //dd($vagas);

        /**
         * 10 vagas
         * aberta 6
         * fechada 3
         * cancelada 1
         * espera 0
         * 
         */


        // Verifica se usuário é Admin ou Recrutador


        $user = Auth::user();

        if($user->role == 'admin'){
            // Administrador vê todas as vagas com empresas associadas
            $query = Job::with(['company', 'recruiters']);
        } else {
            // O recrutador vê apenas vagas associadas a ele com as empresas
            $query = Job::with(['company', 'recruiters'])->whereHas('recruiters', function($q) use($user){
                $q->where('recruiter_id', $user->id);
            });
        }


        /**
         * Filtros: Setor, Status, Recrutador, Genero, Cidades, UF, Inglês, Informática, Empresa, Salario de tanto a tanto
         */

        // Filtro Setor
        if ($request->filled('cargo')) {

            if($request->cargo !== "Todos"){
                $query->where('cargo', rawurldecode($request->cargo));
            }

        }


         // Filtro Status
         if ($request->filled('status')) {

            if($request->status !== "Todos"){
                $query->where('status', $request->status);
            }

        }

        // Filtro Recrutador
        if($request->filled('recruiters')){

            if($request->recruiters !== "Todos"){
                $query->whereHas('recruiters', function($q) use ($request){
                    $q->where('name', $request->recruiters);
                });
            }

        }

        // Filtro Genero
        if ($request->filled('sexo')) {

            if($request->sexo !== "Todos"){
                $query->where('genero', $request->sexo);
            }

        }


        // Filtro Cidade
        if ($request->filled('cidade')) {

            if($request->cidade !== "Todas"){
                $query->where('cidade', $request->cidade);
            }

        }

        // Filtro UF
        if ($request->filled('uf')) {

            if($request->uf !== "Todos"){
                $query->where('uf', $request->uf);
            }

        }

        // Filtro Informatica
        if ($request->filled('informatica')) {

            if($request->informatica !== "Todos"){
                $query->where('informatica', $request->informatica);
            }

        }


        // Filtro Ingles
        if ($request->filled('ingles')) {

            if($request->ingles !== "Todos"){
                $query->where('ingles', $request->ingles);
            }

        }

        // Filtro Empresa
        if($request->filled('company')){

            if($request->company !== "Todas"){
                $query->whereHas('company', function($q) use ($request){
                    $q->where('nome_fantasia', rawurldecode($request->company));
                });
            }

        }

         // Filtro Salário Mínimo
        if ($request->filled('min_salario')) {
            $query->where('salario', '>=', $request->min_salario);
        }

        // Filtro Salário Máximo
        if ($request->filled('max_salario')) {
            $query->where('salario', '<=', $request->max_salario);
        }

        // Filtro Filtro data Jobs

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }


        //$jobs = $query->get();
        $jobs = $query->orderBy('created_at', 'desc')->get();

        $companies = Company::all();
        $recruiters = User::where('role', 'recruiter')->get();

        //dd($query->toRawSql());

        return view('jobs.index', compact('jobs', 'companies', 'recruiters'));

    }

    public function show(Job $job)
    {
        $resumes = Resume::all();
        return view('jobs.show', compact('job', 'resumes'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('jobs.create', compact('companies'));
    }

    public function store(Request $request)
    {


        $data = $request->validate([

            //'setor' =>'required|string|max:255',
            'cargo' =>'required|string|max:255',
            'cbo' =>'required|string|max:255',
            'descricao' =>'nullable|string',
            'genero' =>'required|string|max:255',
            'qtd_vagas' =>'required|integer|min:1',
            'cidade' =>'required|string|max:255',
            'uf' =>'required|string|max:255',
            'salario' =>'required|string|max:255',
            'dias_semana' =>'required|string|max:255',
            'horario' =>'required|string|max:255',
            'dias_curso' =>'required|string|max:255',
            'exp_profissional' =>'required|string|max:255', // Beneficios
            'beneficios' =>'required|string|max:255', // Requisitos/Diferenciais
            'informatica' =>'required|string|max:255',
            'ingles' =>'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        $data['status'] = 'aberta';
        $data['setor'] = '';

       // dd($data);



        $job = Job::create($data);

        // Salvando Log de criação
        $this->logAction('create', 'jobs', $job->id, 'Job cadastrado com sucesso.');

        return redirect()->route('jobs.index')->with('success', 'Vaga criada com sucesso!');
    }

    public function edit(Job $job)
    {
        $companies = Company::all();
        $recruiters = User::where('role', 'recruiter')->get();

        $selections = $job->selections;

        $curriculosParaAssociar = Resume::where('status', 'ativo')
            ->whereDoesntHave('jobs')
            ->whereHas('interview')
            ->get();

        return view('jobs.edit', compact('job', 'companies', 'recruiters', 'curriculosParaAssociar'));
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([

            //'setor' =>'required|string|max:255',
            'cargo' =>'required|string|max:255',
            'cbo' =>'required|string|max:255',
            'descricao' =>'nullable|string',
            'genero' =>'required|string|max:255',
            'qtd_vagas' =>'required|integer|min:1',
            'cidade' =>'required|string|max:255',
            'uf' =>'required|string|max:255',
            'salario' =>'required|string|max:255',
            'dias_semana' =>'required|string|max:255',
            'horario' =>'required|string|max:255',
            'dias_curso' =>'required|string|max:255',
            'exp_profissional' =>'required|string|max:255', // Beneficios
            'beneficios' =>'required|string|max:255', // Requisitos/Diferenciais
            'informatica' =>'required|string|max:255',
            'ingles' =>'required|string|max:255',

        ]);

        $data['setor'] = '';


        $job->update($data);
        $job->updateStatus();


        // Salvar Log de atualização
        $this->logAction('update', 'jobs', $job->id, 'Job atualizado com sucesso.');

        return redirect()->route('jobs.index')->with('success', 'Vaga atualizada com sucesso');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        // Salvar Log de atualização
        $this->logAction('delete', 'jobs', $job->id, 'Job excluído.');

        return redirect()->route('jobs.index')->with('success', 'Vaga excluída com sucesso!');
    }

    /* Função antiga para associar o curriculo ha uma vaga
    public function assignCandidateToJob(Request $request, Job $job)
    {
        $job->filled_positions += 1;
        $job->updateStatus();

        return redirect()->route('jobs.index')->with('success','Candidato associado à vaga com sucesso!');
    }

    public function removeCandidateFromJob(Request $request, Job $job)
    {
        if ($job->filled_positions > 0){
            $job->filled_positions -= 1;
            $job->updateStatus();
        }

        return redirect()->route('jobs.index')->with('success', 'Candidato removido da vaga com sucesso!');
    }

    */

    // Atualizando o status da vaga( aberta, fechada, espera, cancelada)
    public function updateStatus(Request $request, $jobId)
    {
        $request->validate([
            'status' => 'required|in:aberta,fechada,espera,cancelada',
        ]);
        $job = Job::findOrFail($jobId);

        $job->status = $request->input('status');
        $job->save();

        // Salvar Log de atualização
        $this->logAction('updateStatus', 'jobs', $job->id, 'Status da Vaga atualizado com sucesso.');

        return redirect()->route('jobs.index')->with('success', 'Vaga atualizada com sucesso');
    }

    // Associando a vaga a um recrutador
    public function associateRecruiter(Request $request, $jobId)
    {
        //dd($request->all());

        $request->validate([
            'recruiters' => 'required|array',
            'recruiters.*' => 'exists:users,id'
        ]);

        $job = Job::findOrFail($jobId);

        $job->recruiters()->sync($request->input('recruiters'));

         // Salvar Log de atualização
         $this->logAction('associateRecruiter', 'jobs', $job->id, 'Recrutador associado a vaga atualizado com sucesso.');

         return redirect()->route('jobs.index')->with('success', 'Vaga atualizada com sucesso');
    }

    public function storeHistory(Request $request, $jobId)
    {

        $data = $request->validate([
            'observacao' => 'required|string',
        ]);


        $job = Job::findOrFail($jobId);

        $job->observacoes()->create([
            'observacao' => $data['observacao'],
        ]);

        return redirect()->back()->with('success', 'Observação cadastrada com sucesso!');

    }

    // Iniciar contratação
    public function startContraction(Request $request,  $jobId)
    {
        $job = Job::findOrFail($jobId);
        $now = Carbon::now();

        $job->data_inicio_contratacao = $now;

        $job->save();

        return back()->with('success', 'Contratação iniciada com sucesso');
    }

    // Finalizar contratação
    public function endContraction(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);
        $now = Carbon::now();

        $job->data_fim_contratacao = $now;
        $job->status = 'fechada';
        $job->save();

        return back()->with('success', 'Contratação finalizada com sucesso');


    }


}
