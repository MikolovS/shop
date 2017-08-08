@extends('category.category')
@section('pageTitle', 'Категории')
@section('content')
    <div class="row">
        @if(empty($categories))
            <h1 class="page-header">Нет ни одной категории</h1>
        @endif
        @include('layouts_parts.errors')
        @foreach($categories as $category)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <img class="imgPreview" src="{{$category['img']}}" alt="{{$category['img']}}">
                <h2>{{$category['name']}}</h2>
                <p><a class="btn btn-default" href="{{url('/admin/category/' . $category['slug'])}}" data-content>View details »</a></p>
                <p><a class="btn btn-default" href="{{url('/admin/category/show/' . $category['slug'])}}" data-content>Редактировать »</a></p>
            </div>
        @endforeach
    </div>
@endsection