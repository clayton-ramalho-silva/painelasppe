<?php
// app/Models/JobRecruiterPivot.php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JobRecruiterPivot extends Pivot
{
    protected $table = 'job_recruiter';

    public function associator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}