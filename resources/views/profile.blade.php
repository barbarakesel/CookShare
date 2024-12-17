@extends('layout')

@section('main_content')
    <div class="container mt-5">
        <h1>Мой профиль</h1>
        <div class="row mb-5">
            <div class="col-md-4">
               <!-- <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-fluid rounded-circle"> !-->
            </div>
            <div class="col-md-8">
                <h4>{{ Auth::user()->name }}</h4>
                <p>Email: {{ Auth::user()->email }}</p>
            </div>

            <!-- Tabs для отображения рецептов -->
            <div class="card mb-5">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="recipeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="myRecipesTab" data-bs-toggle="tab" href="#myRecipes" role="tab" aria-controls="myRecipes" aria-selected="true">Мои рецепты</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="likedRecipesTab" data-bs-toggle="tab" href="#likedRecipes" role="tab" aria-controls="likedRecipes" aria-selected="false">Понравившиеся рецепты</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="recipeTabsContent">
                        <!-- Мои рецепты -->
                        <div class="tab-pane fade show active" id="myRecipes" role="tabpanel" aria-labelledby="myRecipesTab">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="recipe2.jpg" class="card-img-top" alt="Рецепт 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Название рецепта 2</h5>
                                            <p class="card-text">Краткое описание рецепта 2.</p>
                                            <a href="#" class="btn btn-secondary btn-sm">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Понравившиеся рецепты -->
                        <div class="tab-pane fade" id="likedRecipes" role="tabpanel" aria-labelledby="likedRecipesTab">
                            <div class="row">
                                @foreach ($likedRecipes as $recipe)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="{{ asset('storage/images/' . $recipe->image_path) }}" class="card-img-top" alt="{{ $recipe->title }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                                <p class="card-text">{{ $recipe->description }}</p>
                                                <p class="text-muted small">By {{ $recipe->author }}</p>
                                                <p class="text-warning">Rating: {{ $recipe->rating }}⭐</p>
                                                <div class="d-flex">
                                                    <a href="{{ route('recipe.show', $recipe->id) }}" class="btn btn-primary btn-sm">Смотреть целиком</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Форма добавления рецепта (сначала скрыта) -->
            <div class="card mb-5" id="addRecipeForm" style="display: none;">
                <div class="card-header">
                    <h5>Добавить новый рецепт</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="title" class="form-label">Название рецепта</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Введите название рецепта">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введите описание рецепта"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="ingredients" class="form-label">Ингредиенты</label>
                            <textarea class="form-control" id="ingredients" name="ingredients" rows="3" placeholder="Перечислите ингредиенты"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="steps" class="form-label">Шаги приготовления</label>
                            <textarea class="form-control" id="steps" name="steps" rows="5" placeholder="Опишите шаги приготовления"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить рецепт</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- JS для отображения формы добавления рецепта -->
        <script>
            document.getElementById('addRecipeBtn').addEventListener('click', function() {
                const form = document.getElementById('addRecipeForm');
                if (form.style.display === 'none') {
                    form.style.display = 'block';
                } else {
                    form.style.display = 'none';
                }
            });
        </script>

@endsection
