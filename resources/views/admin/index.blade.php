<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('pageTitle')</title>
    <link rel="shortcut icon" href="{{url('/public/images/logo.ico')}}" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin/admin.css">
    @include('public.layouts_parts.js')
    <script src="/js/admin/admin.blade.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div id="pjax-container">
    @include('admin.layouts_parts.admin_navbar')
    <div class="wrapper">
        @include('admin.layouts_parts.admin_sidebar')
            @yield('container')
    </div>
</div>
</body>
</html>
