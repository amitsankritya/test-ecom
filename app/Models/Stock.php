<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class, "brand_id", "id");
    }

    /**
     * @return BelongsTo
     */
    public function quality(): BelongsTo {
        return $this->belongsTo(Quality::class, "quality_id", "id");
    }

    /**
     * @return HasMany
     */
    public function stock_city(): HasMany {
        return $this->hasMany(StockCity::class, "stock_id", "id");
    }
}