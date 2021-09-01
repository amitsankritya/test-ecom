<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockCity extends Model
{
    use HasFactory;

    protected $table = "stock_city";

    /**
     * @return BelongsTo
     */
    public function stock(): BelongsTo {
        return $this->belongsTo(Stock::class, "stock_id", "id");
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo {
        return $this->belongsTo(City::class, "city_id", "id");
    }

}
