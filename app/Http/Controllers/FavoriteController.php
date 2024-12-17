<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleFavorite(Recipe $recipe)
    {
        $user = Auth::user();

        // Проверяем, добавлен ли рецепт в избранное
        if ($user->likedRecipes->contains($recipe)) {
            // Удаляем из избранного
            $user->likedRecipes()->detach($recipe);
        } else {
            // Добавляем в избранное
            $user->likedRecipes()->attach($recipe);
        }

        return response()->json(['status' => 'success']);
    }
}
