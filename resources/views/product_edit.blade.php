@extends('layouts.app')

@section('title', '商品情報編集')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            商品情報編集
        </div>
        <form  method="post" >
            @method('patch')
            @csrf
            <div class="form">
                <table>
                    <tr>
                        <td>商品ID : {{ $edit->id}}</td>
                    </tr>
                    <tr>
                        <td>商品名</td>
                        <td><input type="text" name="name" id="name" value="{{ $edit->product_name}}"></td>
                    </tr>
                    <tr>
                        <td>メーカー</td>
                        <td>  
                            <select name="maker"  id="maker" data-toggle="select">
                            <option value="{{ $edit->company_id}}" >{{ $edit->company_name}}</optioin>
                            @foreach($companies as $company)
                            <option value="{{ $edit->id}}" >{{ $company->company_name}}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>価格</td>
                        <td><input type="text" name="price" id="price" value="{{ $edit->price }}"></td>
                    </tr>
                    <tr>
                        <td>在庫数</td>
                        <td><input type="text"  name="stock" id="stock" value="{{ $edit->stock }}"></td>
                    </tr>
                    <tr>
                        <td>コメント</td>
                        <td><textarea name="comment" id="comment" cols="30" rows="3" value="{{ $edit->comment }}"></textarea></td>
                    </tr>
                    <tr>
                        <td>商品画像</td>
                        <td><input type="file"></td>
                    </tr>
                </table>
                
                <div class="submit">
                    <input type="submit" name="submit" value="更新">
                    <button type="button" onclick="location.href='{{ route('detail',['id' => $edit->id]) }}'">戻る</button>
                </div>
            </div>
        </form>
    </div>
@endsection