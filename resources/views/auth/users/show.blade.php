@extends('auth.layouts.master')

@section('title', 'Заказы пользователя' . $user -> id)

@section('content')

<div class="py-4">
    <div class="container">
        <div class="justify-content-center">
            <div class="panel">
                <h1>Заказчик: <b>{{ $user->name }}</b></h1>
                <p>Почта: <b>{{ $user->email }}</b></p>                
                @foreach($user->orders as $order)
                    <div class="col-mb-4">
                        <h4>Заказ #{{ $order->id }} от {{ $order->created_at->format('d.m.Y H:i') }}</h4>
                        <table class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th class="text-end">Название</th>
                                    <th class="text-center">Статус заказа</th>
                                    <th class="text-center">Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td class="text-end">{{ $product->name }}</td>
                                        <td class="text-center">{{ $order->status }}</td>
                                        <td class="text-center">{{ $product->price }} руб.</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
                <br>
            </div>
        </div>
    </div>
</div>

@endsection
