<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        @include('partials.front.head')
    </head>
    <body class="404error_page">
        <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--> 
        <div id="page">
            @yield('content')
        </div>
        @include('partials.front.scripts')
    </body>
</html>