<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HistoryResume extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'history_resumes';
    protected $fillable = ['observacao', 'created_at'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
