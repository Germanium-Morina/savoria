<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price', 'image_url', 'is_available', 'is_featured', 'display_order'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
