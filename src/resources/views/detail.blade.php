@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="background--color">
    <nav>
        <div class="header__nav">
            <a class="header__nav--text" href="/products">商品一覧</a><span class="header__nav--item">> {{ $product->name }}</span>
        </div>
    </nav>
    <div class="detail">
        <form class="detail-form" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form__group">
                <div class="form__group-title">
                    <p>商品名</p>
                </div>
                <input class="form__input" type="text" name="name" value="{{ old('name',$product->name) }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__group-title">
                    <p>値段</p>
                </div>
                <input class="form__input" type="text" name="price" value="{{ old('price',$product->price) }}" />
                <div class="form__error">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group-title">
                    <p>季節</p>
                    <div class="season__check">
                        @php
                            $selectedSeasons = $product->seasons->pluck('name')->toArray();
                        @endphp
                        <label>
                            <input class="season__check--text" type="checkbox" name="season[]" value="春" {{ in_array('春', old('season', $selectedSeasons)) ? 'checked' : '' }}> 春
                        </label>
                        <label>
                            <input class="season__check--text" type="checkbox" name="season[]" value="夏" {{ in_array('夏', old('season', $selectedSeasons)) ? 'checked' : '' }}> 夏
                        </label>
                        <label>
                            <input class="season__check--text" type="checkbox" name="season[]" value="秋" {{ in_array('秋', old('season', $selectedSeasons)) ? 'checked' : '' }}> 秋
                        </label>
                        <label>
                            <input class="season__check--text" type="checkbox" name="season[]" value="冬" {{ in_array('冬', old('season', $selectedSeasons)) ? 'checked' : '' }}> 冬
                        </label>
                    </div>
                    <div class="form__error--season">
                    @error('season')
                        {{ $message }}
                    @enderror
                    </div>
                </div>
                <div class="form__group-image">
                    <div class="image__item">
                        <img class="image__item--detail" src="{{ asset('storage/products/' . basename($product->image)) }}" alt="{{ $product->name }}" />
                    </div>
                    <div class="image__text">
                        <input class="image__text--item" type="file" id="image-upload" name="image" accept="image/*" value="{{ $product->image }}"/>
                    </div>
                </div>
                <div class="form__error--image">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group-text">
                    <p>商品説明</p>
                    <textarea class="form__message--text" name="description" rows="8" cols="100">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form__error--descripton">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__button">
                    <a class="form__button-back" href="/products">戻る</a>
                    <button class="form__button-submit" type="submit">変更を保存</button>
                </div>
            </div>
        </form>
        <form action="{{ url('/products/' . $product->id . '/delete') }}" method="post" style="display:inline;">
        @csrf
        @method('DELETE')
            <button class="form__button-delete" type="submit">
                <img class="form__button-delete--item" src="{{ asset('storage/products/trash.png') }}" alt="ゴミ箱" />
            </button>
        </form>
    </div>
</div>
@endsection