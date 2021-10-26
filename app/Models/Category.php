<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $append = ['status'];
    public function getStatusAttribute()
    {
        return $this->active ? "active" : "disable";
    }
    public function subCategory()
    {
        return $this->hasMany(sub_categories::class, 'categories_id', 'id');
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, Sub_categories::class, 'categories_id', 'sub_categories_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }
}
