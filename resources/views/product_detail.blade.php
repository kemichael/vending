<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品詳細</title>

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
                     <button type="button" onclick="history.back()">戻る</button>
                     <button type="button" onclick="location.href='{{route('edit',['id' => $detail -> id])}}'">編集</button>
                </div>

                
            </div>
        </div>
    </body>
</html>
