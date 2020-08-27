<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Data-E-Shop') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        .container{
            width: 100%;
            height: 100vh;
            position: relative;
        }
        .card{
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 600px;
        }
        .submit-btn{
        
           font-size: 18px;
        }

        @media(max-width: 767px) {
          
            .card{
                top: 10%;
                transform: translate(-50%,0%);
                width: 95%;
            }
  
        }

      


    </style>
</head>
<body  style="background: url({{URL::asset('/assets/background/back-1.jpg')}});">
    <div id="app" >
        <main style="background: red;">
            @yield('content')
        </main>
    </div>

    <div id="notification">
      <div id="content">Product Added</div>
    </div>

</body>
</html>
