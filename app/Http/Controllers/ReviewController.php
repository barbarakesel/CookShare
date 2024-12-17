<?php

namespace App\Http\Controllers;
use App\Models\Review;

use App\Models\Recipe;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'recipe_id' => $validated['recipe_id'],
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'rating' => $validated['rating'],
        ]);

        return redirect()->back()->with('success', 'Ваш отзыв успешно добавлен!');
    }
}
