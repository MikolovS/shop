@extends('layouts.index')

@section('container')
    @include('layouts_parts.banner')
    <div class="container" id="pjax-content">
        @yield('content')
    </div>
@endsection
