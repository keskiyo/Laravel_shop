@extends('layouts.master')

@section('title', 'Контакты')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/kontakti.css') }}">
@endsection

@section('content')

    <div class="socseti">
        <div class = "block">
            <h1>Наши контакты для связи:</h1>
            <p>Номер телефона: 8-982-542-72-27</p>
            <p>Почта для связи : Avtozap@gmail.com</p>
        </div>

        <div class="image-container">
            <h3 style="margin-right: 10px;">Оставайтесь на связи.</h3>
            <i  style="color: rgb(89, 89, 245)" class="fa-brands fa-vk fa-3x"></i>
            <i style="margin-left: 10px; color: green;" class="fa-brands fa-whatsapp fa-3x"></i>
        </div>

        <div class = "block">
            <h2>Расположение магазина на карте</h2>
            <div class="map-container">
                <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aef2c9baba31f501b4bf50b24d58ed338fef52597130896e3d330bc98444840a8&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;scroll=true">
                </script>
            </div>
        </div>
    </div>

@endsection
