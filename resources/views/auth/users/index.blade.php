@extends('auth.layouts.master')

@section('title', 'Пользователи')

@section('content')
    <div class="col-md-12">
        <h1>Пользователи</h1>
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
                    Почта
                </th>
                <th>
                    Дата регистрации
                </th>
                <th>
                    Роль
                </th>
                <th>
                    Описание
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $user->is_admin ? 'Админ' : 'Пользователь' }}</td>
                    <td>{{ $user->descriptions }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button" href="{{ route('users.show', $user) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-warning" type="button" href="{{ route('users.edit', $user) }}"><i class="fas fa-pencil-alt"></i></a>                                
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $users->links('layouts.paginate') }}
    </div>
@endsection
