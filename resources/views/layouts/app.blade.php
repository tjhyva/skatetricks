<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Skatetricks</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>      
        @section('header')
            <h1 class="title">Skatetricks</h1>                 
        @show
        @section('userinfo')
        <div class="login">
            <!-- Authentication Links -->
            @guest
                <button class="authbtn" onclick="window.location.href='{{ route('login') }}'">Login</button> 
                    @if (Route::has('register'))
                        <button class="authbtn" onclick="window.location.href='{{ route('register') }}'">Register</button>                     
                    @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">                    
                    @csrf
                </form>
                </div>
            </li>
            @endguest
            </div>
        @show
        @section('infobar')
        @guest
        @else
        <div class="loginuser">
            Hello {{ Auth::user()->name }}!
            <br>
                <a class="logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>   
        </div>
        @endguest            
        @section('userinfotrick')
        <div class="login">
            <!-- Authentication Links -->
            @guest
                <button class="authbtn" onclick="window.location.href='{{ route('login') }}'">Login</button> 
                @if (Route::has('register'))
                    <button class="authbtn" onclick="window.location.href='{{ route('register') }}'">Register</button>                     
                @endif
            @else               
                             
            @endguest
            </div>
        @show
        @yield('content')                
    </body>
</html>