@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="background--color">
    <div class="register-header">
        <div class="register-header__logo">
            <h2>商品一覧</h2>
        </div>
         <div class="header__nav">
            <a class="header__nav--text" href="/products/register">+ 商品を追加</a>
        </div>
    </div>
    <div class="nav-product-box">
        <div class="nav__box">
            <nav>
                <div class="side__nav">
                    <input class="product__search--text" type="text" name="商品名で検索" value="{{ old('name') }}" placeholder="商品名で検索"/>
                    <div class="product__search-button">
				        <input class="product__search-button--item" type="submit" value="検索">
                    </div>
                    <div class="price__search">
                        <p class="price__search--text">価格順で表示</p>
                        <select class="price__search-select" name="price">
					        <option class="search__detail--text" value="" disabled selected>価格で並べ替え</option>
                            <option class="form__detail--option" value="高い順に表示">高い順に表示</option>
                            <option class="form__detail--option" value="低い順に表示">低い順に表示</option>
                        </select>
                    </div>
                </div>
            </nav>
        </div>
        <div class="product">
            <form class="product-form" action="/products" method="post">
            @csrf
                <div class="product__container">
                @foreach ($products as $product)
                    <div class="product-item">
                        <img class="product__image" src="{{ asset('storage/products/' . basename($product->image)) }}" alt="{{ $product->name }}" />
                        <div class="product__text">
                            <input class="name--text" type="text" name="name" value="{{ $product['name'] }}" readonly />
                            <input class="price--text" type="text" name="price" value="￥{{ $product['price'] }}" readonly />
                        </div>
                    </div>
                @endforeach
                </div>
            </form>
            <div class="paginate">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection