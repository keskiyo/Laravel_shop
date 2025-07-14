<div class="product">
    <div class="div_katalog">
        <a href="{{ route('product', [$category->code, $product->article]) }}"><img src="{{ Storage::url($product->img) }}" alt="{{ $product->name }}"></a>
    </div>
    <div class="product-info">
        <a href="{{ route('product', [$category->code, $product->article]) }}"><h2 class="card_content__h2">{{ $product->name }}</h2></a>
        <p class="card_content__p"> Производитель: {{ $product->manufacturer }}</p>
        <p class="card_content__p"> Артикул: 
            <span id="product-article">{{ $product->article }}</span>
            <button class="copy-icon-btn" data-target="product-article" title="Скопировать артикул">
                <i class="fa-solid fa-copy"></i>
            </button>
        </p>
        <p class="card_content__p"> Цена: <span class="price">{{ $product->price }} ₽</span></p>
    </div>
    <div class="button-container">
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            @if($product->isAvailable())
                <button type="submit" class="button_trash" role="button"> В корзину </button>
            @else
               <p class="empty"> Не доступен </p>
            @endif
        </form>
    </div>
   <a href="{{ route('product', [$category->code, $product->article]) }}" role="button" class="button_podrobnee"> Подробнее </a>
</div>
