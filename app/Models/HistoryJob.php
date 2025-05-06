<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryJob extends Model
{
    use HasFactory;

    protected $table = 'history_jobs';

    protected $fillable = ['observacao'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
