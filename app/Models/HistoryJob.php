<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HistoryJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'history_jobs';

    protected $fillable = ['observacao'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
