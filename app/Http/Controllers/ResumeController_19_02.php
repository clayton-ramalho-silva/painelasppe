<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $resumes = Resume::all();
        return view('resumes.index', compact('resumes'));
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
            'email' => 'required|email|unique:contact_resumes,email',            
            'telefone_residencial' => 'required|string|max:255',
            'telefone_celular' => 'required|string|max:255',
            'vagas_interesse' => 'nullable',
            'experiencia_profissional' => 'nullable',
            //'experiencia_profissional_outro' => 'nullable|string|max:255',
            'escolaridade' => 'nullable|string|max:255',
            'participou_selecao' => 'nullable|string|max:255',
            //'participou_selecao_outro' => 'nullable|string|max:255',
            'foi_jovem_aprendiz' => 'nullable|string|max:255',
            'informatica' => 'required|string|max:255',
            'ingles' => 'required|string|max:255',
            'tamanho_uniforme' => 'required|string|max:255',            
            'curriculo_doc' => 'file|mimes:pdf,doc,docx|max:2048',

            
        ]);

        //dd($data);

        // Salvando curriculo no banco e movendo arquivo para pasta.
        if($request->hasFile('curriculo_doc') && $request->file('curriculo_doc')->isValid()){
            $file = $request->file('curriculo_doc');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/resumes/curriculos'), $fileName);

            $data['curriculo_doc'] = $fileName;
        }

        $resume = Resume::create([
            'vagas_interesse' => $data['vagas_interesse'],
            'experiencia_profissional' => $data['experiencia_profissional'],
            'experiencia_profissional_outro' => '',
            'participou_selecao' => $data['participou_selecao'],
            'participou_selecao_outro' => '',
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
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'tamanho_uniforme' => $data['tamanho_uniforme'],

        ]);

        $resume->escolaridade()->create([
            'escolaridade' => $data['escolaridade'],
            'escolaridade_outro' => '',
            'informatica' => $data['informatica'],
            'ingles' => $data['ingles'],            

        ]);

        $resume->contato()->create([
            'email' => $data['email'],
            'telefone_residencial' => $data['telefone_residencial'],
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
        return view('resumes.edit', compact('resume'));
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
            'telefone_residencial' => 'required|string|max:255',
            'telefone_celular' => 'required|string|max:255',
            'vagas_interesse' => 'nullable',
            'experiencia_profissional' => 'nullable',
            //'experiencia_profissional_outro' => 'nullable|string|max:255',
            'escolaridade' => 'nullable|string|max:255',
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
            'experiencia_profissional_outro' => '',
            'participou_selecao' => $data['participou_selecao'],
            'participou_selecao_outro' => '',
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
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'tamanho_uniforme' => $data['tamanho_uniforme'],

        ]);

        $resume->escolaridade()->update([
            'escolaridade' => $data['escolaridade'],
            'escolaridade_outro' => '',
            'informatica' => $data['informatica'],
            'ingles' => $data['ingles'],            

        ]);

        $resume->contato()->create([
            'email' => $data['email'],
            'telefone_residencial' => $data['telefone_residencial'],
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
}
