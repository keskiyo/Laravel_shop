@extends('layouts.master')

@section('title', 'Оформление заказа')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/order.css') }}">
@endsection

@section('content')
    <div class="starter-template">
        <h1>Подтверждение заказа</h1>
    </div>
    
    <div class="order_container">
        <div class="row justify-content-center">
            <p>Общая стоимость заказа: <b>{{ $order->getFullPrice() }}</b> ₽</p>
            
            <form action="{{ route('basket-confirm') }}" method="POST" id="orderForm">
                <div>
                    <p>Укажите свои данные, чтобы мы могли с вами связаться: </p>
                    
                    <div class="order_container">
                        <div class="tabs">
                            <button type="button" class="tab-btn active" data-tab="pickup">Самовывоз</button>
                            <button type="button" class="tab-btn" data-tab="delivery">Доставка</button>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" class="from-control" value="{{ auth()->user()->name ?? old('name') }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер телефона: </label>
                            <div class="col-lg-4">
                                <input type="tel" name="phone" id="phone" class="from-control" value="@isset($order){{ $order->phone }}@endisset">
                            </div>
                        </div>
                        <br>
                            <div class="form-group">
                                <label for="email" class="control-label col-lg-offset-3 col-lg-2">Почта: </label>
                                <div class="col-lg-4">
                                    <input type="email" name="email" id="email" class="from-control" value="{{ auth()->user()->email ?? old('email') }}" required>
                                </div>
                            </div>
                        <br>
                        <div class="form-group">
                            <label for="paymentMethod" class="control-label col-lg-offset-3 col-lg-2">Способ оплаты: </label>
                            <div class="col-lg-4">
                                <select name="paymentMethod" id="paymentMethod" class="from-control" required>
                                    <option value="">Выберите способ оплаты</option>
                                    <option value="cash">Наличными</option>
                                    <option value="card">Картой</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div id="cardFields" style="display: none;">
                            <div class="form-group">
                                <label for="card_number" class="control-label col-lg-offset-3 col-lg-2">Номер карты: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="payment[card_number]" id="card_number" class="from-control" 
                                     value="@isset($payment){{ $payment->card_number }}@endisset" placeholder="0000 0000 0000 0000">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="card_expiry" class="control-label col-lg-offset-3 col-lg-2">Срок действия: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="payment[card_expiry]" id="card_expiry" class="from-control" 
                                    value="@isset($payment){{ $payment->card_expiry }}@endisset" placeholder="MM/YY">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="card_cvv" class="control-label col-lg-offset-3 col-lg-2">CVV: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="payment[card_cvv]" id="card_cvv" class="from-control" placeholder="CVV">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="deliveryFields" style="display: none;">
                            <div class="form-group">
                                <label for="delivery_address" class="control-label col-lg-offset-3 col-lg-2">Адрес доставки: </label>
                                <div class="col-lg-4">
                                    <div class="address-group">
                                        <input type="text" name="delivery_address" id="delivery_address" class="from-control" 
                                        value="@isset($order){{ $order->delivery_address }}@endisset" placeholder="ул. Ленина, д. 10, кв. 25">
                                        <button type="button" id="mapButton" class="map-button" title="Выбрать на карте">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM12 11.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#FF0000"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="map" style="display: none; height: 300px; margin-top: 10px;"></div>
                        </div>
                    </div>
                    <br>
                    @csrf
                    @auth
                        <input type="submit" class="btn-success" value="Подтвердить заказ">
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary">Для подтверждения заказа войдите в систему</a>
                    @endguest
                </div>
            </form>
        </div>
    </div>
@endsection
    
@section('js')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=73951599-c5aa-41ee-a8be-52275d5211ed&lang=ru_RU" type="text/javascript"></script>
    <script src="{{ asset('js/jsOrder.js') }}" defer></script>
@endsection
