@extends('layouts.master')

@section('title', 'Каталог товаров')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/categories.css') }}">
@endsection

@section('content')
    <form method="GET" action="{{ route('index') }}" class="catalog_form">
        @include('auth.layouts.error', ['fieldName' => 'article'])
        <input class="catalog_input" type="text" name="search_on_site" id="search_on_site" placeholder="Искать на сайте..." value="{{ request()->search_on_site }}">
        <button class="catalog_button" type="submit">Найти</button>
        <div class="catalog-container-cart">
            <a class="color_for_catalog" href="{{ route('basket') }}"><i class="fa-solid fa-basket-shopping"></i></a>
            <span class="item-count">{{ $totalCount }}</span>
        </div>
    </form>

    <div class="catalog_content">
        @foreach ($categories as $category)
            <div class="label">
                <a class="catalog_content_href" href="/categories/{{ $category->code }}">
                    <div class="text">{{ $category->name }}</div>
                    <img  src="{{ Storage::url($category->img) }}" class="catalog_image">
                </a>
            </div>
        @endforeach
    </div>
@endsection
