<?php

namespace App\Imports;

use App\Models\Resume;
//use Illuminate\Support\Facades\Date as FacadesDate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ResumesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{

            // Criar um canal de log personalizado para importação de curriculos
            $log = Log::channel('importacaoResumes');
    
            // Tratando datas
            $created_at = isset($row['created_at']) ? Date::excelToDateTimeObject($row['created_at']) : now();


            $data_nascimento = now();
            if (isset($row['data_nascimento']) && is_numeric($row['data_nascimento'])) {
                $data_nascimento = Date::excelToDateTimeObject($row['data_nascimento']);
            }

            //$data_nascimento = isset($row['data_nascimento']) ? Date::excelToDateTimeObject($row['data_nascimento']): now();
            
            // Limpando código unico
            $codigo_unico = ltrim($row['codigo_unico'] ?? '', '0');

            // convertendo para array vagas_interesse
            $vagas_interesse = [];
            if (!empty($row['vagas_interesse'])) {
                $vagas_interesse = array_map('trim', explode(',', $row['vagas_interesse']));
            }
            //$vagas_interesse = explode(', ', trim($row['vagas_interesse']));

            // convertendo para array experiencia
            if (!empty($row['experiencia_profissional'])) {
                $experiencia_profissional = array_map('trim', explode(',', $row['experiencia_profissional']));    
            }
            //$experiencia_profissional = explode(', ', trim($row['experiencia_profissional']));
            
            $observacao = trim($row['obs']) ?? '';       
            
            // Escolaridade
            $formacao = trim($row['escolaridade']);
            $lista_escolaridade = ['Ensino Médio Incompleto', 'Ensino Médio Completo'];
            
            if(in_array($formacao, $lista_escolaridade)){
                $escolaridade = array($formacao);
                $escolaridade_outro = null;
            } else {
                $escolaridade = 'Outro';
                $escolaridade_outro = $formacao;
            }
    
            // Ja foi Jovem aprendiz
    
            $jovem_aprendiz = trim($row['ja_foi_jovem_aprendiz']);
    
            if( $jovem_aprendiz == 'SIM' || $jovem_aprendiz == 'Sim, da ASPPE'){
                $foi_jovem_aprendiz = 'Sim, da ASPPE';
            } elseif ( $jovem_aprendiz == 'Sim, de Outra Qualificadora'){
                $foi_jovem_aprendiz = 'Sim, de Outra Qualificadora';
            } else {
                $foi_jovem_aprendiz = 'Não';
            }
    

            /**
             * Tratando campo reservista
             * Regra: o que for diferente de 'Sim' ou 'Não' colocar 'Em andamento' 
             */

            $reservista_excel = trim($row['reservista']);

            if($reservista_excel == 'Sim') {
                $reservista = 'Sim';
            } elseif ($reservista_excel == 'Não') {
                $reservista = 'Não';
            } else {
                $reservista = 'Em andamento';
            }
    


            /**
             * Tratando ingles e informática
             */
            $ingles_excel = trim($row['ingles']);

            if($ingles_excel == 'Básico'){
                $ingles = 'Básico';
            } elseif($ingles_excel == 'Intermediário'){
                $ingles = 'Intermediário';
            } elseif($ingles_excel == 'Avançado'){
                $ingles = 'Avançado';
            } else {
                $ingles = 'Nenhum';
            }


            $informatica_excel = trim($row['informatica']);
             
            if($informatica_excel == 'Básico'){
                $informatica = 'Básico';
            } elseif($informatica_excel == 'Intermediário'){
                $informatica = 'Intermediário';
            } elseif($informatica_excel == 'Avançado'){
                $informatica = 'Avançado';
            } else {
                $informatica = 'Nenhum';
            }
             
            //$vagas = explode(', ' , $vagas_interesse);
    
    
            //dd($vagas_interesse);
            //dd($row);
    
            
            $resume = Resume::create([
                'vagas_interesse' => $vagas_interesse ?? null,
                'experiencia_profissional' => $experiencia_profissional ?? null,                        
                'foi_jovem_aprendiz' => $foi_jovem_aprendiz,
                'status' => trim($row['status']) == 'inativo' ? 'inativo' : 'ativo',
                'created_at' => $created_at,
                'codigo_unico' => $codigo_unico,
                'curriculo_externo' => trim($row['curriculo_externo']) ?? 'N/A',            
    
            ]);
    
            $resume->informacoesPessoais()->create([
                'nome' => trim($row['nome']) ?? 'N/A',
                'data_nascimento' => $data_nascimento,
                'estado_civil' => trim($row['estado_civil']) ?? 'N/A',
                'possui_filhos' => trim($row['possui_filhos']) ?? 'N/A',
                'sexo' => trim($row['genero']) ?? 'N/A',
                'reservista' => $reservista,
                'reservista_outro' => '',
                'cnh' => 'Não',
                'rg' => trim($row['rg']) ?? 'N/A',
                'cpf' => trim($row['cpf']) ?? 'N/A',
                //'instagram' => $data['instagram'],
                //'linkedin' => $data['linkedin'],
                'tamanho_uniforme' => trim($row['tamanho_uniforme']) ?? 'N/A',
                'created_at' => $created_at,
    
            ]);
    
            $resume->escolaridade()->create([
                'escolaridade' => $escolaridade,
                'escolaridade_outro' => $escolaridade_outro,
                'informatica' => $informatica,
                'ingles' => $ingles,
                'created_at' => $created_at,
    
            ]);
    
            $resume->contato()->create([
                'email' => trim($row['e_mail']) ?? 'N/A',
                'telefone_residencial' => trim($row['telefone_contato'])  ?? 'N/A', // Telefone de contato
                //'nome_contato' => $data['nome_contato'],
                'telefone_celular' => trim($row['whatsapp']) ?? 'N/A',
                'logradouro' => trim($row['endereco']) ?? 'N/A',
                'numero' => 'N/A',
                'complemento' => null,
                'bairro' => trim($row['bairro']) ?? 'N/A',
                'cidade' => trim($row['cidade']) ?? 'N/A',
                'uf' => 'N/A',
                'cep' => 'N/A',
                'created_at' => $created_at,
    
            ]);
    
            // $resume->interview()->create([
            //     'familia_crass' => trim($row['cras']) ?? 'N/A',
            //     'fonte_curriculo' => trim($row['fonte']) ?? 'N/A',
            //     'recruiter_id' => 17,
            //     'created_at' => $created_at,
            // ]);
    
            if(isset($observacao) && $observacao != ''){
                $resume->observacoes()->create([
                    'observacao' => $observacao,
                    'created_at' => $created_at,
                ]);
    
            }
    
    
            // if(!$resume) {
            //     $log->error("Currículo não cadastrado código unico: $codigo_unico");
            //     return null;
            // }
    
            return $resume;

        } catch (\Exception $e) {
            $linhaErro = "Erro na linha: " . json_encode($row) . "\n";
            $linhaErro .= "Mensagem: " . $e->getMessage() . "\n";
            $linhaErro .= "Arquivo: " . $e->getFile() . ":" . $e->getLine() . "\n\n";

            Storage::append('import_erros_resumes.txt', $linhaErro); // salva em storage/app/import_erros_resumes.txt
        }

        
    }
}
