
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 3</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/css/admin/admin.css">
    @include('layouts_parts.js')
    <script src="/js/admin/admin.blade.js"></script>
    {{--<link href="/css/main.css" rel="stylesheet">--}}
</head>
<body>
<div id="pjax-container">
    @include('admin_layouts.admin_navbar')
    <div class="wrapper">
        @include('admin_layouts.admin_sidebar')
            @yield('container')
    </div>
</div>





</body>
</html>
