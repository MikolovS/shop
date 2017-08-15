@extends('public.main')
@section('content')
    @include('public.layouts_parts.links')
    <div class="row">
        <h1 class="page-header text-center">
            {{$product->name}}
        </h1>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <img class="imgPreview img-rounded" src="{{$product['img']}}" alt="{{$product['img']}}">
                <h2>{{$product['name']}}</h2>
            </div>
    </div>
    <form method="POST" action="{{url('/' . 'user/addToCart')}}" data-container id="buy-form">
        {{ csrf_field() }}
        <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 col-xs-offset-3">
                    <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button class="btn btn-default arrows" data-dir="dwn" type="button"><span class="glyphicon glyphicon-minus"></span></button>
				</span>
                        <input type="text" class="form-control text-center" value="1" name="count">
                        <span class="input-group-btn">
					<button class="btn btn-default arrows" data-dir="up" type="button"><span class="glyphicon glyphicon-plus"></span></button>
				</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit">купить</button>
    </form>
    <script>
        $(document).on('click', '.number-spinner button', function () {
            var btn = $(this),
                oldValue = btn.closest('.number-spinner').find('input').val().trim(),
                newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            btn.closest('.number-spinner').find('input').val(newVal);
        });
    </script>


@endsection