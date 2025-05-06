<?php

namespace App\Http\Controllers;

use App\Exports\CandidatesByJobExport;
use App\Exports\CompaniesExport;
use App\Exports\InterviewsExport;
use App\Exports\JobsExport;
use App\Exports\ResumesExport;
use App\Exports\UsersExport;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Imports\CompaniesImport;
use App\Imports\InterviewsImport;
use App\Imports\JobsImport;
use App\Imports\ResumesImport;

class ReportController extends Controller
{
    // Relatório de Candidator por vaga (lista)
    public function candidatesByJob()
    {        
        $jobs = Job::with('resumes')->get();
        return view('reports.candidates_by_job', compact('jobs'));
    }

    // Relatório de Vagas Preenchidas pro Empresa
    public function filledJobsByCompany()
    {
        $companies = Company::with(['jobs' => function($query){
            $query->where('status', 'fechada');
        }])->get();

        return view('reports.filled_jobs_by_company', compact('companies'));
    }

    // Histórico de Entrevistas
    public function interviewHistory()
    {
        $interviews = Interview::with(['job', 'resume'])->get();

        return view('reports.interview_history', compact('interviews'));
    }

    // Exportação Exel: Candidatos por Vaga
    public function exportCandidatesByJobExcel()
    {
        
        $jobs = Job::with('resumes')->get();
        
        return Excel::download(new CandidatesByJobExport($jobs), 'candidates_by_job.xlsx');
    }

    // Exportação PDF: Candidatos por Vaga
    public function exportCandidatesByJobPdf()
    {
        $jobs = Job::with('resumes')->get();

        $pdf = Pdf::loadView('reports.candidates_by_job_pdf', compact('jobs'));
        return $pdf->download('candidates_by_job.pdf');
    }


    // Export
    public function exportResumes()
    {
        return Excel::download(new ResumesExport, 'resumes.xlsx');
    }

    public function exportCompanies()
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }

    public function exportJobs()
    {
        return Excel::download(new JobsExport, 'jobs.xlsx');
    }

    public function exportInterviews()
    {
        return Excel::download(new InterviewsExport, 'interviews.xlsx');
    }

    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    // Import Company
    public function showFormImportCompanies()
    {
        return view('imports.companies');
    }

    public function importCompanies(Request $request)
    {
       
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);
        
        Excel::import(new CompaniesImport, $request->file('file'));

        return back()->with('success', 'Empresas importadas com sucesso!');
    }

    // Import Jobs
    public function showFormImportJobs()
    {
        return view('imports.jobs');
    }

    public function importJobs(Request $request)
    {
             
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);    
        
        Excel::import(new JobsImport, $request->file('file'));

        return back()->with('success', 'Vagas importadas com sucesso!');
    }


    // Import Resumes
    public function showFormImportResumes()
    {
        return view('imports.resumes');
    }

    public function importResumes(Request $request)
    {
             
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);    
        
        
        Excel::import(new ResumesImport, $request->file('file'));

        return back()->with('success', 'Currículos importadas com sucesso!');
    }

    // Import Interview
    public function showFormImportInterviews()
    {
        return view('imports.interviews');
    }

    public function importInterviews(Request $request)
    {
             
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048'
        ]);    
        
        Excel::import(new InterviewsImport, $request->file('file'));

        return back()->with('success', 'Entrevistas importadas com sucesso!');
    }
}
