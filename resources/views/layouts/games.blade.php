<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        @include('partials.front.head')
        <script data-ad-client="ca-pub-7121193606171576" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body class="{{ $bclass }}">
        <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
        @include('partials.front.mobilemenu')
        <div id="page">
            @include('partials.front.game_navbar')
            @yield('content')
            @include('partials.front.footer')
        </div>
        @include('partials.front.scripts')
    </body>
</html>