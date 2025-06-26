<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
        'qty',
        'discount',
        'vat',
        't_amount',
        'paid',
        'due'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
