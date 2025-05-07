<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;


class PublicResumeController extends Controller
{
    use LogsActivity;

    public function create()
    {
        return view('publicResume.index');
    }

    public function store(Request $request)
    {
        //dd('chegou');
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
            'cpf' => 'required|string|max:255|unique:personal_info_resumes,cpf',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
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
        ],[
            'cpf.unique' =>'Currículo já cadastrado neste CPF.'
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
        $this->logAction('create', 'jobs', $resume->id, 'Currículo cadastrado pelo candidado com sucesso.');

        
        return view('publicResume.confirmacao');
    }
}
