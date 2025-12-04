<?php

namespace App\Models;

use App\Http\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory, TenantScoped;

    protected $fillable = [
        'organization_id',
        'vendor_id',
        'amount',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (auth()->check()) {
                $invoice->organization_id = auth()->user()->organization_id;
            }
        });
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}

