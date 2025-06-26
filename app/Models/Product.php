<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['p_name', 'p_p_price', 'p_s_price', 'p_stock'];
}
