@extends('layout')

@section('title')
    Рецепт
@endsection

@section('main_content')
    <div class="container mt-5">
        <h1 class="text-center">{{ $recipe->title }}</h1>
        <img src="{{ asset('storage/images/'.$recipe->image_path)}}" class="img-fluid" alt="{{ $recipe->title }}"  style="object-fit: cover; width: 100%; height: 600px; max-width: 1440px;">
        <p><strong>Категория: </strong> {{ $recipe->category ? $recipe->category->name : 'No category' }}</p>
        <h3 class="mt-4">Ингредиенты</h3>
        <ul>
            @foreach(explode(',', $recipe->ingredients) as $ingredient) <!-- Пример для ингредиентов -->
            <li>{{ $ingredient }}</li>
            @endforeach
        </ul>

        <h3>Пошаговые инструкции</h3>
        <ol>
            @foreach(array_filter(explode('.', $recipe->steps)) as $instruction)
                <li>{{ trim($instruction) }}</li>
            @endforeach
        </ol>

        <p><strong>Автор:</strong> <a href="#">{{ $recipe->author }}</a></p>
        <p><strong>Рейтинг:</strong> {{ $recipe->rating }} ⭐</p>

        <h3>Добавить комментарий</h3>
        @auth
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

                <!-- Оценка -->
                <div class="mb-3">
                    <label for="rating" class="form-label">Оценка</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="1">1 - Очень плохо</option>
                        <option value="2">2 - Плохо</option>
                        <option value="3">3 - Нормально</option>
                        <option value="4">4 - Хорошо</option>
                        <option value="5">5 - Отлично</option>
                    </select>
                </div>

                <!-- Отзыв -->
                <div class="mb-3">
                    <label for="content" class="form-label">Ваш отзыв</label>
                    <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        @else
            <p>Для добавления отзыва необходимо <a href="{{ route('login') }}">войти</a>.</p>
        @endauth
        <br>
        <h4>Комментарии</h4>
        @if($recipe->reviews->isEmpty())
            <p>Пока нет отзывов. Будьте первым!</p>
        @else
            @foreach($recipe->reviews as $review)
                <div class="review">
                    <strong>{{ $review->user->name }}</strong>
                    <span>{{ $review->rating }}/5</span>
                    <p>{{ $review->content }}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection
