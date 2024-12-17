<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    /**
     * Связь с моделью Recipe (многие-к-одному).
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
    protected $fillable = ['recipe_id', 'user_id', 'content', 'rating'];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
