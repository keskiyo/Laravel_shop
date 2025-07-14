@extends('auth.layouts.master')

@section('title', 'Категории')

@section('content')
<div class="col-md-12">
    <h1>Категории</h1>
    <table class="table">
        <tbody>
        <tr>
            <th>
                #
            </th>
            <th>
                Код
            </th>
            <th>
                Название
            </th>
            <th>
                Действия
            </th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->code }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            <a class="btn btn-success" type="button" href="{{ route('categories.show', $category) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category) }}"><i class="fas fa-pencil-alt"></i></a>
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
    {{ $categories->links('layouts.paginate') }}
    <a class="btn btn-success" type="button"
       href="{{ route('categories.create') }}">Добавить категорию</a>
</div>
@endsection