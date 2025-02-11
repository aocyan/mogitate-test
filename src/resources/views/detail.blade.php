@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="background--color">
    <nav>
        <div class="header__nav">
            <a class="header__nav--text" href="/products">商品一覧</a><span class="header__nav--item">>キウイ</span>
        </div>
    </nav>
    <div class="detail">
        <form class="detail-form" action="/products" method="post">
        @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <p>商品名</p>
                </div>
                <input class="form__input" type="text" name="name" value="{{ old('name') }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__group-title">
                    <p>値段</p>
                </div>
                <input class="form__input" type="text" name="price" value="{{ old('price') }}"/>
                <div class="form__error">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group-title">
                    <p>季節</p>
                    <div class="season__check">
                        <label><input type="checkbox" name="season" value="spring"> 春</label>
                        <label><input class="season__check--text" type="checkbox" name="season" value="summer"> 夏</label>
                        <label><input class="season__check--text" type="checkbox" name="season" value="autumn"> 秋</label>
                        <label><input class="season__check--text" type="checkbox" name="season" value="winter"> 冬</label>
                    </div>
                </div>
                <div class="form__error">
                    @error('season')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group-image">
                    <div class="image__text">
                        <input type="file" id="image-upload" name="image" accept="image/*" value="{{ old('image') }}"/>
                    </div>
                </div>
                <div class="form__error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__group-text">
                    <p>商品説明</p>
                    <textarea class="form__message--text" name="message" rows="8" cols="100"></textarea>
                </div>
                <div class="form__error">
                    @error('message')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form__button">
                    <a class="form__button-back" href="/products">戻る</a>
                    <button class="form__button-submit" type="submit" name="back" value="back">変更を保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection