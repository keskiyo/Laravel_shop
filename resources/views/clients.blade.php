@extends('layouts.master')

@section('title', 'Новые товары')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/clients.css') }}">
@endsection

@section('content')
    <div class="new_page_content">
        <p style="font-size: 30px;">Интернет-магазин запчастей</p>

        <section class="clients_content">
            <p>О скидках</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Доставка и оплата</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Как сделать заказ</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Условия использования</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Доставка</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Договор поставки</p>
            <a href="#">Читать далее...</a>
        </section>

        <section class="clients_content">
            <p>Персональные данные</p>
            <a href="#">Читать далее...</a>
        </section>
    </div>
@endsection
