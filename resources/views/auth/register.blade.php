@extends('layouts.master')

@section('title', 'Страница регистрации')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
    <div class="container" id="container">
        <div class="form-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Сделать аккаунт</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-yandex"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-vk"></i></a>
                </div>
                <span>или используйте почту</span>
                <input type="text" name="name" placeholder="Имя" required>
                <input type="email" name="email" placeholder="Электронная почта" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required>
                <button type="submit" class="login_button">Зарегистрироваться</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel">
                    <h1>Добро пожаловать!</h1>
                    <p>Авторизуйтесь на сайте</p>
                    <a href="{{ route('login') }}" class="hidden">Войти</a>
                </div>
            </div>
        </div>
    </div>
@endsection
