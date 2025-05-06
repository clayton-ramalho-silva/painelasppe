<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardControler extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Dados para o Admin
            $totalJobs = Job::select('qtd_vagas')->sum('qtd_vagas');
            $totalResumes = Resume::count();
            $totalInterviews = Interview::count();
            $totalRecruiters = User::where('role', 'recruiter')->count();
            $filledJobs = Job::select('filled_positions')->sum('filled_positions');
            $openJobs = Job::where('status', 'aberta')->sum('status');
            $totalEmpresasAtivas = Company::where('status', 'ativo')->count();
            $totalEmpresasInativas = Company::where('status', 'inativo')->count();
            $jobs = Job::with('company')->get();
            $resumes = Resume::orderBy('created_at', 'desc')->take(50)->get();

            return view('dashboard.admin', compact(
                'totalJobs', 'totalResumes', 'totalInterviews',
                'totalRecruiters', 'filledJobs', 'openJobs',
                'totalEmpresasAtivas', 'totalEmpresasInativas', 'jobs', 'resumes'
            ));
        } else {
            // Dados para o Recrutador
            $totalEmpresasAtivas = Company::where('status', 'ativo')->count();
            $totalEmpresasInativas = Company::where('status', 'inativo')->count();

            $totalJobs = Job::whereHas('recruiters', function($query) use ($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $totalResumes = Resume::whereHas('jobs.recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $totalInterviews = Interview::with(['resume.jobs'])->whereHas('resume.jobs.recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $filledJobs = Job::select('filled_positions')
                ->whereHas('recruiters', function ($query) use ($user){
                    $query->where('recruiter_id', $user->id);
            })->count();

            $openJobs = Job::where('status', 'aberta')
                ->whereHas('recruiters', function ($query) use ($user){
                    $query->where('recruiter_id', $user->id);
            })->count();
            $jobs = Job::with('company')->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();

            $resumes = Resume::orderBy('created_at', 'desc')->take(50)->get();
            //dd($resumes);

            return view('dashboard.recruiter', compact(
                'totalJobs', 'totalResumes', 'totalInterviews',
                'filledJobs', 'openJobs', 'totalEmpresasAtivas', 'totalEmpresasInativas', 'jobs', 'resumes'
            ));



        }
    }
}
