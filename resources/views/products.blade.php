<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品一覧</title>

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
        
                        <input type="submit" value="検索">
                        <a href="{{ route('regist')}}">新規登録</a>
                        
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
                            <td><img src="{{ Storage::url($product -> img_path) }}" ></td>
                            <td>{{ $product -> product_name }}</td>
                            <td>{{ $product -> price }}</td>
                            <td>{{ $product -> stock }}</td>
                            <td>{{ $product -> company_name }}</td>
                            <td><a href="{{ route('detail', ['id'=> $product -> id])}}">詳細表示</a></td>
                            <form action="{{ route('delete', ['id' => $product -> id])}}" method="POST">
                                @csrf
                            <td><input type="submit" class="del-btn" value="削除"></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </body>
</html>
