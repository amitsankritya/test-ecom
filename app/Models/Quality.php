<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quality extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = "quality";

    /**
     * @return HasMany
     */
    public function stock(): HasMany {
        return $this->hasMany(Stock::class, "quality_id", "id");
    }
}
