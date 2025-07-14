@extends('auth.layouts.master')

@section('title', 'Заказы' . $order -> id)

@section('content')

<div class="py-4">
    <div class="container">
        <div class="justify-content-center">
            <div class="panel">
                <h1>Заказ №{{ $order->id }}</h1>
                <p>Заказчик: <b>{{ $order->name }}</b></p>
                <p>Номер телефона: <b>{{ $order->phone }}</b></p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Стоимость</th>
                    </tr>
                    </thead> 
                    <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('categories', $product) }}">
                                    <img height="60px"
                                         src="{{ Storage::url($product->img) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td><span class="badge"> {{ $product->pivot->count }}</span></td>
                            <td>{{ $product->pivot->price }} руб.</td>
                            <td> {{ $product->pivot->price * $product->pivot->count }} руб.</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{ $order->sum }} руб.</td>
                    </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>

@endsection
