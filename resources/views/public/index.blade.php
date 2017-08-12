<!DOCTYPE html>
<html lang="ru">
<head>
    @include('public.layouts_parts.header')
</head>

<body>

<div class="container" id="pjax-container">
    @include('public.layouts_parts.navbar')
    @yield('container')
</div>

@include('public.layouts_parts.js')
</body>
</html>
