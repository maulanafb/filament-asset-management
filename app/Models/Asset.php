<?php

namespace App\Models;

use App\AssetCondition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number',
        'name',
        'image',
        'qty',
        'price',
        'brand_id',
        'category_id',
        'room_id',
        'condition',
        'purchase_date',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'room_id' => 'integer',
        'purchase_date' => 'date',
        'user_id' => 'integer',
        'condition' => AssetCondition::class,
    ];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function maintenanceHistories(): HasMany
    {
        return $this->hasMany(MaintenanceHistory::class);
    }
    public function scopeNew($query)
    {
        return $query->where('condition', 'new');
    }

    public function scopeUsed($query)
    {
        return $query->where('condition', 'used');
    }

    public function scopeDamaged($query)
    {
        return $query->where('condition', 'damaged');
    }
}
