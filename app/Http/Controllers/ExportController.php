<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateExportJob;
use App\Models\Export;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ExportController extends Controller
{
    public function index()
    {        
        $exports = Export::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('exportacoes.index', compact('exports'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => ['required', 'in:curriculos,empresas,vagas,entrevistas'],
        ]);

        $export = Export::create([
            'user_id' => auth()->id(),
            'type'    => $request->type,
            'status'  => Export::STATUS_PENDING,
        ]);

        GenerateExportJob::dispatch($export->id);

        return redirect()
            ->route('exportacoes.index')
            ->with('success', 'Exportação de ' . $export->getTypeLabel() . ' iniciada. Aguarde e recarregue a página.');
    }

   public function download(Export $export): BinaryFileResponse|RedirectResponse
    {
        $this->authorize('download', $export);

        if (! $export->isReady()) {
            return redirect()
                ->route('exportacoes.index')
                ->with('error', 'Esta exportação ainda não está disponível para download.');
        }

        if (! Storage::disk('local')->exists($export->file_path)) {
            return redirect()
                ->route('exportacoes.index')
                ->with('error', 'Arquivo não encontrado. Gere uma nova exportação.');
        }

        $export->update([
            'status'        => Export::STATUS_DOWNLOADED,
            'downloaded_at' => now(),
        ]);

        $filename = $export->getTypeLabel() . '_' . $export->created_at->format('d-m-Y') . '.xlsx';

        return response()->download(
            Storage::disk('local')->path($export->file_path),
            $filename
        );
    }

    public function destroy(Export $export): RedirectResponse
    {
        $this->authorize('delete', $export);

        if ($export->file_path && Storage::disk('local')->exists($export->file_path)) {
            Storage::disk('local')->delete($export->file_path);
        }

        $export->delete();

        return redirect()
            ->route('exportacoes.index')
            ->with('success', 'Exportação removida.');
    }

    public function status(): JsonResponse
    {
        $actives = Export::where('user_id', auth()->id())
            ->active()
            ->get(['id', 'type', 'status']);

        $ready = Export::where('user_id', auth()->id())
            ->whereIn('id', request('ids', []))
            ->where('status', Export::STATUS_READY)
            ->get(['id', 'type', 'status']);

        return response()->json([
            'actives' => $actives,
            'ready'   => $ready,
        ]);
    }
}