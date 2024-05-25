<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lopte Phim</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}" type="text/css">

</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul class="d-flex">
                            <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{route('home')}}">Homepage</a></li>
                            <li class="{{ request()->is('*phim-le') ? 'active' : '' }}"><a href="{{route('client.theloai', 'phim-le')}}">Phim Lẻ</a></li>
                            <li class="{{ request()->is('*phim-viet') ? 'active' : '' }}"><a href="{{route('client.theloai', 'phim-viet')}}">Phim Vệt</a></li>
                            <li class="{{ request()->is('*phim-chieu-rap') ? 'active' : '' }}"><a href="{{route('client.theloai', 'phim-chieu-rap')}}">Phim Chiếu Rạp</a></li>
                            <li class="{{ request()->is('*game-mod') ? 'active' : '' }}"><a href="{{route('client.gamemod')}}">Game mod</a></li>
                            <li class="{{ request()->is('*app-mod') ? 'active' : '' }}"><a href="{{route('client.appmod')}}">App mod</a></li>

                            <li><a href="#">Liên hệ</a>
                                <ul class="dropdown my-dropdown">
                                    <li><a target="_blank" href="https://www.facebook.com/cnlopte?mibextid=LQQJ4d">Fanpage</a></li>
                                    <li><a target="_blank" href="https://t.me/ModGameAppTrick">Telegram</a></li>
                                </ul>
                            </li>
{{--                            <li><a href="#">Quốc gia</a>--}}
{{--                                <ul class="dropdown my-dropdown">--}}
{{--                                    @foreach($countries as $country)--}}
{{--                                        <li><a href="{{route('client.quocgia', $country->slug)}}">{{$country->name}}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
{{--                    <a href="./login.html"><span class="icon_profile"></span></a>--}}
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
