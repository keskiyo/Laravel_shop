@extends('layouts.master')

@section('title', 'Товары на сайте')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/zap.css') }}">
@endsection

@section('content')
    <form method="GET" action="{{ route('index') }}" class="catalog_form">
        @include('auth.layouts.error', ['fieldName' => 'article'])
        <input class="catalog_input" type="text" name="search_on_site" id="search_on_site" placeholder="Искать на сайте..." value="{{ old('search_on_site') }}">
        <button class="catalog_button" type="submit">Найти</button>
        <div class="catalog-container-cart">
            <a class="color_for_catalog" href="{{ route('basket') }}"><i class="fa-solid fa-basket-shopping"></i></a>
            <span class="item-count">{{ $totalCount }}</span>
        </div>
    </form>

<div class="content-section">
    <div class="filters-panel">
            <h3 class="filters-title">Фильтры</h3>
        
            <form method="GET" action="{{ route('index') }}" class="filters-form">
            <!-- Фильтр по цене -->
            <div class="filter-group">
                <label class="filter-label">Цена</label>
                <div class="price-range">
                    <input type="number" name="price_min" class="price-input" placeholder="От" value="{{ request()->price_min }}">
                    <span class="price-separator">-</span>
                    <input type="number" name="price_max" class="price-input" placeholder="До" value="{{ request()->price_max }}">
                </div>
            </div>
            
            <!-- Фильтр по производителям -->
            <div class="filter-group">
                <label class="filter-label">Производители</label>
                <div class="manufacturer-checkbox-list">
                    @foreach($category->products->unique('manufacturer') as $product)
                        <label>
                        <input type="checkbox" name="manufacturers[]" value="{{ $product->manufacturer }}" 
                            {{ in_array($product->manufacturer, (array)request()->manufacturers) ? 'checked' : '' }}>
                            {{ $product->manufacturer }}
                        </label>
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="apply-filters-btn">Применить</button>
            <button type="reset" class="reset-filters-btn">Сбросить</button>
            </form>
        </div>

    <div class="container_zap">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                @include('layouts.card', compact('product'))
            @endforeach
        @endif
        <button id="scrollToTopBtn" class="scroll-to-top">&#8679;</button>
    </div>
</div>
    {{ $products->links('layouts.paginate') }}
@endsection
