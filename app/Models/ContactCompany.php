<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefone',
        'email',
        'nome_contato',
        'whatsapp'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
