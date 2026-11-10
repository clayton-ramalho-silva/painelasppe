<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class PublicResumeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /** Verdadeiro se a opção de escolaridade foi marcada no formulário. */
    private function escolaridadeMarcada(string $valor): bool
    {
        return in_array($valor, (array) $this->input('escolaridade', []), true);
    }

    /** "Obrigatório se a opção X de escolaridade estiver marcada". */
    private function seEscolaridade(string $valor): RequiredIf
    {
        return Rule::requiredIf(fn () => $this->escolaridadeMarcada($valor));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obs.: não usar "required_if:pcd,Sim, com laudo." — a vírgula do valor
        // quebra o parse do required_if. Por isso os closures abaixo.
        $menorDeIdade = fn () => ($this->date('data_nascimento')?->age ?? 99) < 18;

        return [
            // ---------- Dados pessoais ----------
            'nome' => 'required|string|max:255',
            'cpf' => [
                'required',
                'string',
                'max:255',
                new \App\Rules\UniqueCpf('personal_info_resumes'),
            ],
            'rg' => 'nullable|string|max:255', // opcional
            'cnh' => 'required|string|max:255',
            // O tipo de CNH aparece (e é obrigatório) se possui CNH ou se está em andamento
            'tipo_cnh' => [
                Rule::requiredIf(fn () => in_array($this->input('cnh'), ['Sim', 'Em andamento'], true)),
                'nullable', 'string', 'max:255',
            ],
            'data_nascimento' => 'required|date',
            'nacionalidade' => 'required|string|max:500',
            'estado_civil' => 'required|string|max:255',
            'reservista' => 'required|string|max:255',
            'possui_filhos' => 'required|string|max:255',
            'filhos_qtd' => ['required_if:possui_filhos,Sim', 'nullable', 'string', 'max:255'],
            'filhos_sim' => ['required_if:possui_filhos,Sim', 'nullable', 'string', 'max:255'], // idade
            'sexo' => 'required|string|max:255',
            'sexo_outro' => ['required_if:sexo,Outro', 'nullable', 'string', 'max:255'],
            'pcd' => 'required|string|max:255',
            // CID: o campo aparece para "Sim, ..." mas só é obrigatório quando "com laudo"
            'pcd_sim' => [
                Rule::requiredIf(fn () => $this->input('pcd') === 'Sim, com laudo.'),
                'nullable', 'string', 'max:255',
            ],

            // ---------- Endereço ----------
            'cep' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255', // opcional
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',

            // ---------- Contato ----------
            'email' => [
                'required',
                'email',
                new \App\Rules\UniqueEmail('contact_resumes'),
            ],
            'instagram' => 'nullable|string|max:255', // opcional
            'linkedin' => 'nullable|string|max:255', // opcional
            'telefone_celular' => 'required|string|max:255',
            'telefone_residencial' => 'required|string|max:255', // Telefone de recado
            'nome_contato' => 'required|string|max:255',

            // ---------- Vagas / experiência ----------
            'vagas_interesse' => 'required|array|min:1',
            'vagas_interesse.*' => 'string|max:255',
            'experiencia_profissional' => 'required|array|min:1',
            'experiencia_profissional.*' => 'string|max:255',
            'experiencia_profissional_outro' => [
                Rule::requiredIf(fn () => in_array('Outro', (array) $this->input('experiencia_profissional', []), true)),
                'nullable', 'string', 'max:255',
            ],

            // ---------- Escolaridade ----------
            'escolaridade' => 'required|array|min:1',
            'escolaridade.*' => 'string|max:255',

            // Fundamental cursando
            'fundamental_periodo'    => [$this->seEscolaridade('Ensino Fundamental Cursando'), 'nullable', 'string', 'max:255'],
            'fundamental_modalidade' => [$this->seEscolaridade('Ensino Fundamental Cursando'), 'nullable', 'string', 'max:255'],

            // Médio cursando (o valor gravado é "Ensino Médio Incompleto")
            'medio_periodo'    => [$this->seEscolaridade('Ensino Médio Incompleto'), 'nullable', 'string', 'max:255'],
            'medio_modalidade' => [$this->seEscolaridade('Ensino Médio Incompleto'), 'nullable', 'string', 'max:255'],

            // Técnico completo
            'tecnico_completo_curso'          => [$this->seEscolaridade('Ensino Técnico Completo'), 'nullable', 'string', 'max:255'],
            'tecnico_completo_instituicao'    => [$this->seEscolaridade('Ensino Técnico Completo'), 'nullable', 'string', 'max:255'],
            'tecnico_completo_data_conclusao' => [$this->seEscolaridade('Ensino Técnico Completo'), 'nullable', 'string', 'max:255'],

            // Técnico cursando
            'tecnico_curso'       => [$this->seEscolaridade('Ensino Técnico Cursando'), 'nullable', 'string', 'max:255'],
            'tecnico_semestre'    => [$this->seEscolaridade('Ensino Técnico Cursando'), 'nullable', 'string', 'max:255'],
            'tecnico_instituicao' => [$this->seEscolaridade('Ensino Técnico Cursando'), 'nullable', 'string', 'max:255'],
            'tecnico_periodo'     => [$this->seEscolaridade('Ensino Técnico Cursando'), 'nullable', 'string', 'max:255'],
            'tecnico_modalidade'  => [$this->seEscolaridade('Ensino Técnico Cursando'), 'nullable', 'string', 'max:255'],

            // Superior completo
            'superior_completo_curso'          => [$this->seEscolaridade('Superior Completo'), 'nullable', 'string', 'max:255'],
            'superior_completo_instituicao'    => [$this->seEscolaridade('Superior Completo'), 'nullable', 'string', 'max:255'],
            'superior_completo_data_conclusao' => [$this->seEscolaridade('Superior Completo'), 'nullable', 'string', 'max:255'],

            // Superior cursando (superior_semestre guarda a MODALIDADE)
            'superior_curso'       => [$this->seEscolaridade('Superior Cursando'), 'nullable', 'string', 'max:255'],
            'superior_termo'       => [$this->seEscolaridade('Superior Cursando'), 'nullable', 'string', 'max:255'],
            'superior_instituicao' => [$this->seEscolaridade('Superior Cursando'), 'nullable', 'string', 'max:255'],
            'superior_periodo'     => [$this->seEscolaridade('Superior Cursando'), 'nullable', 'string', 'max:255'],
            'superior_semestre'    => [$this->seEscolaridade('Superior Cursando'), 'nullable', 'string', 'max:255'],

            // Outro (o campo "semestre" guarda a MODALIDADE; "outro_modalidade" é mantido por compatibilidade)
            'outro_modalidade'   => 'nullable|string|max:255',
            'escolaridade_outro' => [$this->seEscolaridade('Outro'), 'nullable', 'string', 'max:255'],
            'instituicao'        => [$this->seEscolaridade('Outro'), 'nullable', 'string', 'max:255'],
            'outro_periodo'      => [$this->seEscolaridade('Outro'), 'nullable', 'string', 'max:255'],
            'semestre'           => [$this->seEscolaridade('Outro'), 'nullable', 'string', 'max:255'],

            // ---------- Perfil ----------
            'foi_jovem_aprendiz' => 'required|string|max:255',
            'informatica' => 'required|string|max:255',
            'ingles' => 'required|string|max:255',
            'cras' => 'required|string|max:255',
            'fonte' => 'required|string|max:255',

            // ---------- Arquivo e autorizações ----------
            'curriculo_doc' => 'required|file|mimes:pdf|max:2048',
            'autorizacao_uso_dados' => 'accepted',
            'autorizacao_responsavel_menor' => [Rule::requiredIf($menorDeIdade), 'nullable'],
        ];
    }

    /**
     * Nomes amigáveis para o :attribute das mensagens genéricas.
     */
    public function attributes(): array
    {
        return [
            'nome' => 'nome',
            'cpf' => 'CPF',
            'cnh' => 'CNH',
            'tipo_cnh' => 'tipo de CNH',
            'data_nascimento' => 'data de nascimento',
            'estado_civil' => 'estado civil',
            'possui_filhos' => 'possui filhos',
            'filhos_qtd' => 'quantidade de filhos',
            'filhos_sim' => 'idade dos filhos',
            'sexo' => 'gênero',
            'sexo_outro' => 'gênero (outro)',
            'pcd' => 'PCD',
            'pcd_sim' => 'número do CID',
            'cep' => 'CEP',
            'logradouro' => 'rua',
            'numero' => 'número',
            'uf' => 'estado',
            'telefone_celular' => 'telefone celular',
            'telefone_residencial' => 'telefone para recado',
            'nome_contato' => 'nome para recado',
            'vagas_interesse' => 'vagas de interesse',
            'experiencia_profissional' => 'experiência profissional',
            'experiencia_profissional_outro' => 'experiência profissional (qual)',
            'foi_jovem_aprendiz' => 'foi jovem aprendiz',
            'informatica' => 'conhecimento em informática',
            'ingles' => 'conhecimento em inglês',
            'fonte' => 'como ficou sabendo do programa',

            'fundamental_periodo' => 'período (fundamental)',
            'fundamental_modalidade' => 'modalidade (fundamental)',
            'medio_periodo' => 'período (médio)',
            'medio_modalidade' => 'modalidade (médio)',
            'tecnico_completo_curso' => 'curso técnico',
            'tecnico_completo_instituicao' => 'instituição (técnico completo)',
            'tecnico_completo_data_conclusao' => 'data de conclusão (técnico)',
            'tecnico_curso' => 'curso técnico',
            'tecnico_semestre' => 'semestre (técnico)',
            'tecnico_instituicao' => 'instituição (técnico)',
            'tecnico_periodo' => 'período (técnico)',
            'tecnico_modalidade' => 'modalidade (técnico)',
            'superior_completo_curso' => 'curso superior',
            'superior_completo_instituicao' => 'instituição (superior completo)',
            'superior_completo_data_conclusao' => 'data de conclusão (superior)',
            'superior_curso' => 'curso superior',
            'superior_termo' => 'semestre (superior)',
            'superior_instituicao' => 'instituição (superior)',
            'superior_periodo' => 'período (superior)',
            'superior_semestre' => 'modalidade (superior)',
            'escolaridade_outro' => 'curso (outro)',
            'instituicao' => 'instituição (outro)',
            'outro_periodo' => 'período (outro)',
            'semestre' => 'modalidade (outro)',
        ];
    }

    public function messages(): array
    {
        return [
            // Mensagens genéricas: valem para todos os campos (usam o attributes() acima)
            'required'    => 'O campo :attribute é obrigatório.',
            'required_if' => 'O campo :attribute é obrigatório.',

            // Específicas
            'escolaridade.required' => 'O campo Escolaridade é obrigatório.',
            'escolaridade.min' => 'Selecione ao menos uma opção de escolaridade.',
            'vagas_interesse.min' => 'Selecione ao menos uma vaga de interesse.',
            'experiencia_profissional.min' => 'Selecione ao menos uma opção de experiência.',
            'curriculo_doc.mimes' => 'O arquivo deve ser em formato PDF.',
            'curriculo_doc.max' => 'O arquivo deve ter no máximo 2MB.',
            'curriculo_doc.required' => 'O currículo é obrigatório.',
            'cpf.unique' => 'Currículo já cadastrado neste CPF.',
            'email.unique' => 'E-mail já cadastrado.',
            'autorizacao_uso_dados.accepted' => 'É necessária a autorização do uso de dados.',
            'autorizacao_responsavel_menor.required' => 'É necessária a ciência do responsável legal para menores de 18 anos.',
        ];
    }
}
