@extends('public.main')
@section('pageTitle', 'Корзина')
@section('content')
    @if(count($errors) > 0)
        <?php vd($errors)?>
    @endif
    <div class="row">
        <form method="POST"  action="{{url('/' . 'cart/buy')}}" id="buy-form" class="form-horizontal" data-content>
            {{ csrf_field() }}
            @foreach($products as $product)
                <div class="row" id="{{$product['id']}}">
                    <div class="col-6 col-xs-5 col-sm-4 col-md-3 col-lg-3">
                        <a class="btn btn-default" href="{{url('/' . $product['slug'])}}" data-content>
                            <img class="cart img-rounded" src="{{$product['img']}}" alt="{{$product['name']}}">
                        </a>
                        <br>
                        <strong>{{$product['name']}}</strong>
                    </div>
                    <div class="col-9 col-xs-7 col-sm-8 col-md-9 col-lg-9 count-field">
                        <input type="hidden" name="order_items[{{$product['id']}}][product_id]" value="{{$product['id']}}">
                        <div class="row text-center">
                            <div class="col-3 col-xs-12 col-sm-2 col-md-2 col-lg-3 calculator">
                                <span style="vertical-align: middle">{{$product['price']}}</span>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-4 col-md-4 col-lg-3 calculator">
                                <div class="input-group number-spinner">
                            <span class="input-group-btn">
                                <button class="btn btn-default arrows" data-dir="dwn" type="button">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                                    <input type="text" class="form-control text-center count" value="1" name="order_items[{{$product['id']}}][count]count" data-price="{{$product['price']}}">
                                    <span class="input-group-btn">
                                <button class="btn btn-default arrows" data-dir="up" type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                                </div>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-x col-md-2 col-lg-3 calculator">
                                <span class="price-total">{{$product['price_total']}}</span>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-2 col-md-2 col-lg-3 calculator">
                                <span class="glyphicon glyphicon-trash"></span>
                            </div>
                        </div>

                    </div>

                </div>
                <hr>
            @endforeach
            <hr>
            <div class="row">
                <div class="col-xs-10 col-md-10">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[name]">Ф.И.О.</label>
                        <div class="col-md-4">
                            <input id="name" name="user[name]" type="text" placeholder="Введите данные получателя" class="form-control input-md"  value="{{old('user.name')}}">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[phone]">Номер телефона(Укранина)</label>
                        <div class="col-md-4">
                            <input id="phone" name="user[phone]" type="text" placeholder="+38 (0XX)-XXX-XX-XX" class="form-control input-md"  value="{{old('user.phone')}}">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[address]">Адрес доставки</label>
                        <div class="col-md-4">
                            <input id="address" name="user[address]" type="tel" placeholder="город, адрес(либо отделение почты)" class="form-control input-md"  value="{{old('user.address')}}">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[email]">Электронная почта'</label>
                        <div class="col-md-4">
                            <input id="email" name="user[email]" type="email" placeholder="ivanov@mail.com" class="form-control input-md"  value="{{old('user.email')}}">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[payment_type]">Cпособ оплаты</label>
                        <div class="col-md-4">
                            <select id="payment_type" name="user[payment_type]" class="form-control">
                                <option {{ old('user.payment_type') === 1 ?: 'selected' }} value="1">Наложеный платеж</option>
                                <option {{ old('user.payment_type') === 2 ?: 'selected' }} value="2">На карту ПриватБанк</option>
                            </select>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user[comment]">Коментарии к заказу</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="comment" name="user[comment]" placeholder="Дополнительная информация, если необходимо...">{{old('user.comment')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Оформить заказ</button>
        </form>
    </div>

    <script>
        $('#phone').mask('+38 (099) 999-99-99');
        $('.count-field').on('click', '.number-spinner button', function () {
            var btn = $(this),
                countInput = btn.closest('.number-spinner').find('.count'),
                oldValue = countInput.val().trim(),
                newVal = 0,
                itemPrice = countInput.data('price'),
                totalPrice = btn.closest('.row').find('.price-total');

            if (btn.attr('data-dir') === 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            btn.closest('.number-spinner').find('.count').val(newVal);
            totalPrice.text((newVal * itemPrice).toFixed(2));
        });
    </script>
@endsection