@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            商品詳細
        </div>
        <div class="detail" >
            <table>
                <tr>
                    <td>id:{{ $detail -> id}}</td>
                    <td>商品名</td>
                    <td>{{ $detail -> product_name }}</td>
                </tr>
                <tr>
                    <td rowspan="5"><img src="{{ Storage::url($detail -> img_path) }}" width="1%"></td>
                    <td>メーカー</td>
                    <td>{{ $detail -> company_name}}</td>
                </tr>
                <tr>
                    <td>価格</td>
                    <td>{{ $detail -> price}}</td>
                </tr>
                <tr>
                    <td>在庫数</td>
                    <td>{{ $detail -> stock }}</td>
                </tr>
                <tr>
                    <td rowspan="2">コメント</td>
                    <td rowspan="2">{{ $detail -> comment}}</td>
                </tr>
            </table>
        </div>
        <div>
                <button type="button" onclick="location.href='{{ route('products') }}'">戻る</button>
                <button type="button" onclick="location.href='{{ route('edit',['id' => $detail -> id]) }}'">編集</button>
        </div>                
    </div>
@endsection