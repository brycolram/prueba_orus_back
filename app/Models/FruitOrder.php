<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FruitOrder extends Pivot
{
    protected $fillable = [
        'quantity',
        'price',
        'discount',
    ];
}
