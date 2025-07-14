@extends('layouts.master')

@section('title', 'Корзина')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/basket.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

    <div class="basket_content">
        <h1 class="basket_content__title"> Корзина </h1>
        <p class="basket_content__description"> Оформление заказа </p>
        <table class="basket_content__table">
            <thead>
                <tr>
                    <th class="basket_content__table-header"> Название </th>
                    <th class="basket_content__table-header"> Кол-во </th>
                    <th class="basket_content__table-header"> Цена </th>
                    <th class="basket_content__table-header"> Стоимость </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td class="basket_content__table-cell basket_content__table-cell--product">
                            <img alt="#" src="{{ Storage::url($product->img) }}" />
                            <span class="basket_content__product-name"> {{ $product->name }} </span>
                        </td>
                        <td class="basket_content__table-cell">
                            <div class="basket_content__quantity-control">
                                <form action="{{ route('basket-remove', $product) }}" method="POST">
                                    <button type="submit" class="basket_content__quantity-button minus">
                                        <i class="fa fa-minus" style="font-size:10px"></i>
                                    </button>
                                    @csrf
                                </form>
                                <span class="basket_content__quantity-value">{{ $product->countInOrder}}</span>
                                <form action="{{ route('basket-add', $product) }}" method="POST">
                                    <button type="submit" class="basket_content__quantity-button">
                                        <i class="fa fa-plus" style="font-size:10px"></i>
                                    </button>
                                    @csrf
                                </form>
                            </div>
                        </td>
                        <td class="basket_content__table-cell"> {{ $product->price }} руб. </td>
                        <td class="basket_content__table-cell"> {{ $product->price * $product->countInOrder}} руб. </td>
                    </tr>
                @endforeach                
                <tr>
                    <td class="basket_content__total"> Общая стоимость: </td>
                    <td colspan="2"> </td>
                    <td class="basket_content__total"> {{ $order->getFullPrice() }} руб. </td>
                </tr>
            </tbody>
        </table>
        <div class="basket_content__checkout-button">
            <a type="button" class="basket_content__checkout-button_a" href="{{ route('basket-place') }}"> Оформить заказ </a>
        </div>
    </div>

@endsection
