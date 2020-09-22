<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        @include('partials.admin.head')
        @include('partials.admin.scripts')
    </head>
    <body class="theme-blue">
        <div id="app">
            @include('partials.admin.header')
            @include('partials.admin.navbar')
            <section>
                @include('partials.admin.leftsidebar')
                @include('partials.admin.rightsidebar')
            </section>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>    
        </div>
    </body>
</html>