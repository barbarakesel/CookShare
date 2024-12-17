<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Recipe;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        return view ('home');
    }


    public function user(){
        return view ('user');
    }
    public function index()
    {
        $recipes = Recipe::limit(3)->get(); // Получаем только три рецепта
        return view('home', compact('recipes'));
    }

    public function recipe()
    {
        $recipes = Recipe::all(); // Получаем все рецепты
        return view('recipe', compact('recipes'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $recipes  = Recipe::where('title', 'like', '%'.$search.'%')->get();
        return view('recipe', compact('recipes'));
    }
}
