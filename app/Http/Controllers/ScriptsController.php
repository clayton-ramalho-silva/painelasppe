<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfoResume;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScriptsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cpfsDuplicados = PersonalInfoResume::select('cpf')
            ->groupBy('cpf')
            ->having(DB::raw('COUNT(*)'), '>', 1)
            ->pluck('cpf')->toArray();


        foreach ($cpfsDuplicados as $cpf) {
            $keep = [];
            $registros = PersonalInfoResume::where('cpf', $cpf)->get();
            foreach ($registros as $registro) {
                if ($registro->resume && $registro->resume->interview) {
                    $keep[] = $registro->resume->id;
                }
            }

            // dd($keep);

            if (count($keep) > 0) {
                Resume::whereHas('informacoesPessoais', function ($query) use ($cpf) {
                    $query->where('cpf', $cpf);
                })
                    ->whereNotIn('resumes.id', $keep)
                    ->delete();
            } else {
                // Se nenhum dos currículos associados ao CPF tiver entrevista, manter o mais novo e deletar os outros
                $firstResumeId = $registros->last()->resume->id;
                Resume::whereHas('informacoesPessoais', function ($query) use ($cpf) {
                    $query->where('cpf', $cpf);
                })
                    ->where('resumes.id', '!=', $firstResumeId)
                    ->delete();
            }
        }

        return 'work';
    }
}
