@extends('public.main')
@section('pageTitle', 'Продукты')
@section('content')
    <div class="row">
        <h1 class="page-header">
            {{$category->name}}
        </h1>
        @include('public.layouts_parts.links')
        @foreach($products as $product)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a class="btn btn-default" href="{{url('/' . $product['slug'])}}" data-content>
                    <img class="imgPreview img-rounded" src="{{$product['img']}}" alt="{{$product['img']}}">
                </a>
                <h2>{{$product['name']}}</h2>
            </div>
        @endforeach
    </div>
@endsection