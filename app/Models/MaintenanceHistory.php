<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id',
        'maintenance_date',
        'price',
        'qty',
        'total_price',
        'notes',
        'user_id',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'asset_id' => 'integer',
        'maintenance_date' => 'date',
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
