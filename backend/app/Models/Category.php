<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'display_order', 'is_active'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }
}
