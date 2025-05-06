<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;


class CandidatesByJobExport implements FromCollection
{
    protected $data;

    public function __contruct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }
}