
@extends('auth.layouts.master')

@section('title', 'Товары')

@section('content')
<div class="col-md-12">
    <h1>Товары</h1>
    <table class="table">
        <tbody>
        <tr>
            <th>
                #
            </th>
            <th>
                Название
            </th>
            <th>
                Категория
            </th>
            <th>
                Производитель
            </th>
            <th>
                Артикул
            </th>
            <th>
                Цена
            </th>
            <th>
                Кол-во
            </th>
            <th>
                Действия
            </th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id}}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->manufacturer }}</td>
                <td>{{ $product->article }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->count }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            <a class="btn btn-success" type="button"
                               href="{{ route('products.show', $product) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning" type="button"
                               href="{{ route('products.edit', $product) }}"><i class="fas fa-pencil-alt"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links('layouts.paginate') }}
    <a class="btn btn-success" type="button" href="{{ route('products.create') }}">Добавить товар</a>
</div>
@endsection