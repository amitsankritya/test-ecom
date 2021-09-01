<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $table = "city";

    /**
     * @return HasMany
     */
    public function product_city(): HasMany {
        return $this->hasMany(ProductCity::class, "city_id", "id");
    }
}
