<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Resume;
use App\Models\Selection;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class SelectionController extends Controller
{
    use LogsActivity;
    /**
     * Processo Seletivo 
     * */
    
    // Primeira interação no processo seletivo
    public function storeSelection(Request $request )
    {       
        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'resume_id' => 'required|exists:resumes,id',
            'status_selecao' => 'required|string|max:255',
            'avaliacao' => 'nullable|boolean',
            'observacao' => 'nullable|string',            
        ]);

               
        $selection = Selection::create($data);

        // Reprovado com avaliação positiva. Volta a ficar disponível.
        if($selection->status_selecao == 'reprovado' && $selection->avaliacao == 1) {
            
            // Atualiza o status e grava observação no curriculo
            $resume = $selection->resume;
            $resume->update([
                'status' => 'ativo',                
            ]);

            $resume->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);

            // Grava observação na vaga
            $job = $selection->job;
            $job->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);


            $this->desassociarVaga($data['job_id'], $data['resume_id']);

            return redirect()->back()->with('success', 'Candidato reprovado com avaliação positiva!');  
        }

        // Reprovado com avaliação negativa. Fica INATIVO.
        if($selection->status_selecao == 'reprovado' && $selection->avaliacao == 0) {

            // Atualiza o status e grava observação no curriculo
            $resume = $selection->resume;
            $resume->update([
                'status' => 'inativo',                
            ]);

            $resume->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);
            
            // Grava observação na vaga
            $job = $selection->job;
            $job->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);


            $this->desassociarVaga($data['job_id'], $data['resume_id']);

            return redirect()->back()->with('success', 'Candidato reprovado com avaliação negativa!');  
        }

        if($selection->status_selecao == 'aprovado'){
            
            $job = $selection->job;                        
            $job->updateStatus();


            if ($job->status == 'aberta') {
                $job->filled_positions += 1;
                $job->updateStatus();
                $selection->status_contratacao = 'Contratado';
                $selection->update();

                // Atualiza o status e grava observação no curriculo
                $resume = $selection->resume;
                $resume->update([
                    'status' => 'contratado',                
                ]);

                $resume->observacoes()->create([
                    'observacao' => $selection->observacao,
                ]);

                // Grava observação na vaga
                $job = $selection->job;
                $job->observacoes()->create([
                    'observacao' => $selection->observacao,
                ]);
                
                return redirect()->back()->with('success', 'Candidato Contratado com sucesso!');        
            } else {
                
                $selection->status_contratacao = 'Fila de Espera';
                $selection->update();               
                return redirect()->back()->with('success', 'Vaga fechada Candidato colocado na Fila de espera!');
            } 
        }

        
       
    }

    // Atualizar Processo seletivo
    public function updateSelection(Request $request,  $selectionId)
    {
        //dd('aqui');
        $data = $request->validate([
            'status_selecao' => 'required|string|max:255',
            'avaliacao' => 'nullable|boolean',
            'observacao' => 'nullable|string',
            
           
        ]);

        //dd($data);

        $selection = Selection::findOrFail($selectionId);

        $selection->update($data);      

        //dd($selection);

        // Reprovado com avaliação positiva. Volta a ficar disponível.
        if($selection->status_selecao == 'reprovado' && $selection->avaliacao == 1) {
             // Atualiza o status e grava observação no curriculo
            $resume = $selection->resume;
            $resume->update([
                'status' => 'ativo',                
            ]);

            $resume->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);

            // Grava observação na vaga
            $job = $selection->job;
            $job->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);


            $this->desassociarVaga($selection->job->id, $selection->resume->id);

            return redirect()->back()->with('success', 'Candidato reprovado com avaliação positiva!');  
        }

         // Reprovado com avaliação negativa. Fica INATIVO.
        if($selection->status_selecao == 'reprovado' && $selection->avaliacao == 0) {

            // Atualiza o status e grava observação no curriculo
            $resume = $selection->resume;
            $resume->update([
                'status' => 'inativo',                
            ]);

            $resume->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);
            
            // Grava observação na vaga
            $job = $selection->job;
            $job->observacoes()->create([
                'observacao' => $selection->observacao,
            ]);


            $this->desassociarVaga($selection->job->id, $selection->resume->id);

            return redirect()->back()->with('success', 'Candidato reprovado com avaliação negativa!');  
        }

        
        if($selection->status_selecao == 'aprovado'){
            
            $job = $selection->job;  
            $job->updateStatus();
                                  
            if ($job->status == 'aberta') {
                $job->filled_positions += 1;
                $job->updateStatus();
                $selection->status_contratacao = 'Contratado';
                $selection->update();

                // Atualiza o status e grava observação no curriculo
                $resume = $selection->resume;
                $resume->update([
                    'status' => 'contratado',                
                ]);

                $resume->observacoes()->create([
                    'observacao' => $selection->observacao,
                ]);

                // Grava observação na vaga
                $job = $selection->job;
                $job->observacoes()->create([
                    'observacao' => $selection->observacao,
                ]);
                
                return redirect()->back()->with('success', 'Candidato Contrado com sucesso!');        
            } else {
                
                $selection->status_contratacao = 'Fila de Espera';
                $selection->update();               
                return redirect()->back()->with('success', 'Vaga fechada Contrado colocado na Fila de espera!');
            } 



        }


        
    }



    public function desassociarVaga($jobId, $resumeId)
    { 
        
        $job = Job::findOrFail($jobId);
        $resume = Resume::findOrFail($resumeId);
        
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
}
