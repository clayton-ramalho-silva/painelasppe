<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Interview extends Model
{
    use HasFactory, SoftDeletes;

    

    protected $guarded = [];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);            
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    
}
