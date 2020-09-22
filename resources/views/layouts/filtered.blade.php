<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        @include('partials.front.head')
    </head>
    <body class="{{ $bclass }}">
        <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
        @include('partials.front.mobilemenu')
        <div id="page">
            @include('partials.front.header')
            @include('partials.front.navbar')
            @yield('content')
            @include('partials.front.footer')
        </div>
        @include('partials.front.scripts')
    </body>
</html>