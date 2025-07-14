@extends('auth.layouts.master')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Телефон
                </th>
                <th>
                    Когда отправлен
                </th>
                <th>
                    Сумма
                </th>
                <th>
                    Адрес
                </th>
                <th>
                    Вид оплаты
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id}}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->sum }} руб.</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success mr-3" type="button" 
                            @admin
                            href="{{ route('orders.show' , $order) }}"
                            @else
                            href="{{ route('person.orders.show' , $order) }}"
                            @endadmin
                            >Открыть</a> 
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $orders->links('layouts.paginate') }}
    </div>
@endsection
