<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Export extends Model
{
    use HasFactory;

    // ------------------------------------------------------------------------
    // Tipos de Exportação disponíveis
    // ------------------------------------------------------------------------

    const TYPE_CURRICULOS = 'curriculos';
    const TYPE_EMPRESAS = 'empresas';
    const TYPE_VAGAS = 'vagas'; 
    const TYPE_ENTREVISTAS = 'entrevistas';

    // ------------------------------------------------------------------------
    // Status possíveis
    // ------------------------------------------------------------------------
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_READY = 'ready';
    const STATUS_FAILED = 'failed';
    const STATUS_DOWNLOADED = 'downloaded';

    // ------------------------------------------------------------------------
    // Labels para exibição na view
    // ------------------------------------------------------------------------
    const TYPE_LABELS = [
        self::TYPE_CURRICULOS  => 'Currículos',
        self::TYPE_EMPRESAS    => 'Empresas',
        self::TYPE_VAGAS       => 'Vagas',
        self::TYPE_ENTREVISTAS => 'Entrevistas',
    ];

    const STATUS_LABELS = [
        self::STATUS_PENDING    => 'Aguardando',
        self::STATUS_PROCESSING => 'Gerando',
        self::STATUS_READY      => 'Pronta para baixar',
        self::STATUS_FAILED     => 'Falhou',
        self::STATUS_DOWNLOADED => 'Baixada',
    ];

    // ------------------------------------------------------------------------
    // Config do model
    // ------------------------------------------------------------------------
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'file_path',
        'file_size',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
        'file_size'     => 'integer',
    ];

    // -------------------------------------------------------------------
    // Relacionamentos
    // -------------------------------------------------------------------
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------------------------------------------------
    // Scopes para facilitar consultas
    // -------------------------------------------------------------------
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessing(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    public function scopeReady(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_READY);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }

    // -------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------
    public function getTypeLabel(): string
    {
        return self::TYPE_LABELS[$this->type] ?? $this->type;
    }

    public function getStatusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getFileSizeFormatted(): string
    {
        if (! $this->file_size) {
            return '—';
        }

        if ($this->file_size < 1024) {
            return $this->file_size . ' B';
        }

        if ($this->file_size < 1048576) {
            return round($this->file_size / 1024, 1) . ' KB';
        }

        return round($this->file_size / 1048576, 1) . ' MB';
    }

    public function isReady(): bool
    {
        return in_array($this->status, [self::STATUS_READY, self::STATUS_DOWNLOADED]);
    }

    public function isActive(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }



}
