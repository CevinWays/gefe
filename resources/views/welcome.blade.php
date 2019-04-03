<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GEFE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            #onepage {
              -webkit-font-smoothing: antialiased;
              -moz-osx-font-smoothing: grayscale;
              font-size: 100%;
            }
            *{
                margin: 0;
                padding: 0;
                border: 0;
                outline: 0;
                font-size: 100%;
                vertical-align: baseline;
                background: transparent;
            }
            .todo-logo{
                max-width: 50px;
                /* vertical-align: middle; */
            }
            .landing{
                overflow: hidden;
                min-width: 600px;
                position: relative;
            }
            .nav{
                padding-top: 3em;
            }
            .pages{
                float: right;
                text-align: right;
            }
            .pages a {
                text-decoration: none;
                color: #1F2122;
                margin-left: 25px;
                vertical-align: middle;
                font-weight: bold;
            }
            .landingWrapper{
                width: 88%;
                margin: auto;
            }
            .landingContent{
                width: 88%;
                margin: 70px 50px 0 50px;
                display: flex;
            }
            .aboutContent{
                width: 88%;
                margin: 100px auto 0 auto;
                display: flex;
            }
            .contentLeft{
                flex: 0 0 55%;
            }
            .contentRight{
                flex: 0 0 45%;
            }
            .contentLeft h1, .contentLeft p{
                color: #212121;
                text-decoration: none;
            }
            .btnTwo{
                background-color: #212121;
                border-radius: 100px;
                padding: 0.8em 1.75em;
                display: block;
                width: 180px;
                margin-top: 40px;
                text-align: center;
                text-decoration: none;
                color: white;
            }
            h1{
                font-size: 36px;
                margin-bottom: 18px;
            }
            p{
                font-size: 18px;
                font-weight: 100;
                margin-bottom: 20px;
                opacity: 0.8;
            }
            a{
                font-size: 16px;
            }
            .iphoneHand{
                margin-top: -40px;
                width: 600px;
            }
            .img-group{
                width: 420px;
                margin-top: -40px;
            }
            .logo-align{
                display: inline-flex;
            }
            .logo-text{
                margin-left: 5px;
            }
            .logo-text h1{
                color: #212121;
            }
            
            </style>
    </head>
    <body>
        <div id="onepage">
            <div class="section">
                <div class="landing">
                    <div class="landingWrapper">
                        <div class="nav">
                            <div class="logo-align">
                                <a href="#"><img src="img/cctv.png" alt="" class="todo-logo"></a>
                                <div class="logo-text">
                                    <h1>GEFE</h1>
                                </div>
                            </div>
                            <div class="pages">
                                @auth
                                <a href="{{ url('/dashboard') }}">HOME</a>
                                @else
                                <a href="{{ route('login') }}">LOGIN</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">SIGN UP</a>
                                @endif
                                @endauth
                            </div>
                        </div>
                        <div class="landingContent">
                            <div class="contentLeft">
                                <h1>All Your Vehicle Safety<br>With GET SAFE.</h1> 
                                <p>We provide the best system security for all your vehicle, <br>You can controll it on your smartphone anywhere and everywhere.</p>
                                <p>Get our application now by download the application below! <br>
                                Or you just can access the website </p>
                                <a href="#" class="btnTwo">Download App</a>
                            </div>
                            <div class="contentRight">
                                <img src="img/vehicle.png" alt="vehicle image" class="iphoneHand">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
