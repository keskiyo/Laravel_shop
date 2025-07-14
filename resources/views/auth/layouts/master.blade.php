<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>

    <script src="{{ asset('js/script.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="/css/admin/app.css" rel="stylesheet">
    <link href="/css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="navbar">
                <div class="header_left">
                    <a class="admin_return" href="{{ route('main') }}">
                        Вернуться на сайт
                    </a>
                </div>
                <ul class="links">
                    @admin
                    <li @routeactive('categories.index')><a href="{{ route('categories.index') }}" >Категории</a></li>
                    <li @routeactive('products.index')><a href="{{ route('products.index') }}">Товары</a></li>
                    <li @routeactive('users.index')><a href="{{ route('users.index') }}">Пользователи</a></li>
                    <li @routeactive('home')><a href="{{ route('home') }}" >Заказы</a></li>
                    @endadmin
                </ul> 
                <div class="toggle-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="dropdown-content">
                    @guest
                        <a href="{{ route('login') }}">Вход</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                    @endguest

                    @auth
                        <a href="{{ route('get-logout') }}">Выйти</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="content">
            <div class="content_wrapper">
                @yield('content')
            </div>
        </main>
    </div>
    <footer class="footer"></footer>
</body>

</html>