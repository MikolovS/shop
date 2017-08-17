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
                @if(isset($_COOKIE['cart']) && array_key_exists ($product['id'], unserialize($_COOKIE['cart'])))
                    <button type="button" class="btn btn-xs btn-primary" id="{{$product['id']}}" disabled>
                        товар уже в корзине
                    </button>
                    @else
                        <button type="submit" class="btn btn-xs btn-success buy" id="{{$product['id']}}">
                            купить
                        </button>
                @endif
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{url('/cart/add')}}" data-container id="buy-form">
    {{ csrf_field() }}
        <input id="product_id" type="hidden" name="product_id" value>
        <input id="count" type="hidden" name="count" value="1">
    </form>

    <script>
        $(document).ready(function() {
            //modal remove on ajax
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            //

            $('.buy').on('click', function(){
                $('#product_id').attr('value', this.id);
                $('#buy-form').submit();
            });
        });
    </script>
@endsection