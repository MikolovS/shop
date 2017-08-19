@extends('public.main')
@section('pageTitle', 'Личный Профиль')
@section('content')
    @if(count($errors) > 0)
        <?php vd($errors)?>
    @endif
    <div class="row order img-rounded">
        <form method="POST"  action="{{url('/' . 'user/profile')}}" id="buy-form" class="form-horizontal" data-content>
            {{ csrf_field() }}
            {!! method_field('patch') !!}
                <div class="col-md-12">
                    <h4>Личный профиль</h4>
                    <hr>
                    <div class="col-xs-10 col-md-10">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[name]">Ф.И.О.<span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="name" name="user[name]" type="text" placeholder="Иванов Иван Ивнович" class="form-control input-md"  value="{{ $user['name'] === old('user.name') ? $user['name'] : old('user.name')}}" required pattern="[a-zA-Zа-яА-ЯёЁ\s-]+$">
                                <span class="help-block">только буквы, дефисы, пробелы</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[phone]">Номер телефона <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="phone" name="user[phone]" type="text" placeholder="+38 (0XX)-XXX-XX-XX" class="form-control input-md"  value="{{old('user.phone')}}" required>
                                <span class="help-block">украинский формат</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[address]">Адрес доставки <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input id="address" name="user[address]" type="tel" placeholder="г.Одесса, НП отделение №1 " class="form-control input-md"  value="{{old('user.address')}}" required>
                                <span class="help-block">номер отделения курьерской службы или физический адрес получателя</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[email]">Электронная почта</label>
                            <div class="col-md-4">
                                <input id="email" name="user[email]" type="text" placeholder="ivanov@mail.com" class="form-control input-md"  value="{{old('user.email')}}" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
                                <span class="help-block">ivanov@mail.com</span>
                            </div>
                        </div>

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

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user[comment]">Дополнительная информация</label>
                            <div class="col-md-4">
                                <textarea class="form-control" id="comment" name="user[comment]" placeholder="Любая другая информация...">{{old('user.comment')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            <button class="btn btn-primary" type="submit">Редактировать</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#phone').mask('+38 (099) 999-99-99');

        });

    </script>
@endsection