@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            <a href="{{ route('products') }}">商品一覧</a>
        </div>

        <div class ="serch">
            <form action="{{ route('products') }}" method="GET">
                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="商品名">
                
                <select name="company" data-toggle="select">
                    <option value="">メーカー</option>
                    @foreach($companies_list as $company_list)
                        <option value="{{ $company_list->company_name}}">{{ $company_list->company_name}}</option>
                    @endforeach
                </select>

                <select name="price-o" data-toggle="select">
                    <option value="">価格下限</option>
                    <option value="o100">100円~</option>
                    <option value="o200">200円~</option>
                </select>

                <select name="price-u" data-toggle="select">
                    <option value="">価格上限</option>
                    <option value="u100">~100円</option>
                    <option value="u200">~200円</option>
                </select>

                <select name="stock-o" data-toggle="select">
                    <option value="">在庫数下限</option>
                    <option value="o50">50個~</option>
                    <option value="o100">100個~</option>
                    <option value="o200">200個~</option>
                    <option value="o300">300個~</option>
                </select>

                <select name="stock-u" data-toggle="select">
                    <option value="">在庫上限</option>
                    <option value="u100">~100個</option>
                    <option value="u200">~200個</option>
                    <option value="u300">~300個</option>
                </select>

                <input type="submit" id="serch-btn" value="検索">
                <button type="button" onclick="location.href='{{ route('regist') }}'">新規登録</button>
                
            </form>
        </div>

        <div class="links">
            <table rules="all">
            <thead>
                <tr>
                    <th>@sortablelink('id', 'ID')</th>
                    <th>商品画像</th>
                    <th width="200px">@sortablelink('product_name', '商品名')</th>
                    <th width="70px">@sortablelink('price', '価格')</th>
                    <th width="70px">@sortablelink('stock', '在庫数')</th>
                    <th>@sortablelink('company_name', 'メーカー名')</th>
                    <th>詳細表示</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ Storage::url($product->img_path) }}" ></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td><button type="button" onclick="location.href='{{ route('detail', ['id'=> $product->id]) }}'">詳細表示</button></td>
                    <form action="{{ route('delete', ['id' => $product->id])}}" method="POST">
                        @csrf
                    <td><input type="submit" id="del-id" class="del-btn" value="削除"></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection

