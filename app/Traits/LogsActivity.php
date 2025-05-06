<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public function logAction($action, $tableName, $recordId, $description = null)
    {
        Log::create([
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'description' => $description,
            'user_id' => Auth::id(),
        ]);
    }
}