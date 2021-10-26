<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sub_categories extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_categories_id', 'id');
    }
}
