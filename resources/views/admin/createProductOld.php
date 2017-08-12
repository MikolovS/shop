@extends('admin.product.section')

@section('pageTitle', 'Добавить Товар')
@section('content')
    <div class="row">
            <h1 class="text-center page-header">Новый товар</h1>
        <div class="col-lg-3">
            <div><img id="imgPreview" src=""></div>
            <button type="button" class="btn btn-danger image-preview-clear">
                <span class="glyphicon glyphicon-remove"></span> Удалить
            </button>
        </div>
        <div class="col-lg-4">
            <form method="POST"  data-container class="category" action="{{url('/admin/product')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="category_slug" id="category_slug" value required>
                <input type="hidden" name="category_id" id="category_id" value required>

                <div class="form-group select-group">
                    <label class="control-label " for="select">
                        Выбирите категорию
                    </label>
                    <select class="select form-control" required>
                        <option value>
                            Не выбрана
                        </option>
                        @if(!empty($categories[1]))
                            @foreach($categories[1] as $category)
                                <option value="{{$category['id']}}">
                                    {{$category['name']}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label class="control-label " for="select">
                    Выбирите фотографию
                </label>
                <div class="form-group image-preview form-inline">
                    <input class="form-control image-preview-filename" disabled >
                    <span class="form-group-btn">
                    <div class="btn btn-primary image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Обзор</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" id="img" name="img" required/>
                    </div>
                </span>
                </div>

                <div class="form-group ">
                    <label class="control-label " for="name">
                        Название
                    </label>
                    <input class="form-control" id="name" name="name" type="text" minlength="2" required/>
                </div>

                <div class="form-group ">
                    <label class="control-label " for="price">
                        Цена
                    </label>
                    <input class="form-control" id="price" name="price" type="number" placeholder="0.00" required/>грн
                </div>

                <div class="form-group">
                    <div>
                        <button class="btn btn-success " name="submit" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            @include('public.layouts_parts.errors')
        </div>
    </div>

    <script>
        var categories = '<?php echo json_encode($categories)?>';
        var collection = '<?php echo json_encode($collection)?>';
        var myObj = JSON.parse(categories);
        var collections = JSON.parse(collection);
        var imgPreview =  $('#imgPreview');
        var clearButton = $('.image-preview-clear');
        var inputFile = $('.image-preview-input input:file');
        var catSlug = $('#category_slug');
        var catId = $('#category_id');
        //стандартный рисунок
        function noImg() {
            imgPreview.attr('src', '{{url("/") . Img::NOIMG}}');
            clearButton.hide();
        }
        function imgInputTitle(title, filename) {
            $('.image-preview-input-title').text(title);
            $('.image-preview-filename').val(filename);
        }
        function hiddenInput(slug, category_id) {
            catSlug.attr('value', slug);
            catId.attr('value', category_id);
        }
        noImg();
        $(document).ready(function(){
            //манипуляция с селектами категорий
            $('.category').on('change', 'select', function () {
                var thisValue = this.value;
                //при смени категории - перезагружать последующие инпуты
                $(this).closest('.select-group').nextAll('.select-group').remove();
                var rootSelect = $('.select-group').last();
                var rootId = $(rootSelect).prev().find('.select').val();
                //если выбраная категория существует - добавляем её slug в инпут
                if (collections[thisValue]) {
                    hiddenInput(collections[thisValue].slug, collections[thisValue].id);
                } else {
                    hiddenInput('', rootId);
                }
                if(myObj[thisValue] && thisValue !== rootId) {
                    var roots = myObj[thisValue]; //выбранные подкатегории
                    var parentDiv = $(this).closest('.form-group');//родительский контейнер
                    var select = parentDiv.clone(); //клонируем select
                    var option = select.find('option').remove().first(); // копируем родительскую опцию
                    select.find('select').append(option);// добавляем родительскую опцию в новый селект
                    option.attr('value', thisValue); // добавляем id родительской категории
                    option.text('Текущая категория - ' + collections[thisValue].name);
                    //добавляем к селекту опции из массива
                    $.each(roots, function (key, value) {
                        var nextOption = option.clone();
                        nextOption.attr('value', value.id);
                        nextOption.attr('slug', value.slug);
                        nextOption.text(value.name);
                        select.find('select').append(nextOption);
                    });
                    parentDiv.after(select);
                }
            })
        });

        $(function() {
            // Создаем привью картинки
            inputFile.change(function (){
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    //вставляем картинку
                    reader.onload = function (e) {
                        imgInputTitle('Изменить', file.name);
                        imgPreview.attr('src', e.target.result);
                        clearButton.show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        // удаляем картинку
        clearButton.on('click', function() {
            imgInputTitle('Обзор', '');
            inputFile.val('');
            noImg();
        });
    </script>
@endsection