@extends('public.index')

@section('content')

<hr>
<h1>HELLO</h1>
<a href="/test2" data-test2>test2</a>
<div class="container" id="pjax-test2">
    @yield('test2')
</div>
<hr>

    @endsection