<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'logotipo',
        'status'
    ];

    protected $casts = [
        'logotipo' => 'string'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function location()
    {
        return $this->hasOne(LocationCompany::class);
    }

    public function contacts()
    {
        return $this->hasOne(ContactCompany::class);
    }

    
}
