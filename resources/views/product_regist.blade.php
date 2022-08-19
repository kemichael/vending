@extends('layouts.app')

@section('title', '商品登録')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            商品登録
        </div>
        <form actioin="{{ route('store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form">
            <table>
                <tr>
                    <td> 商品名</td>
                    <td><input type="text"  id="name" name="name" placeholder="商品名" value="{{ old('product_name') }}"></td>
                    @if($errors -> has('product_name'))
                        <p>{{ $errors -> first('product_name') }}</p>
                    @endif
                </tr>
                <tr>
                    <td>メーカー</td>
                    <td><select name="maker" id="maker">
                        @foreach($companies as $company )
                        <option value="{{ $company-> id}}">{{ $company -> company_name}}</option>
                        @endforeach
                        </select>
                        @if($errors -> has('company_name'))
                            <p>{{ $errors -> first('company_name') }}</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>価格</td>
                    <td><input type="text" name="price" id="price" placeholder="価格" value="{{ old('price') }}"></td>
                    @if($errors -> has('price'))
                        <p>{{ $errors -> first('price') }}</p>
                    @endif
                </tr>
                <tr>
                    <td>在庫数</td>
                    <td><input type="text" name="stock" id="stock" placeholder="在庫数" value="{{ old('stock') }}"></td>
                    @if($errors -> has('stock'))
                        <p>{{ $errors -> first('stock') }}</p>
                    @endif
                </tr>
                <tr>
                    <td>コメント</td>
                    <td><textarea name="comment" id="comment" cols="30" rows="3" placeholder="コメント"></textarea></td>
                </tr>
                <tr>
                    <td>商品画像</td>
                    <td><input type="file" name="img_path" id="img_path"></td>
                </tr>
            </table>
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="登録">
            <button type="button" onclick="location.href='{{ route('products') }}'">戻る</button>
        </div>
        </form>
    </div>
@endsection
