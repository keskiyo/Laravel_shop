@extends('layouts.master')

@section('title', 'Страница входа')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Войти</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-yandex"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-vk"></i></a>
                </div>
                <span>или используйте почту</span>
                <input type="email" name="email" placeholder="Почта">
                <input type="password" name="password" placeholder="Пароль">
                <a href="#" class="forgot-password">Забыли пароль?</a>
                <button type="submit" class="login_button">Войти</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Здравствуйте!</h1>
                    <p>Зарегистрируйтесь на сайте</p>
                    <a href="{{ route('register') }}" class="hidden">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
@endsection
