<?php

namespace App\Imports;

use App\Models\Interview;
use App\Models\Resume;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InterviewsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {        
        //dd($row);
       
        if(empty(array_filter($row))) {
            return null;
        }
        //dd($row);
        // Limpando código unico
        // $codigo_unico = ltrim($row['codigo_unico'] ?? '', '0');     
        
        // teste codigo unico
        // if(!$codigo_unico){
        //     $nome = trim($row['nome']);
        //     $linhaerro = "Código não encontrato: $codigo_unico \n";
        //     $linhaerro .= "Linha:  $nome \n";
        //     Storage::append('import_erros_interview_codigo_unico_temp.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
        //     return null;
        // }

        // $resume = Resume::where('codigo_unico', $codigo_unico)->first();
        // dd($resume->informacoesPessoais->nome);


         // teste codigo unico
        //  if(!$resume){
        //     $nome = trim($row['nome']);
        //     $linhaerro = "Curriculo não encontrado: $codigo_unico \n";
        //     $linhaerro .= "Linha:  $nome \n";
        //     Storage::append('import_erros_interview_resume_nao_temp.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
        //     return null;
        // }


        // if($resume){
        //     $nome = trim($row['nome']);
        //     $linhaerro = "Curriculo cadastrado: $codigo_unico \n";
        //     $linhaerro .= "Linha:  $nome \n";
        //     $linhaerro .= "Resume id: $resume->id \n";
        //     Storage::append('import_erros_interview_surya_cadastrado.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
        // }


        /** RESUME */
                // Tratando datas
                  // Tratando data Entrevista, será guardado no created_at
                $data_entrevista = now()->format('Y-m-d');
                $hora_entrevista = '00:00:00';

                // Se for data válida no Excel
                if (isset($row['data_entrevista']) && is_numeric($row['data_entrevista'])) {
                    $data_entrevista = Date::excelToDateTimeObject($row['data_entrevista'])->format('Y-m-d');
                }

                // Se for hra válida no Excel
                if (isset($row['hora_entrevista']) && is_numeric($row['hora_entrevista'])) {
                    $hora_entrevista = Date::excelToDateTimeObject($row['hora_entrevista'])->format('H:i:s');
                }

                // JUnta os dois e cria um objeto DateTime
                $data_hora_entrevista = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', "$data_entrevista $hora_entrevista");

                $row['data_entrevista'] = $data_hora_entrevista;
                $created_at = $data_hora_entrevista;


                $data_nascimento = now();
                if (isset($row['data_nascimento']) && is_numeric($row['data_nascimento'])) {
                    $data_nascimento = Date::excelToDateTimeObject($row['data_nascimento']);
                }  
                
                
                // Escolaridade
                $formacao = trim($row['escolaridade']);
                $lista_escolaridade = ['Ensino Médio Incompleto', 'Ensino Médio Completo'];
                
                if(in_array($formacao, $lista_escolaridade)){
                    $escolaridade = array($formacao);
                    $escolaridade_outro = null;
                } else {
                    $escolaridade = 'Outro';
                    $escolaridade_outro = trim($row['escolaridade_outro']);
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
                $ingles_excel = strtolower(trim($row['ingles']));

                if($ingles_excel == 'básico'){
                    $ingles = 'Básico';
                } elseif($ingles_excel == 'intermediário'){
                    $ingles = 'Intermediário';
                } elseif($ingles_excel == 'avançado'){
                    $ingles = 'Avançado';
                } else {
                    $ingles = 'Nenhum';
                }


                $informatica_excel = strtolower(trim($row['informatica']));
                
                if($informatica_excel == 'básico'){
                    $informatica = 'Básico';
                } elseif($informatica_excel == 'intermediário'){
                    $informatica = 'Intermediário';
                } elseif($informatica_excel == 'avançado'){
                    $informatica = 'Avançado';
                } else {
                    $informatica = 'Nenhum';
                }   
                
                $cnh_tabela = trim($row['cnh']);
                if($cnh_tabela == 'Sim'){
                    $cnh = 'Sim';
                } elseif ($cnh_tabela == 'Não'){
                    $cnh = 'Não';
                } else {
                    $cnh = 'Andamento';
                }
                
                
                $telefones = explode(',', trim($row['telefones']));  
                $telefone_celular = $telefones[0] ?? '';
                $telefone_contato = $telefones[1] ?? '';      
                
                
                $resume = Resume::create([                                     
                    'curriculo_externo' => trim($row['curriculo_externo']) ?? 'N/A',  
                    'created_at' => $created_at,                   
                    
                ]);

                $resume->informacoesPessoais()->create([
                    'nome' => trim($row['nome']) ?? 'N/A',
                    'data_nascimento' => $data_nascimento,                   
                    'sexo' => trim($row['genero']) ?? 'N/A',
                    'reservista' => $reservista,                 
                    'cnh' => $cnh,                                                           
                    'foto_candidato_externa' => trim($row['foto']) ?? 'N/A',          
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
                    'telefone_residencial' => $telefone_contato, // Telefone de contato
                    'telefone_celular' => $telefone_celular,                    
                    'logradouro' => trim($row['endereco']) ?? 'N/A',                    
                    'bairro' => trim($row['bairro']) ?? 'N/A',
                    'cidade' => trim($row['cidade']) ?? 'N/A',                    
                    'created_at' => $created_at,

                ]);


        /** FIM RESUME */
        
        if($resume){            
            //dd($row);

            // jovem aprendiz e formadora   
            $ja_foi_jovem_aprendiz = trim($row['ja_foi_jovem_aprendiz']);           

            if(
                $ja_foi_jovem_aprendiz == 'NÃO' || 
                $ja_foi_jovem_aprendiz == 'Não' ||
                $ja_foi_jovem_aprendiz == 'não'
            ){
                $qual_formadora = 'N/A';
            } else {
                $qual_formadora = trim($row['qual_formadora']) ?? null;
            }

            // observações

            $observacao = trim($row['entrevistas'])."\n";
            $observacao .= trim($row['obs']) ?? 'N/A';


            //  // Tratando data Entrevista, será guardado no created_at
            // $data_entrevista = now()->format('Y-m-d');
            // $hora_entrevista = '00:00:00';

            // // Se for data válida no Excel
            // if (isset($row['data_entrevista']) && is_numeric($row['data_entrevista'])) {
            //     $data_entrevista = Date::excelToDateTimeObject($row['data_entrevista'])->format('Y-m-d');
            // }

            // // Se for hra válida no Excel
            // if (isset($row['hora_entrevista']) && is_numeric($row['hora_entrevista'])) {
            //     $hora_entrevista = Date::excelToDateTimeObject($row['hora_entrevista'])->format('H:i:s');
            // }

            // // JUnta os dois e cria um objeto DateTime
            // $data_hora_entrevista = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', "$data_entrevista $hora_entrevista");

            // $row['data_entrevista'] = $data_hora_entrevista;

            $interview = $resume->interview()->updateOrCreate(
                [
                    'resume_id' => $resume->id,
                ],
                [
                    'saude_candidato' => trim($row['saude']) ?? 'N/A',
                    'vacina_covid' => trim($row['vacina'])  ?? 'N/A',
                    'perfil' => trim($row['perfil'])  ?? 'N/A',
                    'perfil_santa_casa' => trim($row['perfil_santa_casa'])  ?? 'N/A',
                    'classificacao'  => trim($row['classificacao'])  ?? 'N/A',
                    'qual_formadora' => $qual_formadora, 
                    'parecer_recrutador' => trim($row['parecer_entrevistador'])  ?? 'N/A', 
                    'curso_extracurricular' => trim($row['curso_extracurricular'])  ?? 'N/A', 
                    'apresentacao_pessoal' => trim($row['apresentacao_pessoal'])  ?? 'N/A', 
                    'experiencia_profissional' => trim($row['experiencia_profissional'])  ?? 'N/A', 
                    'caracteristicas_positivas' => trim($row['caracteristicas_positivas'])  ?? 'N/A', 
                    'habilidades' => trim($row['habilidades'])  ?? 'N/A', 
                    'porque_ser_jovem_aprendiz' => trim($row['por_que_gostaria_ser_jovem_aprendiz'])  ?? 'N/A', 
                    'qual_motivo_demissao' => trim($row['por_qual_motivo_pediria_demissao'])  ?? 'N/A', 
                    'pretencao_candidato' => trim($row['pretencao_candidato'])  ?? 'N/A', 
                    'objetivo_longo_prazo' => trim($row['objetivos_longo_prazo'])  ?? 'N/A', 
                    'pontos_melhoria' => trim($row['pontos_melhorias'])  ?? 'N/A', 
                    'familia' => trim($row['familia'])  ?? 'N/A', 
                    'disponibilidade_horario' => trim($row['disponibilidade'])  ?? 'N/A', 
                    'sobre_candidato' => trim($row['fale_um_pouco_vc'])  ?? 'N/A', 
                    'rotina_candidato' => trim($row['qual_sua_rotina'])  ?? 'N/A', 
                    'familia_cras' => trim($row['cras'])  ?? 'N/A',
                    'outros_idiomas' => trim($row['outros_idiomas'])  ?? 'N/A', 
                    'fonte_curriculo' => trim($row['fonte_curriculo'])  ?? 'N/A',
                    'sugestao_empresa' => trim($row['sugestao'])  ?? 'N/A', 
                    'observacoes' => $observacao  ?? 'N/A', 
                    'pontuacao' => trim($row['pontuacao'])  ?? '0',                      
                    'resume_id' => $resume->id,
                    'recruiter_id' => trim($row['entrevistador']), // joe doe temp
                    'created_at' => $data_hora_entrevista,
                ]
            );

            if(!$interview){
                $nome = trim($row['nome']);
                $linhaerro = "Entrevista não cadastrada: Candidato: $nome, Resume id: $resume->id \n";
                Storage::append('surya-teste.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
                return null;
            }            

            if($interview){
                $nome = trim($row['nome']);
                $linhaerro = "Entrevista e resume cadastrada: Entrevista id: $interview->id , Candidato: $nome, Resume id: $resume->id \n";
                Storage::append('surya-teste.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
                return null;
            }            

            return $interview;


        } else {
            $nome = trim($row['nome']);            
            $linhaerro = "Não cadastrou o resume:  Linha:  $nome \n";
            Storage::append('surya-teste.txt', $linhaerro); // salva em storage/app/import_erros_resumes.txt
            return null;
        }          
    }
}
