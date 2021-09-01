<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCity extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = "product_city";

    /**
     * @return BelongsTo
     */
    public function stock(): BelongsTo {
        return $this->belongsTo(Stock::class, "id", "product_id");
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo {
        return $this->belongsTo(City::class, "id", "city_id");
    }
}
