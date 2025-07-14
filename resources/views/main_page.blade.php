@extends('layouts.master')

@section('title', 'Главная страница')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/main_page.css') }}">
@endsection

@section('content')
<div class="main_content_wrapper">
<h2 class="main_page_header">Запасные части для российских транспортных средств.</h2>
    <div class = "main_page_content_block">
        <p class="main_page_content" style="word-wrap: break-word; line-height: 1.5;">Здесь вы найдете все необходимое для
            вашего автомобиля: от фильтров и масел до тормозной системы и элементов подвески. Мы предлагаем широкий
            ассортимент запчастей, гарантируя высокое качество и надежность товаров.
            Наш магазин предлагает консультации специалистов по подбору запчастей, чтобы помочь вам сделать правильный
            выбор.
            Благодаря удобной системе оплаты и быстрой доставке вы сможете легко и быстро приобрести необходимые детали для
            вашего автомобиля прямо из дома. Надеемся, что ваше путешествие по нашему магазину будет приятным и
            плодотворным. Спасибо за ваш выбор!</p>
        <p class="main_page_content">В чем наше преимущество:</p>
        <ul class="main_page_ul">
            <li class="li_mane_page">Высокое качество продукции</li>
            <li class="li_mane_page">Быстрая доставка</li>  
            <li class="li_mane_page">Привлекательные цены</li>
            <li class="li_mane_page">Удобный поиск по каталогу</li>
            <li class="li_mane_page">Профессиональная поддержка клиентов</li>
        </ul>
        <p class="main_page_content">В этом интернет магазине, вы можете найти запчасти для марок автомобилей:</p>
        <p class="main_page_content">Ваз 2101-07, Лада 2103-09-2115, Приора, Гранта, Нива 2121-21213, Нива Шива.</p>
    </div>
</div>

    <div class="Marki">
        <img src="img/LADA.jpg" alt="Lada">
        <img src="img/NIVACHEVROLET.jpg" alt="Niva">
    </div>
@endsection
