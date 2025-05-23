<?php

namespace App\View\Components;

use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobResumeModal extends Component
{
    public $job;
    public $resumes;

    /**
     * Create a new component instance.
     */
    public function __construct($jobId)
    {
        $this->job = Job::with('resumes')->find($jobId);
        $this->resumes = $this->job ? $this->job->resumes : collect([]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-resume-modal');
    }
}
