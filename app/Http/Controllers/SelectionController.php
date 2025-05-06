<?php

namespace App\Http\Controllers;

use App\Models\Selection;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
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

        if($selection->status_selecao == 'reprovado') {
            return redirect()->back()->with('success', 'Processo seletivo criado com sucesso!');  
        }

        if($selection->status_selecao == 'aprovado'){
            
            $job = $selection->job;                        
            $job->updateStatus();


            if ($job->status == 'aberta') {
                $job->filled_positions += 1;
                $job->updateStatus();
                $selection->status_contratacao = 'Contratado';
                $selection->update();
                
                return redirect()->back()->with('success', 'Candidato Contrado com sucesso!');        
            } else {
                
                $selection->status_contratacao = 'Fila de Espera';
                $selection->update();               
                return redirect()->back()->with('success', 'Vaga fechada Contrado colocado na Fila de espera!');
            } 
        }

        
       
    }

    // Atualizar Processo seletivo
    public function updateSelection(Request $request,  $selectionId)
    {
        $data = $request->validate([
            'status_selecao' => 'required|string|max:255',
            'avaliacao' => 'nullable|boolean',
            'observacao' => 'nullable|string',
            
           
        ]);

        $selection = Selection::findOrFail($selectionId);

        $selection->update($data);

        if($selection->status_selecao == 'reprovado') {
            return redirect()->back()->with('success', 'Processo seletivo criado com sucesso!');  
        }
        
        if($selection->status_selecao == 'aprovado'){
            
            $job = $selection->job;  
            $job->updateStatus();
                                  
            if ($job->status == 'aberta') {
                $job->filled_positions += 1;
                $job->updateStatus();
                $selection->status_contratacao = 'Contratado';
                $selection->update();
                
                return redirect()->back()->with('success', 'Candidato Contrado com sucesso!');        
            } else {
                
                $selection->status_contratacao = 'Fila de Espera';
                $selection->update();               
                return redirect()->back()->with('success', 'Vaga fechada Contrado colocado na Fila de espera!');
            } 



        }


        
    }
}
