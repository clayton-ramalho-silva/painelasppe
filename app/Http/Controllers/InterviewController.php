<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;

class InterviewController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {

        // Busca entrevistas filtrado por admin e recrutador

        /*
         $user = Auth::user();
 
         if ( $user->role === 'admin'){
             $interviews = Interview::with(['resume.jobs'])->get();            
         } else {
             $interviews = Interview::with(['resume.jobs'])
             ->whereHas('resume.jobs.recruiters', function($query) use ($user){
                 $query->where('recruiter_id', $user->id);
             })
             ->get();            
         }    
          
         */

        // Busca todas as entrevistas
        $query = Resume::with(['informacoesPessoais', 'contato', 'interview', 'escolaridade']);

        //$query = Resume::query();

        


        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }


         // Filtro por nome - Busca pelo nome do candidato
         if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });

            //dd($request->nome);
        }


        //dd($query);
        // Filtro Status
        if($request->filled('status')){           
           $query->where('status', $request->status);            
        }     
      
       
         // Filtro Candidato entrevistado/nao entrevistado/ todos
         if(request()->has('entrevistado')){
            if (request()->entrevistado == '1'){
                $query->whereHas('interview'); // Apenas candidatos que já foram entrevistados
            } elseif (request()->entrevistado == '0'){
                $query->whereDoesntHave('interview'); // Apenas candidatos que ainda não foram entrevistados
            }
        }
        
        // Filtro Filtro data Resumes

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
        

        $interviews = Interview::all();

        // $query->with([
        //     'informacoesPessoais',
        //     'contato',
        //     'interview',
        //     'escolaridade'
        // ]);

        $resumes = $query->paginate(50);
        // Implementar paginação
        //$resumes = $query->paginate(50); // Ajustar o numero coforme necessário.

        return view('interviews.index', compact('interviews', 'resumes', 'form_busca'));    
    }

    public function show($id)
    {
        
        $interview = Interview::findOrFail($id);
        $resume = Resume::findOrFail($interview->resume->id);
        $user = Auth::user();


        // Obtém vagas com empresas associadas conforme o usuario e status 'aberta'
        
        $jobsQuery = Job::where('status', 'aberta');

        if ($user->role !== 'admin') {
            $jobsQuery->whereHas('recruiters', function ($query) use ($user){
                $query->where('recruiter_id', $user->id);
            });
        }

        $jobs = $jobsQuery->get();

            
        

        // Vagas associadas ao recrutador
       
        /*
        if($user->role == 'admin'){
            // Administrador vê todas as vagas com empresas associadas
            $jobs = Job::with('company')->get();
        } else {
            // O recrutador vê apenas vagas associadas a ele com as empresas
            $jobs = Job::with('company')                                
            ->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();
        } 
            
        */
        
        return view('interviews.show', compact('interview', 'resume', 'jobs'));
    }

    public function showDev($id)
    {
        
        $interview = Interview::findOrFail($id);
        $resume = Resume::findOrFail($interview->resume->id);

        // Vagas associadas ao recrutador
        $user = Auth::user();
        
        if($user->role == 'admin'){
            // Administrador vê todas as vagas com empresas associadas
            $jobs = Job::with('company')->get();
        } else {
            // O recrutador vê apenas vagas associadas a ele com as empresas
            $jobs = Job::with('company')->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();
        }

        
        
        
        return view('interviews.showDev', compact('interview', 'resume', 'jobs'));
    }

    // Mostra view com todos curriculos
    public function create(Request $request)
    {
        //$user = Auth::user();

        // Busca apenas as vagas associadas ao recrutador
        //$jobs = Job::whereHas('recruiters', function($query) use ($user){
        //    $query->where('recruiter_id', $user->id);
        //})->get();

        //$resumes = Resume::all();        
        //$resumes = Resume::whereDoesntHave('interview')->get();

        // Busca todas as entrevistas
        $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])
            ->whereDoesntHave('interview');

        //$query = Resume::query();

        


        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }


         // Filtro por nome - Busca pelo nome do candidato
         if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });

            //dd($request->nome);
        }


        //dd($query);
        // Filtro Status
        if($request->filled('status')){           
           $query->where('status', $request->status);            
        }     
      
       
         // Filtro Candidato entrevistado/nao entrevistado/ todos
         if(request()->has('entrevistado')){
            if (request()->entrevistado == '1'){
                $query->whereHas('interview'); // Apenas candidatos que já foram entrevistados
            } elseif (request()->entrevistado == '0'){
                $query->whereDoesntHave('interview'); // Apenas candidatos que ainda não foram entrevistados
            }
        }
        
        // Filtro Filtro data Resumes

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
        

        $interviews = Interview::all();

        // $query->with([
        //     'informacoesPessoais',
        //     'contato',
        //     'interview',
        //     'escolaridade'
        // ]);

        $resumes = $query->paginate(50);
        // Implementar paginação
        //$resumes = $query->paginate(50); // Ajustar o numero coforme necessário.

        return view('interviews.create', compact('interviews', 'resumes', 'form_busca'));    



        
        //return view('interviews.create', compact('resumes'));
    }

    // Mostra view com os dados do curriculo, pronta para entrevista
    public function interviewResume($id)
    {        

        
        $resume = Resume::find($id);

        return view('interviews.interviewResume', compact('resume'));
       
    }

    /*
    public function interviewResume(Request $request)
    {        
        $resume = Resume::find($request->input('resume_id'));

        return view('interviews.interviewResume', compact('resume'));
       
    }
    */

    
    public function store(Request $request)
    {

        //dd($request->all());
        
        $data = $request->validate([
            'saude_candidato' => 'required|string|max:255',
            'vacina_covid' => 'required|string|max:255',
            'perfil' => 'required|string|max:255',
            'perfil_santa_casa' => 'required|string|max:255',
            'classificacao' => 'required|string|max:255',
            'qual_formadora' => 'required|string',
            'parecer_recrutador' => 'required|string',
            'curso_extracurricular' => 'required|string',
            'apresentacao_pessoal' => 'required|string',
            'experiencia_profissional' => 'required|string',
            'caracteristicas_positivas' => 'required|string',
            'habilidades' => 'required|string',
            'porque_ser_jovem_aprendiz' => 'required|string',
            'qual_motivo_demissao' => 'required|string',
            'pretencao_candidato' => 'required|string',
            'objetivo_longo_prazo' => 'required|string',
            'pontos_melhoria' => 'required|string',
            'familia' => 'required|string',
            'disponibilidade_horario' => 'required|string',
            'sobre_candidato' => 'required|string',
            'rotina_candidato' => 'required|string',
            'familia_cras' => 'required|string|max:255',
            'outros_idiomas' => 'required|string',
            'fonte_curriculo' => 'required|string|max:255',
            'sugestao_empresa' => 'required|string',
            'observacoes' => 'required|string',
            'pontuacao' => 'required|string|max:255',                      
            'resume_id' => 'required|exists:resumes,id'
            
        ]);       

        $interview =  Interview::create([
            'saude_candidato' => $data['saude_candidato'],
            'vacina_covid' => $data['vacina_covid'],
            'perfil' => $data['perfil'],
            'perfil_santa_casa' => $data['perfil_santa_casa'],
            'classificacao' => $data['classificacao'],
            'qual_formadora' => $data['qual_formadora'], 
            'parecer_recrutador' => $data['parecer_recrutador'], 
            'curso_extracurricular' => $data['curso_extracurricular'], 
            'apresentacao_pessoal' => $data['apresentacao_pessoal'], 
            'experiencia_profissional' => $data['experiencia_profissional'], 
            'caracteristicas_positivas' => $data['caracteristicas_positivas'], 
            'habilidades' => $data['habilidades'], 
            'porque_ser_jovem_aprendiz' => $data['porque_ser_jovem_aprendiz'], 
            'qual_motivo_demissao' => $data['qual_motivo_demissao'], 
            'pretencao_candidato' => $data['pretencao_candidato'], 
            'objetivo_longo_prazo' => $data['objetivo_longo_prazo'], 
            'pontos_melhoria' => $data['pontos_melhoria'], 
            'familia' => $data['familia'], 
            'disponibilidade_horario' => $data['disponibilidade_horario'], 
            'sobre_candidato' => $data['sobre_candidato'], 
            'rotina_candidato' => $data['rotina_candidato'], 
            'familia_cras' => $data['familia_cras'],
            'outros_idiomas' => $data['outros_idiomas'], 
            'fonte_curriculo' => $data['fonte_curriculo'],
            'sugestao_empresa' => $data['sugestao_empresa'], 
            'observacoes' => $data['observacoes'], 
            'pontuacao' => $data['pontuacao'],                      
            'resume_id' => $data['resume_id'],
            'recruiter_id' => Auth::id(),            
        ]);


        // Salvando Log de criação
        $this->logAction('create', 'interviews', $interview->id, 'Entrevista cadastrado com sucesso.');

        return redirect()->route('interviews.index')->with('success', 'Entrevista cadastrada com sucesso!');
    }

   

    public function update(Request $request, Interview $interview)
    {

               
        $data = $request->validate([
            'saude_candidato' => 'required|string|max:255',
            'vacina_covid' => 'required|string|max:255',
            'perfil' => 'required|string|max:255',
            'perfil_santa_casa' => 'required|string|max:255',
            'classificacao' => 'required|string|max:255',
            'qual_formadora' => 'required|string',
            'parecer_recrutador' => 'required|string',
            'curso_extracurricular' => 'required|string',
            'apresentacao_pessoal' => 'required|string',
            'experiencia_profissional' => 'required|string',
            'caracteristicas_positivas' => 'required|string',
            'habilidades' => 'required|string',
            'porque_ser_jovem_aprendiz' => 'required|string',
            'qual_motivo_demissao' => 'required|string',
            'pretencao_candidato' => 'required|string',
            'objetivo_longo_prazo' => 'required|string',
            'pontos_melhoria' => 'required|string',
            'familia' => 'required|string',
            'disponibilidade_horario' => 'required|string',
            'sobre_candidato' => 'required|string',
            'rotina_candidato' => 'required|string',
            'familia_cras' => 'required|string|max:255',
            'outros_idiomas' => 'required|string',
            'fonte_curriculo' => 'required|string|max:255',
            'sugestao_empresa' => 'required|string',
            'observacoes' => 'required|string',
            'pontuacao' => 'required|string|max:255',                      
            'resume_id' => 'required|exists:resumes,id'
            
        ]);       


        
       //dd($data);

        $interview->update($data);

        // Salvando Log de criação
        $this->logAction('create', 'interviews', $interview->id, 'Entrevista cadastrado com sucesso.');

        return redirect()->route('interviews.index')->with('success', 'Entrevista cadastrada com sucesso!');
    }

    // Andamento
    public function associarVaga(Request $request)
    {
       //dd($request->all());

        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',            
            'resume_id' => 'required|exists:resumes,id',            
           
        ]);
        
        //dd($data);

        
        $job = Job::findOrFail($request->job_id);
        $resume = Resume::findOrFail($request->resume_id);
        
        
        //dd($resume->jobs()->exists());
        if($resume->jobs()->exists()){
            return redirect()->back()->with('danger', 'Candidato já está associado a uma vaga!');
        }

        
        if(!$job->data_inicio_contratacao){
            return redirect()->back()->with('danger', 'Processo de contratação ainda não foi iniciado!');    
        }
        
        
        $job->resumes()->attach($request->resume_id);

        // Confirma se agora está associado
        if ($resume->jobs()->where('jobs.id', $job->id)->exists()) {
            // Aqui você pode mudar o status ou fazer outras ações
            $resume->status = 'processo'; // exemplo
            $resume->save();
        }


        // Salvando Log de criação
        $this->logAction('associate', 'job_resume', $job->id, 'Candidato associado a vaga.');

        return redirect()->back()->with('success', 'Candidato associado a vaga com sucesso!');
    }

    public function desassociarVaga(Request $request)
    {
        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'resume_id' => 'required|exists:resumes,id',
        ]);
        
        $job = Job::findOrFail($data['job_id']);
        $resume = Resume::findOrFail($data['resume_id']);
        
        // Verifica se está associado antes de remover
        if ($resume->jobs()->where('jobs.id', $job->id)->exists()) {
            
            $job->resumes()->detach($resume->id);

            // (Opcional) Atualiza o status do currículo
            $resume->status = 'ativo'; // ou outro status
            $resume->save();

            // Log de desassociação
            $this->logAction('detach', 'job_resume', $job->id, 'Candidato desassociado da vaga.');

            return redirect()->back()->with('success', 'Candidato desassociado com sucesso!');
        }

        return redirect()->back()->with('danger', 'Candidato não estava associado a esta vaga.');
    }

    public function destroy(Interview $interview)
    {
        if( $interview->recruiter_id !== Auth::id()){
            abort(403, 'Acesso negado');
        }

        $interview->delete();

        // Salvando Log de criação
        $this->logAction('delete', 'interviews', $interview->id, 'Entrevista excluída.');

        return redirect()->route('interviews.index')->with('success', 'Entrevista excluída com sucesso!');
    }

    public function updateStatus(Request $request, $jobId, $resumeId)
    {

       
        // Valida o campo status
        $request->validate([
            'status' => 'required|in:em análise,entrevistado,aprovado,lista de espera,reprovado',            
        ]);

       
        // Busca o currículo (Resume) e a vaga associada
        $job = Job::findOrFail($jobId);
        $resume = Resume::findOrFail($resumeId);

        // Busca ou cria o relacionamento na tabela intermediaria

        if($job->resumes()->wherePivot('resume_id', $resume->id)->exists()){
            // Se existe, atualiza o status
            $job->resumes()->updateExistingPivot($resume->id,[
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);            
        } else {
            // Se não existe, cria o relacionamento com o status inical
            $job->resumes()->attach($resume->id,[
                'status' => $request->input('status'),
            ]);
        }




        // Verifica vagas preenchidas
        if($request->input('status') === 'aprovado'){
            if ($job->filled_positions < $job->quantidade ){
                $job->increment('filled_positions');
            } else {
                // Se vagas esgotadas, move para lista de espera
                $job->resumes()->updateExistingPivot($resume->id, [
                    'status' => 'lista de espera',
                    'updated_at' => now(),
                ]);
            }
        } elseif ($request->input('status') === 'reprovado'){
            if ($job->filled_positions > 0){
                $job->decrement('filled_positions');
            }
        }


        // Reprocessar a lista de espera

        $this->allocateFromWaitlist($job);

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }

    private function allocateFromWaitlist($job)
    {
        // Calcula o número de vagas disponíveis
        $vagas_disponiveis = $job->quantidade - $job->filled_positions;

        if ($vagas_disponiveis > 0) {
            //Busca currículo na fila de espera
            $candidatos = $job->resumes()
                ->wherePivot('status', 'lista de espera')
                ->take($vagas_disponiveis)
                ->get();

            // Aprova candidatos da fila de espera
            foreach( $candidatos as $candidato ){
                $candidato->updateExistingPivot($candidato->id, ['status' => 'aprovado']);
                $job->increment('filled_positions');
            }
        }
    }
}
