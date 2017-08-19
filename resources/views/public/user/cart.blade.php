@extends('public.main')
@section('pageTitle', 'Корзина')
@section('content')
    @if(count($errors) > 0)
        <?php vd($errors)?>
    @endif
    <div class="row order img-rounded">
        <form method="POST"  action="{{url('/' . 'cart/buy')}}" id="buy-form" class="form-horizontal" data-content>
            {{ csrf_field() }}
            <div>
                <h4>Блок товаров</h4>
                <hr>
            @foreach($products as $product)
                <div class="row product" id="{{$product['id']}}">
                    <div class="col-6 col-xs-5 col-sm-4 col-md-3 col-lg-3">
                        <a class="btn btn-default" href="{{url('/' . $product['slug'])}}" data-content>
                            <img class="cart img-rounded" src="{{$product['img']}}" alt="{{$product['name']}}">
                        </a>
                        <br>
                        <strong>{{$product['name']}}</strong>
                    </div>
                    <button class="btn btn-danger pull-right visible-xs" title="Удалить" type="button">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <div class="col-9 col-sm-8 col-md-9 col-lg-9 hidden-xs fixer"></div>
                    <div class="col-9 col-xs-7 col-sm-8 col-md-9 col-lg-9 count-field">
                        <input type="hidden" name="order_items[{{$product['id']}}][product_id]" value="{{$product['id']}}">
                        <div class="row text-center">
                            <div class="col-3 col-xs-12 col-sm-2 col-md-2 col-lg-3 calculator">
                                <span>{{$product['price']}}</span>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-4 col-md-4 col-lg-3 calculator">
                                <div class="input-group number-spinner">
                            <span class="input-group-btn">
                                <button class="btn btn-default arrows" data-dir="dwn" type="button">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                                    <input type="text" class="form-control count text-center" value="1" name="order_items[{{$product['id']}}][count]count" data-price="{{$product['price']}}">
                                    <span class="input-group-btn">
                                <button class="btn btn-default arrows" data-dir="up" type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                                </div>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-2 col-md-2 col-lg-3 calculator">
                                <span class="price-total">{{$product['price_total']}}</span>
                            </div>
                            <div class="col-3 col-xs-12 col-sm-2 col-md-2 col-lg-3 hidden-xs">
                                <button class="btn btn-danger" title="Удалить" type="button">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <hr>
            @endforeach
                <div class="row order-sum img-rounded">
                    <div class="col-6 col-xs-10 col-sm-2 col-md-2 col-lg-3">
                    </div>
                    <div class="col-6 col-xs-12 col-sm-10 col-md-10 col-lg-9 text-center">
                        <h4>Общая сумма к оплате <span id="order-sum">{{$order_sum}}</span> грн.</h4>
                    </div>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Блок информации клиента</h4>
                    <hr>
                    <div class="col-xs-10 col-md-10">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[name]">Ф.И.О. получателя заказа <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="name" name="user[name]" type="text" placeholder="Иванов Иван Ивнович" class="form-control input-md"  value="{{old('user.name')}}" required pattern="[a-zA-Zа-яА-ЯёЁ\s-]+$">
                                <span class="help-block">только буквы, дефисы, пробелы</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[phone]">Номер телефона <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="phone" name="user[phone]" type="text" placeholder="+38 (0XX)-XXX-XX-XX" class="form-control input-md"  value="{{old('user.phone')}}" required>
                                <span class="help-block">украинский формат</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[address]">Адрес доставки <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="address" name="user[address]" type="tel" placeholder="г.Одесса, НП отделение №1 " class="form-control input-md"  value="{{old('user.address')}}" required>
                                <span class="help-block">номер отделения курьерской службы или физический адрес получателя</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[email]">Электронная почта</label>
                            <div class="col-md-4">
                                <input id="email" name="user[email]" type="text" placeholder="ivanov@mail.com" class="form-control input-md"  value="{{old('user.email')}}" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
                                <span class="help-block">ivanov@mail.com</span>
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[payment_type]">Cпособ оплаты</label>
                            <div class="col-md-4">
                                <select id="payment_type" name="user[payment_type]" class="form-control" required>
                                    <option {{ old('user.payment_type') === 1 ?: 'selected' }} value="1">Наложеный платеж</option>
                                    <option {{ old('user.payment_type') === 2 ?: 'selected' }} value="2">На карту ПриватБанк</option>
                                </select>
                                <span class="help-block"></span>
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
            </div>
            <button class="btn btn-primary" type="submit">Оформить заказ</button>
        </form>
    </div>

    <form method="POST" data-container id="delete-form">
        {{ csrf_field() }}
        {!! method_field('delete') !!}
        <input id="product_id" type="hidden" name="product_id">
    </form>

    <script>
        function widthScreen() {
            if($(window).width() > 700) {
                $('.order').addClass('order-css');
            }
        }
        widthScreen();
        $(document).ready(function() {
            var deleteForm =  $('#delete-form');
            $('.btn-danger').on('click', function(){
                var row = $(this).closest('.product');
                deleteForm.attr('action', row.find('a').attr('href'));
                $('#product_id').val(row.attr('id'));
                deleteForm.submit();
            });

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

                var orderSum =  Number(0);
                $.each($('.price-total'), function (key, value) {
                    orderSum = (Number(orderSum) + Number($(value).text())).toFixed(2);
                });
                $('#order-sum').text(orderSum);
            });
        });

    </script>
@endsection