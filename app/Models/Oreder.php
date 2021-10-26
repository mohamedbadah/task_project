<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oreder extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrederProduct::class, 'oreder_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, OrederProduct::class, 'oreder_id', 'product_id');
    }
}
