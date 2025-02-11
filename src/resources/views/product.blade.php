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
    </div>
    <nav>
        <div class="header__nav">
            <a class="header__nav--text" href="/register">+ 商品を追加</a>
        </div>
        <div class="side__nav">
            <input class="product__search--text" type="text" name="商品名で検索" value="{{ old('name') }}" placeholder="商品名で検索"/>
            <div class="product__search-button">
				    <input class="product__search-button--item" type="submit" value="検索">
            </div>
            <div class="price__search">
                <p>価格順で表示</p>
                <select class="price__search-select" name="price">
					    <option class="search__detail--text" value="" disabled selected>価格で並べ替え</option>
                        <option class="form__detail--option" value="高い順に表示">高い順に表示</option>
                        <option class="form__detail--option" value="低い順に表示">低い順に表示</option>
                </select>
            </div>
        </div>
    </nav>
    <div class="product">
        <form class="detail-form" action="/products" method="post">
        @csrf
            
        </form>
    </div>
</div>
@endsection