<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автозапчасти: @yield('title')</title>
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="navbar">
                <div class="header_left">
                    <a href="{{ route('main') }}">
                        <img class="header_logo" src="{{ asset('img/logotip1.jpg') }}" alt="Логотип">
                    </a>
                </div>
                <ul class="links">
                    <li @routeactive('main')><a href="{{ route('main') }}">Главная</a></li>
                    <li @routeactive('categor*')><a href="{{ route('categories') }}" >Каталог</a></li>
                    <li @routeactive('clients')><a href="{{ route('clients') }}" >Клиентам</a></li>
                    <li @routeactive('kontakti')><a href="{{ route('kontakti') }}" >Контакты</a></li>
                    <li @routeactive('basket')><a href="{{ route('basket') }}" >Корзина</a></li>
                </ul>
                <div class="toggle-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="dropdown-content">

                    <div class="main-menu-links"></div>
                    
                    <div class="dropdown-divider"></div>

                    @guest
                    <a href="{{ route('login') }}">Вход</a>
                    <a href="{{ route('register') }}">Регистрация</a>                            
                    @endguest
                            
                    @auth
                        @admin
                            <a href="{{ route('home') }}">Панель администратора</a> 
                        @else
                            <a href="{{ route('person.orders.index') }}">Мои заказы</a>
                        @endadmin
                        <a href="{{ route('get-logout') }}">Выйти</a>                            
                    @endauth
                </div>
            </div>
        </header>

        <main class="content">
            <div class="content_wrapper">
                @if(session()->has('message'))
                <p class="alert-warning">{{ session()->get('message') }}</p>
                @endif
                @if (session()->has('success'))                
                <p class="alert-success">{{ session()->get('success') }}</p>
                @endif
                @if (session()->has('warning'))                
                <p class="alert-warning">{{ session()->get('warning') }}</p>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class="footer__wrapper">
            <div class="footer__wrapper__content">
                <div class="footer__wrapper__content__col">
                    <h4 class="footer__wrapper__content__col__header">ИНФОРМАЦИЯ</h4>
                    <a href="#" class="footer__wrapper__content__col__text">О магазине</a>
                    <a href="#" class="footer__wrapper__content__col__text">Оплата и доставка</a>
                    <p class="footer__wrapper__content__col__text">Avtozap@gmail.com</p>
                </div>
                <div class="footer__wrapper__content__col">
                    <h4 class="footer__wrapper__content__col__header">ВРЕМЯ РАБОТЫ</h4>
                    <p class="footer__wrapper__content__col__text">г. Барнаул, ул. Покровская, 10</p>
                    <p class="footer__wrapper__content__col__text">пн-вс: 9:00 - 18:00</p>
                    <p class="footer__wrapper__content__col__text">без перерыва</p>
                </div>
                <div class="footer__wrapper__content__col">
                    <h4 class="footer__wrapper__content__col__header">КОНТАКТЫ</h4>
                    <a href="#" class="footer__wrapper__content__col__text">982 542-72-27</a>
                    <a href="#" class="footer__wrapper__content__col__text">982 542-72-28</a>
                    <a href="#" class="footer__wrapper__content__col__text">982 542-72-29</a>
                </div>
            </div>
        </div>
    </footer>
    @yield('js')
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>

</html>
