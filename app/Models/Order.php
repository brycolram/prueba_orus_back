<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "total",
        "discount"
    ];

    public function fruits()
    {
        return $this->belongsToMany(Fruit::class)->withPivot('quantity', 'price', 'discount')
            ->using(FruitOrder::class);//->withTimestamps();
    }
}
