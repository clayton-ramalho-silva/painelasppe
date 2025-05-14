<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AcademicInfoResume extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'escolaridade', 
        'escolaridade_outro',
        'informatica', 
        'ingles',
        'created_at'
    ];

    protected $casts = [
        'escolaridade' => 'array',                     
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    // public function getEscolaridadeArrayAttribute()
    // {
    //     if(empty($this->escolaridade)){
    //         return [];
    //     }

    //     if (is_string($this->escolaridade)){
    //         return json_decode($this->escolaridade, true) ? : [$this->escolaridade];
    //     }

    //     return (array) $this->escolaridade;
    // }
}
