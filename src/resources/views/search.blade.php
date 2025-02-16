@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
<div class="background--color">
    <div class="search-header">
        <div class="search-header__logo">
            <h2>"{{ $searchName }}{{ $selectedPriceOrder }}"の商品一覧</h2>
        </div>
    </div>
    <div class="nav-product-box">
        <div class="nav__box">
            <nav>
                <div class="side__nav">
                    <form class="product-form" action="{{ route('products.search') }}" method="get">
                        <input class="product__search--text" type="text" name="name" value="{{ request('name') }}" placeholder="商品名で検索"/>
                        <div class="product__search-button">
				            <button class="product__search-button--item" type="submit">検索</button>
                        </div>
                        <div class="price__search">
                            <p class="price__search--text">価格順で表示</p>
                            <select class="price__search-select" name="price" >
					            <option class="search__detail--text" disabled selected>価格で並べ替え</option>
                                <option class="form__detail--option" value="高い順に表示" {{ request('price') == '高い順に表示' ? 'selected' : '' }}>高い順に表示</option>
                                <option class="form__detail--option" value="低い順に表示" {{ request('price') == '低い順に表示' ? 'selected' : '' }}>低い順に表示</option>
                            </select>
                            <div class="filters">
                             @if(request('price'))
                                <div class="filter-tag">
                                    <span class="filter-tag__text">{{ request('price') }}</span>
                                    <a class="filter-tag__link" href="{{ route('products.search', ['name' => request('name')]) }}" class="filter-tag__remove"><span class="tag--cancel">×</span></a>
                                </div>
                             @endif
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <div class="product">
            <div class="product__container">
            @if($products->isEmpty())
                <p>該当する商品がありません。</p>
            @else
                @foreach ($products as $product)
                <div class="product-item">
                    <a class="product-item__link" href="{{ route('products.show', $product->id) }}">
                        <img class="product__image" src="{{ asset('storage/products/' . basename($product->image)) }}" alt="{{ $product->name }}" />
                        <div class="product__text">
                            <input class="name--text" type="text" name="name" value="{{ $product->name }}" readonly />
                            <input class="price--text" type="text" name="price" value="￥{{ $product->price }}" readonly />
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
            </div>
            <div class="paginate">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection