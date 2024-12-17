@extends('layout')

@section('title')
    Рецепты
@endsection


@section('main_content')

    <div class="container mt-5">
        <form class="d-flex" role="search" method="get" action="{{route('search')}}">
            <input class="form-control me-2" type="search" id="search" name="search" placeholder="Что приготовим?" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Поиск</button>
        </form>
        <br>
        <h1 class="text-center mb-4">Все рецепты</h1>
        <div class="row">
            @if($recipes->isEmpty())
                <div class="col-12">
                    <p class="text-center text-muted">Упс.. похоже такого рецепта нет:( Давайте приготовим что-нибудь другое</p>
                </div>
            @else
            @foreach($recipes as $recipe)
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
                                <form action="{{ route('liked') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="recipeId" value="{{ $recipe->id }}">
                                    <button type="submit" id="like-button" class="btn btn-sm ms-auto d-flex align-items-center
            {{ session('buttonState') === 'liked' ? 'btn-danger' : 'btn-outline-danger' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    <script>
        const likeButton = document.getElementById('like-button');

        likeButton.addEventListener('click', function(e) {
            likeButton.classList.replace('btn-outline-danger', 'btn-danger');
        });
    </script>

@endsection
