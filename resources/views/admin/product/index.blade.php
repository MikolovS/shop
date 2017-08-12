@extends('admin.product.section')
@section('pageTitle', 'Продукты')
@section('content')
    <div class="row">
        <h1 class="page-header">{{$category->name}}</h1>
        @foreach($products as $product)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a class="btn btn-default" href="{{url('/admin/product/' . $product['slug'] . '/edit')}}" data-content>
                    <img class="imgPreview" src="{{$product['img']}}" alt="{{$product['img']}}">
                </a>
                <h2>{{$product['name']}}</h2>
                <form action="{{url('/admin/product/' . $product['slug'])}}" method="POST" data-container>
                    {{ csrf_field() }}
                    {!! method_field('delete') !!}
                    <button type="submit" class="btn btn-xs btn-danger">
                        Удалить
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection