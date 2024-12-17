@extends('layout')

@section('title')
    Главная
@endsection

@section('main_content')
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="{{ asset('storage/images/slide1.jpg') }}" class="d-block w-100" alt="Slide 1"
                     style="object-fit: cover; width: 100%; height: 600px; max-width: 1440px;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); pointer-events: none;"></div>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Стать профессионалом может каждый!</h1>
                        <p class="opacity-75">Скорее переходи в рецепты, чтобы отточить свои кулинарные навыки</p>
                        <p><a class="btn btn-lg btn-primary" href="/recipe">Рецепты</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2"
                     style="object-fit: cover; width: 100%; height: 600px; max-width: 1440px; ">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.2); pointer-events: none;"></div>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Делись опытом</h1>
                        <p>Добавляй свои рецепты на сайт, чтобы другие пользователи тоже смогли попробовать</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Добавить рецепт</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('storage/images/slide3.jpg') }}" class="d-block w-100" alt="Slide 3"
                     style="object-fit: cover; width: 100%; height: 600px; max-width: 1440px;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); pointer-events: none;"></div>
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Понравился рецепт?</h1>
                        <p>Чтобы не забыть вкусный рецепт, добавляй его в избранное</p>
                        <p><a class="btn btn-lg btn-primary" href="/recipe">Рецепты</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="container mt-5">
        <h1 class="text-center mb-4">Все рецепты</h1>

        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/' . $recipe->image_path) }}" class="card-img-top" alt="{{ $recipe->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ $recipe->description }}</p>
                            <p class="text-muted small">By {{ $recipe->author }}</p>
                            <p class="text-warning">Rating: {{ $recipe->rating }}⭐</p>
                            <a href="{{ route('recipe.show', $recipe->id) }}" class="btn btn-primary btn-sm">Смотреть целиком</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('recipes.index') }}" class="btn btn-lg btn-outline-primary">Смотреть все</a>
        </div>
    </div>


@endsection
