<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <!-- Required Meta Tags -->
        <meta name="language" content="ar">
        <meta http-equiv="x-ua-compatible" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="The Description of This Page Goes Right Here and its !Important" />
        <meta name="keywords" content="keywords,goes,here,for,this,web,site,its,!important,and,keep,it,dynamic" />
        <title>{{ __('Al-Moasher Software House')  }}</title>
        <!-- Other Meta Tags -->
        <meta name="robots" content="index, follow" />
        <meta name="copyright" content="Sitename Goes Here">
		<link rel="shortcut icon" type="image/png"  href="{{MAINASSETS}}/backend/img/fevicon.png">
        <!-- Required CSS Files -->
        <link href="{{MAINASSETS}}/backend/css/tornado-icons.css" rel="stylesheet" />
        <link href="{{MAINASSETS}}/backend/css/tornado-rtl.css" rel="stylesheet" />
        @yield('css')
    </head>
    <body>
       @yield('content')
        <!-- Required JS Files -->
        <script src="{{MAINASSETS}}/backend/js/tornado.min.js"></script>
        @yield('js')
    </body>
</html>