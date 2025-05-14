<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use App\Models\Selection;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {

        //$leticia = Resume::find(18682);
        //dd($leticia->informacoesPessoais, $leticia->informacoesPessoais->exists());

        /**
         * Filtros: gênero, cnh, cidade, idade, entrevistado
         */

        $query = Resume::query();
        

        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }

        // Aplica os filtros somente quando fornecidos
        // Filtro por nome - Busca pelo nome do candidato
        if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });
        }


        // Filtro Status

        if ($request->filled('status') && $request->status !== "Todos") {
            if ($request->status === "ativo" || $request->status === "inativo") {
                $query->where('status', $request->status);
            } else {
                $query->whereHas('selections', function($q) use ($request) {
                    $q->where('status_selecao', $request->status);
                });
            }
        }
       

        // Filtro gênero
        if ($request->filled('sexo') && $request->sexo !== "Todos"){
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('sexo', $request->sexo);
            });
        }        

        // Filtro CNH
        if ($request->filled('cnh') && $request->cnh !== "Todos") {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('cnh', $request->cnh);
            });
        }

        // Filtro Idade
        if ($request->filled('min_age')) {
            $query->whereHas('informacoesPessoais', function ($q) use ($request) {
                $q->whereNotNull('data_nascimento')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) >= ?', [$request->min_age]);
            });
        }

        // Filtro Idade considerando idade minima e máxima por meses - EM DESENVOLVIMENTO
        // if ($request->filled('min_age') || $request->filled('max_age')) {
        //     $query->whereHas('informacoesPessoais', function ($q) use ($request) {
        //         $q->whereNotNull('data_nascimento');

        //         if ($request->filled('min_age')) {
        //             $q->whereRaw('TIMESTAMPDIFF(MONTH, data_nascimento, CURDATE()) >= ?', [$request->min_age]);
        //         }

        //         if ($request->filled('max_age')) {
        //             $q->whereRaw('TIMESTAMPDIFF(MONTH, data_nascimento, CURDATE()) <= ?', [$request->max_age]);
        //         }
        //     });
        // }


        // Filtro Reservista
        if ($request->filled('reservista') && $request->reservista !== "Todos") {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('reservista', $request->reservista);
            });
        }

        //Filtro Já foi jovem aprendiz
        if ($request->filled('foi_jovem_aprendiz') && $request->foi_jovem_aprendiz !== "Todos") {
            $query->where('foi_jovem_aprendiz', $request->foi_jovem_aprendiz);
        }

        // Filtro Informatica
        if ($request->filled('informatica') && $request->informatica !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->where('informatica', $request->informatica);
            });
        }

        // Filtro Informatica
        if ($request->filled('ingles') && $request->ingles !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->where('ingles', $request->ingles);
            });
        }

         // Filtro Formação/Escolaridade
         if ($request->filled('escolaridade') && $request->escolaridade !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->where('escolaridade', $request->escolaridade);
            });
        }

        // Filtro Vagas Interesse
        if ($request->filled('vagas_interesse')) {
            foreach ($request->vagas_interesse as $vaga) {
                $query->whereJsonContains('vagas_interesse', $vaga);
            }
        }

        // Filtro Experiência Profissional
        if ($request->filled('experiencia_profissional')) {
            foreach ($request->experiencia_profissional as $exp) {
                $query->whereJsonContains('experiencia_profissional', $exp);
            }
        }

        // Filtro Cidade
        if ($request->filled('cidade') && $request->cidade !== "Todas") {
            $query->whereHas('contato', function($q) use ($request) {
                $q->where('cidade', 'like', '%'. $request->cidade . '%');
            });
        }

        // Filtro Candidato entrevistado/nao entrevistado/ todos
        if ($request->has('entrevistado') && $request->entrevistado !== "Todos") {
            if ($request->entrevistado == '1') {
                $query->whereHas('interview');
            } elseif ($request->entrevistado == '0') {
                $query->whereDoesntHave('interview');
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

        // Filtro por Data de Cadastro Curriculo (minima)
        if($request->filled('data_min')){
            $query->whereDate('created_at', '>=', $request->data_min);
        }

        if($request->filled('data_max')){
            $query->whereDate('created_at', '<=', $request->data_max);
        }

        // Carregue as relações apenas após aplicar todos os filtros
        $query->with([
            'informacoesPessoais',
            'contato',
            'interview',
            'escolaridade'
        ]);

        //dd($query->toRawSql());

        // Implementar paginação
       $resumes = $query->paginate(50); // Ajustar o numero coforme necessário.    
        
       


        //$resumes = Resume::all();
        return view('resumes.index', compact('resumes', 'form_busca'));
    }

    public function show(Resume $resume)
    {
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

        return view('resumes.show', compact('resume', 'jobs'));
    }

    public function create()
    {
        return view('resumes.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'estado_civil' => 'required|string|max:255',
            'possui_filhos' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'reservista' => 'required|string|max:255',
            'cnh' => 'required|string|max:255',
            //'reservista_outro' => 'required|string|max:255',
            'rg' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
            'instagram' => 'required|string|max:255',
            'linkedin' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'email' => 'required|email|unique:contact_resumes,email',
            'telefone_residencial' => 'nullable|string|max:255', // Telefone de contato
            'nome_contato' => 'nullable|string|max:255',
            'telefone_celular' => 'required|string|max:255',
            'vagas_interesse' => 'nullable',
            'experiencia_profissional' => 'nullable',
            'experiencia_profissional_outro' => 'nullable|string|max:255',
            //'escolaridade' => 'nullable|string|max:255',
            'escolaridade' => 'nullable',
            'escolaridade_outro' => 'nullable|string|max:255',
            //'participou_selecao' => 'nullable|string|max:255',
            //'participou_selecao_outro' => 'nullable|string|max:255',
            'foi_jovem_aprendiz' => 'nullable|string|max:255',
            'informatica' => 'required|string|max:255',
            'ingles' => 'required|string|max:255',
            'tamanho_uniforme' => 'required|string|max:255',
            'curriculo_doc' => 'file|mimes:pdf|max:2048',


        ]);

        //dd($data);

        // Salvando curriculo no banco e movendo arquivo para pasta.
        if($request->hasFile('curriculo_doc') && $request->file('curriculo_doc')->isValid()){

            $file = $request->file('curriculo_doc');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/resumes/curriculos'), $fileName);

            $data['curriculo_doc'] = $fileName;

        } else {

            $data['curriculo_doc'] = '';

        }

        $resume = Resume::create([
            'vagas_interesse' => $data['vagas_interesse'],
            'experiencia_profissional' => $data['experiencia_profissional'],
            'experiencia_profissional_outro' => $data['experiencia_profissional_outro'] ?? '',
            'participou_selecao' => '', // Cliente pediu para retirar
            'participou_selecao_outro' => '', // Cliente pediu para retirar
            'foi_jovem_aprendiz' => $data['foi_jovem_aprendiz'],
            'curriculo_doc' => $data['curriculo_doc'],

        ]);

        $resume->informacoesPessoais()->create([
            'nome' => $data['nome'],
            'data_nascimento' => $data['data_nascimento'],
            'estado_civil' => $data['estado_civil'],
            'possui_filhos' => $data['possui_filhos'],
            'sexo' => $data['sexo'],
            'reservista' => $data['reservista'],
            'reservista_outro' => '',
            'cnh' => $data['cnh'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'instagram' => $data['instagram'],
            'linkedin' => $data['linkedin'],
            'tamanho_uniforme' => $data['tamanho_uniforme'],

        ]);

        $resume->escolaridade()->create([
            'escolaridade' => $data['escolaridade'],
            'escolaridade_outro' => $data['escolaridade_outro'] ?? '',
            'informatica' => $data['informatica'],
            'ingles' => $data['ingles'],

        ]);

        $resume->contato()->create([
            'email' => $data['email'],
            'telefone_residencial' => $data['telefone_residencial'], // Telefone de contato
            'nome_contato' => $data['nome_contato'],
            'telefone_celular' => $data['telefone_celular'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            'cep' => $data['cep'],

        ]);

        // Salvando Log de criação
        $this->logAction('create', 'jobs', $resume->id, 'Resume cadastrado com sucesso.');

        return redirect()->route('resumes.index')->with('success', 'Currículo cadastrado com sucesso!');
    }

    public function edit(Resume $resume)
    {

        $resume->load(['jobs', 'selections']);

        $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');

        $jobAprovado = '';
        if( $temSelecaoAprovada ) {
            $selection = $resume->selections->where('status_selecao', 'aprovado')->first();
            $jobAprovado = $selection->job;
        }

        //dd($jobAprovado);

        $jobs = $resume->jobs;


        //dd($jobs);

        return view('resumes.edit', compact('resume', 'jobs', 'jobAprovado'));
    }

    public function update(Request $request, Resume $resume)
    {

        //dd($request->all());

        $data = $request->validate([

            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'estado_civil' => 'required|string|max:255',
            'possui_filhos' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'reservista' => 'required|string|max:255',
            'cnh' => 'required|string|max:255',
            //'reservista_outro' => 'required|string|max:255',
            'rg' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'email' => 'required|email',
            'telefone_residencial' => 'nullable|string|max:255', // Telefone de contato
            'nome_contato' => 'nullable|string|max:255',
            'telefone_celular' => 'required|string|max:255',
            'vagas_interesse' => 'nullable',
            'experiencia_profissional' => 'nullable',
            'experiencia_profissional_outro' => 'nullable|string|max:255',
            //'escolaridade' => 'nullable|string|max:255',
            'escolaridade' => 'nullable',
            'escolaridade_outro' => 'nullable|string|max:255',
            'participou_selecao' => 'nullable|string|max:255',
            //'participou_selecao_outro' => 'nullable|string|max:255',
            'foi_jovem_aprendiz' => 'nullable|string|max:255',
            'informatica' => 'required|string|max:255',
            'ingles' => 'required|string|max:255',
            'tamanho_uniforme' => 'required|string|max:255',
            'curriculo_doc' => 'file|mimes:pdf,doc,docx|max:2048',

        ]);

        //dd($data);

        $curriculo_atual = $resume->curriculo_doc;

         // Salvando curriculo no banco e movendo arquivo para pasta.
         if($request->hasFile('curriculo_doc') && $request->file('curriculo_doc')->isValid()){
            $file = $request->file('curriculo_doc');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/resumes/curriculos'), $fileName);

            $data['curriculo_doc'] = $fileName;

            if($curriculo_atual){
                unlink(public_path('documents/resumes/curriculos/'. $curriculo_atual));
            }
        } else {
            $data['curriculo_doc'] = $curriculo_atual;
        }


        $resume->update([
            'vagas_interesse' => $data['vagas_interesse'],
            'experiencia_profissional' => $data['experiencia_profissional'],
            'experiencia_profissional_outro' => $data['experiencia_profissional_outro'] ?? '',
            'participou_selecao' => '', // cliente pediu para retirar
            'participou_selecao_outro' => '', // cliente pediu para retirar
            'foi_jovem_aprendiz' => $data['foi_jovem_aprendiz'],
            'curriculo_doc' => $data['curriculo_doc'],

        ]);

        $resume->informacoesPessoais()->update([
            'nome' => $data['nome'],
            'data_nascimento' => $data['data_nascimento'],
            'estado_civil' => $data['estado_civil'],
            'possui_filhos' => $data['possui_filhos'],
            'sexo' => $data['sexo'],
            'reservista' => $data['reservista'],
            'reservista_outro' => '',
            'cnh' => $data['cnh'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'tamanho_uniforme' => $data['tamanho_uniforme'],

        ]);

        $resume->escolaridade()->update([
            'escolaridade' => $data['escolaridade'],
            'escolaridade_outro' => $data['escolaridade_outro'] ?? '',
            'informatica' => $data['informatica'],
            'ingles' => $data['ingles'],

        ]);

        $resume->contato()->update([
            'email' => $data['email'],
            'telefone_residencial' => $data['telefone_residencial'], //Telefone contato
            'nome_contato' => $data['nome_contato'],
            'telefone_celular' => $data['telefone_celular'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            'cep' => $data['cep'],

        ]);



        // Salvando Log de criação
        $this->logAction('update', 'jobs', $resume->id, 'Resume atualizado com sucesso.');

        return redirect()->route('resumes.index')->with('success', 'Currículo atualizado com sucesso!');
    }

    public function destroy(Resume $resume)
    {
        // Excluindo arquivo fisico curriculo
        if($resume->curriculo_doc){
            $curriculo_path = public_path('documents/resumes/curriculos/'. $resume->curriculo_doc);
            if(file_exists($curriculo_path)){
                unlink($curriculo_path);
            }
        }

        // Excluindo informaçõe pessoais
        if($resume->informacoesPessoais){
            $resume->informacoesPessoais->delete();
        }

        // Excluindo informações academicas
        if($resume->escolaridade){
            $resume->escolaridade->delete();
        }

        // Excluindo informações contato
        if($resume->contato){
            $resume->contato->delete();
        }

        // Excluindo informações entrevista
        if($resume->interview){
            $resume->interview->delete();
        }

        // Excluindo Seleções
        if($resume->selections->count() > 0){
            foreach ($resume->selections as $selection){
                $selection->delete();
            }
        }

        // Excluindo observações
        if($resume->observacoes->count() > 0){
            foreach($resume->observacoes as $observacoes){
                $observacoes->delete();
            }
        }

        // Removendo associaç~eos com jobs
        $resume->jobs()->detach();
    
        $resume->delete();

        // Salvando Log de criação
        $this->logAction('delete', 'jobs', $resume->id, 'Resume excluído.');

        return redirect()->route('resumes.index')->with('success', 'Currículo excluído com sucesso!');
    }

    // Cadastro de currículos vindos de formulário externo ao sistema.
    /**
     * Rota está a api.php, vou usar o recurso de token secreto.
     * Vou deixar um formulário de amostra na raiz
     */
    public function storeExternalResume(Request $request)
    {
        // Verifica a origem da requisição
        $token = $request->header('X-External-Token');
        $allowedToken = config('services.external_resume.token'); // Salve o token no arquivo .env

        if ($token !== $allowedToken){
            return response()->json(['error' => 'Token inválido.'], 403);
        }

        // Validar o dados recebidos
        $validator = Validator::make($request->all(),[
            'nome_candidato' => 'required|string|max:255',
            'idade' => 'required|integer|min:1',
            'experiencia' => 'nullable|string',
            'email' => 'required|email|unique:resumes,email',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Salva os dados no banco

        $resume = Resume::create([
            'nome_candidato' => $request->input('nome_candidato'),
            'idade' => $request->input('idade'),
            'experiencia' => $request->input('experiencia'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'endereco' => $request->input('endereco'),
        ]);

        // Retorna a resposta
        return response()->json(['message' => 'Currículo enviado com sucesso!', 'resume' => $resume], 201);

    }


    // Cadastro de observações sobre o candidato. Parecido com de Vagas.
    public function storeHistory(Request $request, $resumeId)
    {
        //dd($resumeId);
        $data = $request->validate([
            'observacao' => 'required|string',
        ]);

        $resume = Resume::find($resumeId);

        $resume->observacoes()->create([
            'observacao' => $data['observacao'],
        ]);

        return redirect()->back()->with('success', 'Observação cadastrada com sucesso!');
    }

    public function deleteTeste()
    {
        //$resumes = range(17696, 17840);
        //dd($resumes);
        // Caroline
       
        
        // foreach($resumes as $resume_id){
        //     $resume = Resume::find($resume_id);
        //     $resume->delete();

        // }



        return redirect()->route('resumes.index');

    }

    public function updateStatus(Request $request, $id) 
    {
        //dd($request->all());
        $resume = Resume::findOrfail($id);
        $oldStatus = $resume->status;
        $newStatus = $request->status == 'ativo' ? 'ativo' : 'inativo';

        $resume->status = $newStatus;
        $resume->save();

        // Se o status for alterado para inativo, desassocia de toda as vagas
        if( $oldStatus == 'ativo' && $newStatus == 'inativo') {
            $resume->jobs()->detach();

             // Salvando Log de criação
            $this->logAction('update', 'jobs', $resume->id, 'Curriculo foi inativado e desassociado de todas as vagas.');
            return redirect()->back()->with('success', 'Status alterado para Inativo. O currículo foi desassociado de todas as vagas.');

        }

        return redirect()->back()->with('success', 'Status alterado com sucesso para ' . ucfirst($newStatus) . '.');
    }


}
