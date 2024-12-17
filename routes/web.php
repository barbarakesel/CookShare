<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('home');  // Отображает 3 рецепта

// Рецепты
Route::get('/recipe', [MainController::class, 'recipe'])->name('recipes.index');  // Отображает все рецепты
Route::get('/recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/recipe/create', [RecipeController::class, 'create'])->name('recipes.create');

// Поиск рецепта
Route::get('/search', [MainController::class, 'search'])->name('search');

// Пользовательские маршруты
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('profile');  // Профиль пользователя
    Route::get('/user/recipe', [RecipeController::class, 'myLiked'])->name('myLiked');  // Понравившиеся рецепты пользователя
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');  // Добавить отзыв
    Route::post('/recipe/liked', [RecipeController::class, 'liked'])->name('liked');  // Отметить рецепт как понравившийся
});

// Страница авторизации и регистрации
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'createregister'])->name('register');
Route::post('/login', [LoginController::class, 'authentication']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
