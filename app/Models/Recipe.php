<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'ingredients', 'steps', 'rating', 'image_path', 'user_id', 'category_id'
    ];
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'liked_recipes', 'recipe_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
