@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
            @endisset
        >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control" style="height: 50px">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @isset($product)
                                        @if($product->category_id == $category->id)
                                            selected
                                        @endif
                                    @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'code'])
                        <select name="code" id="code" class="form-control" style="height: 50px">
                            @foreach($categories as $category)
                                <option value="{{ $category->code }}"
                                    @isset($product)
                                        @if($product->code == $category->code)
                                            selected
                                        @endif
                                    @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                    </div>
                </div>
                <br>
                    <div class="input-group row">
                        <label for="manufacturer" class="col-sm-2 col-form-label">Производитель: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'manufacturer'])
                            <select class="form-control" name="manufacturer" id="manufacturer" style="height: 50px">
                                @foreach($products->pluck('manufacturer')->unique() as $manufacturer)
                                    <option value="{{ $manufacturer }}"
                                        @isset($product)
                                            @if($product->manufacturer == $manufacturer)
                                            selected
                                            @endif
                                        @endisset
                                    >{{ $manufacturer }}</option>
                                @endforeach
                            </select>                           
                        </div>
                    </div>
                <br>
                <div class="input-group row">
                    <label for="article" class="col-sm-2 col-form-label">Артикул: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'article'])
                        <input type="text" class="form-control" name="article" id="article"
                        value="{{ old('article', isset($product) ? $product->article : null) }}">
                    </div>
                </div>
                <br>
                    <div class="input-group row">
                        <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'price'])
                            <input type="number" name="price" id="price" value="@isset($product){{ $product->price }}@endisset" class="form-control">
                        </div>
                    </div>
                <br>
                <div class="input-group row">
                    <label for="img" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="img" id="img">
                        </label>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'count'])
                        <input type="number" name="count" id="count" value="@isset($product){{ $product->count }}@endisset" class="form-control">
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
