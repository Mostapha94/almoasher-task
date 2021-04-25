<!DOCTYPE html>
<html>
    <head>
        <!-- Required Meta Tags -->
        <meta name="language" content="ar">
        <meta http-equiv="x-ua-compatible" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ __('Al-Moasher Software House')  }} - @yield('title')</title>
        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="{ __('Al-Moasher Software House')  }}" />
        <!-- Other Meta Tags -->
        <!-- Required CSS Files -->
        <link href="{{MAINASSETS}}/frontend/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{MAINASSETS}}/plugins/datatables/datatable.min.css" rel="stylesheet" /> 
        <!-- Sweet alert Files -->
        <script src="{{MAINASSETS}}/plugins/sweetalert/sweetalert.min.js"></script>
    </head>
    <body>
        <div class="container-fluid mt-5 mb-5">
            @yield('content')
        </div>
        <script src="{{MAINASSETS}}/backend/js/jquery.min.js"></script>

        @yield('js')
    </body>
</html>