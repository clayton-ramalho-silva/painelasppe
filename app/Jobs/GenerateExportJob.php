<?php

namespace App\Jobs;

use App\Models\Export;
use App\Exports\CurriculosExport;
use App\Exports\EntrevistasExport;
use App\Exports\EmpresasExport;
use App\Exports\VagasExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class GenerateExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 300;
    public int $tries   = 2;

    public function __construct(
        public readonly int $exportId
    ) {}

    public function handle(): void
    {
        $export = Export::findOrFail($this->exportId);

        $export->update(['status' => Export::STATUS_PROCESSING]);

        $exportClass = match ($export->type) {
            Export::TYPE_CURRICULOS  => new CurriculosExport(),
            Export::TYPE_ENTREVISTAS => new EntrevistasExport(),
            Export::TYPE_EMPRESAS    => new EmpresasExport(),
            Export::TYPE_VAGAS       => new VagasExport(),
        };

        $filename = "{$export->type}_{$export->id}_" . now()->format('Ymd_His') . '.xlsx';
        $path     = "exports/{$filename}";

        Excel::store($exportClass, $path, 'local');

        $export->update([
            'status'    => Export::STATUS_READY,
            'file_path' => $path,
            'file_size' => Storage::disk('local')->size($path),
        ]);
    }

    public function failed(Throwable $exception): void
    {
        Export::where('id', $this->exportId)
            ->update(['status' => Export::STATUS_FAILED]);
    }
}