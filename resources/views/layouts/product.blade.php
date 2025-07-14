@extends('layouts.master')

@section('title', 'Товар ' . $product->name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/product.css') }}">
@endsection

@section('content')
    <h2 class="card_content__h2">{{ $product->name }}</h2>
    <div class="container_zap">
        <div class="left-section">
            <div class="div_img-product">
                <img src="{{ Storage::url($product->img) }}" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="mid-section">
            <p class="card_content__p"> Производитель: {{ $product->manufacturer }}</p>
            <p class="card_content__p"> Артикул: 
                <span id="product-article">{{ $product->article }}</span>
                <button class="copy-icon-btn" data-target="product-article" title="Скопировать артикул">
                    <i class="fa-solid fa-copy"></i>
                </button>
            </p>
            <a href="#" class="toggle-characteristics">Характеристики ▼</a>
            <div class="characteristics hidden">
                <p class="product_p">Характеристика 1: Значение 1</p>
                <p class="product_p">Характеристика 2: Значение 2</p>
                <p class="product_p">Характеристика 3: Значение 3</p>
            </div>
        </div>

        <div class="right-section">
            <p class="card_content_price"> Цена: <span class="price">{{ $product->price }} ₽</span></p>
            @if ($product->isAvailable())
                <form action="{{ route('basket-add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="button_basket" role="button"> В корзину </button>
                </form>
            @else                
                <p class="empty"> Не доступен </p>
                <span>Сообщить когда товар будет в наличии:</span>

                @if($errors->get('email'))
                    <div class="alert-warning">
                        {!! $errors->get('email')[0] !!}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('subscription', $product) }}">
                    @csrf
                    <input class="product_input" type="text" name="email" placeholder="Введите email ..."></input>
                    <button class="product_btn" type="submit"> Отправить</button>
                </form>
            @endif
        </div>
    </div>
@endsection
