<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'logradouro',
        'numero',
        'complenento',
        'bairro',
        'cidade',
        'uf',
        'cep'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
