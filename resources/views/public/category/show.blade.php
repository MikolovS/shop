@extends('public.main')
@section('content')
    @include('public.layouts_parts.links')
    <div class="row">
        <h1 class="page-header text-center">
            {{$category->name}}
        </h1>
        @foreach($categories as $category)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a class="btn btn-default" href="{{url('/' . $category['slug'])}}" data-content>
                    <img class="imgPreview img-rounded" src="{{$category['img']}}" alt="{{$category['img']}}">
                </a>
                <h2>{{$category['name']}}</h2>
            </div>
        @endforeach
    </div>

@endsection