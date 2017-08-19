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
                @if(isset($product['in_cart']))
                    <button type="button" class="btn btn-xs btn-primary" disabled>
                        В корзине
                    </button>
                    @else
                        <button type="submit" class="btn btn-xs btn-success buy" id="{{$product['id']}}" data-slug="{{$product['slug']}}">
                            Добавить в корзину
                        </button>
                @endif
            </div>
        @endforeach
    </div>

    <form method="POST" data-container id="buy-form">
        {{ csrf_field() }}
        <input id="product_id" type="hidden" name="product_id">
        <input id="count" type="hidden" name="count" value="1">
    </form>

    <script>
        $(document).ready(function() {
            var bueForm =  $('#buy-form');
            $('.buy').on('click', function(){
                $('#product_id').attr('value', this.id);
                bueForm.attr('action', '{{url('/')}}' + '/' + $(this).data('slug'));
                bueForm.submit();
            });
        });
    </script>
@endsection