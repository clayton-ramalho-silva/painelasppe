<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LocationCompany extends Model
{
    use HasFactory, SoftDeletes;

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
