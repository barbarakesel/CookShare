<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipe', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::with(['reviews.user'])->findOrFail($id);

        return view('onerecipe', compact('recipe'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Загружаем изображение, если оно есть
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        } else {
            $imagePath = null;
        }

        // Создаем рецепт
        Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'steps' => $request->steps,
            'image_path' => $imagePath,
            'rating' => 0,
            'user_id' => Auth::id(),
            'category_id' => 1,
        ]);

        return redirect()->route('profile')->with('success', 'Рецепт добавлен!');
    }


    public function liked(Request $request)
    {
        $user = Auth::user();
        $recipeId = $request->input('recipeId');

        // Проверяем, существует ли связь
        $likedRecipe = $user->likedRecipes()->where('recipe_id', $recipeId)->first();

        if ($likedRecipe) {
            // Если связь существует, удаляем ее
            $user->likedRecipes()->detach($recipeId);
        } else {
            // Если связи нет, создаем ее
            $user->likedRecipes()->attach($recipeId);
        }

        return redirect()->back()->with('success', 'Рецепт добавлен в избранное!');
    }




    // Отображение понравившихся рецептов
    public function myLiked()
    {
        // Получаем понравившиеся рецепты текущего пользователя
        $likedRecipes = Auth::user()->likedRecipes()->with('reviews.user')->get();

        // Передаем переменную в представление
        return view('profile', compact('likedRecipes'));
    }




}
