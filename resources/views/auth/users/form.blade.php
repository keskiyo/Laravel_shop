@extends('auth.layouts.master')

@section('title', 'Редактирование пользователя')

@section('content')
<div class="col-md-12">
    @isset($user)
        <h1>Редактировать описание <b>{{ $user->name }}</b></h1>
    @endisset
    <form method="POST" enctype="multipart/form-data"
        @isset($user)
          action="{{ route('users.update', $user) }}"
        @endisset>

        <div>
            @isset($user)
                @method('PUT')
            @endisset
            @csrf
            <br>
            <div class="input-group row">
                <label for="descriptions" class="col-sm-2 col-form-label">Описание пользователя: </label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="descriptions" id="descriptions"
                           rows="3">@isset($user){{ $user->description }}@endisset</textarea>
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="id_admin" class="col-sm-2 col-form-label">Роль: </label>
                <div class="col-sm-6">
                    <select class="form-control" name="id_admin" id="id_admin">
                        <option value="0" @isset($user) @if($user->id_admin == 0) selected @endif @endisset>Пользователь</option>
                        <option value="1" @isset($user) @if($user->id_admin == 1) selected @endif @endisset>Администратор</option>
                    </select>
                </div>
            </div>
            <br>
            <button class="btn btn-success">Сохранить изменения</button>
        </div>
    </form>
</div>
@endsection
