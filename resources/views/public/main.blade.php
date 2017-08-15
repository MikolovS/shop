@extends('public.index')

@section('container')
    <div class="content" id="pjax-content">
        @include('public.layouts_parts.message')
        @yield('content')
    </div>
@endsection
