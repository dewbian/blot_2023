<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
@php
   // $name = route('portifolio.all') ;
   // echo "name==>[".$name."]";
@endphp


			

            <div class="top-right links">
                <a href="{{ url('/master') }}">관리자 페이지</a><br><br>  
                <a href="{{ url('/portfolio1') }}">포트폴리오1</a><br><br>  
                <a href="{{ url('/port.html') }}">포트폴리오2</a><br><br>  
                <a href="{{ $url = route('portfolio.all') }}">Get all portfolios by API</a>  
            </div>  
            <div class="content">
                <div class="title m-b-md">
                    B-lot
                </div>

                <div class="links">
                    <a href="{{ route('instagram.all') }} ">이안의 인스타그램 구경가기</a> 
                </div>
            </div>
        </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>        
    </body>
</html>
