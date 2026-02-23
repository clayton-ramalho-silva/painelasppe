<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmail implements Rule
{
    protected $table;
    protected $ignoreId;

    public function __construct($table, $ignoreId = null)
    {
        $this->table = $table;
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value)
    {
        $query = DB::table($this->table)
            ->whereNull('deleted_at')
            ->where('email', $value);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        return $query->count() === 0;
    }

    public function message()
    {
        return 'Este e-mail já está cadastrado.';
    }
}