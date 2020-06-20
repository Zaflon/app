<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    /**
     * Brand.
     * 
     * @param void.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Brand::class);
    }
}
