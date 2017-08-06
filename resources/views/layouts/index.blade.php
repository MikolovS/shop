<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts_parts.header')
</head>

<body>

<div class="container" id="pjax-container">
    @include('layouts_parts.navbar')
    @yield('container')
</div>

@include('layouts_parts.js')
</body>
</html>
