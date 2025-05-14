<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Selection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_id', 'resume_id', 'status_selecao', 'avaliacao', 'observacao', 'status_contratacao'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
