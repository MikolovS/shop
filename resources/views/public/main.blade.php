@extends('public.index')

@section('container')
    @include('public.layouts_parts.banner')
    <div class="container" id="pjax-content">
        @yield('content')
    </div>
@endsection
