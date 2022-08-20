@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            商品一覧
        </div>

        <div class ="serch">
            <form action="{{ route('products') }}" method="GET">
                <input type="text" name="keyword" value="{{ $keyword }}">
                
                <select name="company" data-toggle="select">
                    <option value="">全て</option>
                    @foreach($companies_list as $company_list)
                        <option value="{{ $company_list -> company_name}}">{{ $company_list -> company_name}}</option>
                    @endforeach
                </select>

                <input type="submit" id="serch-btn" value="検索">
                <button type="button" onclick="location.href='{{ route('regist') }}'">新規登録</button>
                
            </form>
        </div>

        <div class="links">
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th>詳細表示</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product -> id }}</td>
                    <td><img src="{{ Storage::url($product -> img_path) }}" width="1%"></td>
                    <td>{{ $product -> product_name }}</td>
                    <td>{{ $product -> price }}</td>
                    <td>{{ $product -> stock }}</td>
                    <td>{{ $product -> company_name }}</td>
                    <td><button type="button" onclick="location.href='{{ route('detail', ['id'=> $product -> id]) }}'">詳細表示</button></td>
                    <form action="{{ route('delete', ['id' => $product -> id])}}" method="POST">
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

