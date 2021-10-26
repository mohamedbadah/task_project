<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function suBcategory()
    {
        return $this->belongsTo(sub_categories::class, 'sub_categories_id', 'id');
    }
    public function orders()
    {
        return $this->belongsToMany(Oreder::class, OrederProduct::class, 'product_id', 'oreder_id');
    }
    public function productDetails()
    {
        return $this->hasMany(OrederProduct::class, 'product_id', 'id');
    }
    public function productInformation()
    {
        return $this->hasOne(ProductInformation::class, 'product_id', 'id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }
}
