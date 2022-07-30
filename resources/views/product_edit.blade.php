<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品情報編集</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

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
                            <td>商品ID : {{ $edit -> id}}</td>
                        </tr>
                        <tr>
                            <td> 商品名</td>
                            <td><input type="text" name="name" id="name" placeholder="{{ $edit -> product_name}}"></td>
                        </tr>
                        <tr>
                            <td>メーカー</td>
                            <td>  
                                <select name="maker"  id="maker" data-toggle="select">
                               <option value="{{ $edit -> company_id}}" >{{ $edit -> company_name}}</optioin>
                            @foreach($companies as $company)
                                <option value="{{ $edit -> id}}" >{{ $company -> company_name}}</option>
                            @endforeach
                        </select></td>
                        </tr>
                        <tr>
                            <td>価格</td>
                            <td><input type="text" name="price" id="price" placeholder="{{ $edit -> price }}"></td>
                        </tr>
                        <tr>
                            <td>在庫数</td>
                            <td><input type="text"  name="stock" id="stock" placeholder="{{ $edit -> stock }}"></td>
                        </tr>
                        <tr>
                            <td>コメント</td>
                            <td><textarea name="comment" id="comment" cols="30" rows="3" placeholder="{{ $edit -> comment }}"></textarea></td>
                        </tr>
                        <tr>
                            <td>商品画像</td>
                            <td><input type="file"></td>
                        </tr>
                    </table>
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="更新">
                    <button type="button" onclick="history.back()">戻る</button>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>
