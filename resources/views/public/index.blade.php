<!DOCTYPE html>
<html lang="ru">
<head>
    @include('public.layouts_parts.header')
    @include('public.layouts_parts.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>

<div class="container" id="pjax-container">
    @include('public.layouts_parts.navbar')
    @yield('container')
</div>

</body>
</html>
