<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CookShare</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="/">Главная</a></li>
                <li class="nav-item"><a class="nav-link" href="/recipe">Рецепты</a></li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('myLiked') }}">{{ Auth::user()->name }}</a> <!-- Ссылка на страницу профиля пользователя -->
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Выйти</button> <!-- Кнопка выхода -->
                        </form>
                    </li>
                @else
                    <li class="nav-item"><div class="text-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">Войти</button>
                        </div>
                        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="authModalLabel">Вход / Регистрация</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="authTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Вход</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Регистрация</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="authTabContent">
                                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                                <form action="/login" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="loginEmail" class="form-label">Email адрес</label>
                                                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="loginPassword" class="form-label">Пароль</label>
                                                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Войти</button>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                                <form action="/register" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="registerName" class="form-label">Полное имя</label>
                                                        <input type="text" class="form-control" id="registerName" name="name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="registerEmail" class="form-label">Email адрес</label>
                                                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="registerPassword" class="form-label">Пароль</label>
                                                        <input type="password" class="form-control" id="registerPassword" name="password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="registerConfirmPassword" class="form-label">Подтвердите пароль</label>
                                                        <input type="password" class="form-control" id="registerConfirmPassword" name="password_confirmation" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('main_content')
</div>


<footer class="bg-light py-4">
    <div class="container text-center">
        <p>&copy; 2024 CookShare. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
