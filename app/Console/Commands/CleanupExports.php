<?php

namespace App\Console\Commands;

use App\Models\Export;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanupExports extends Command
{
    protected $signature   = 'exports:cleanup';
    protected $description = 'Remove exportações com mais de 7 dias';

    public function handle(): void
    {
        $exports = Export::where('created_at', '<=', now()->subDays(7))->get();

        $total = $exports->count();

        if ($total === 0) {
            $this->info('Nenhuma exportação antiga para remover.');
            return;
        }

        foreach ($exports as $export) {
            if ($export->file_path && Storage::disk('local')->exists($export->file_path)) {
                Storage::disk('local')->delete($export->file_path);
            }
            $export->delete();
        }

        $this->info("$total exportação(ões) removida(s) com sucesso.");
    }
}