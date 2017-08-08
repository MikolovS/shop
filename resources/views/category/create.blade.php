@extends('category.category')

@section('pageTitle', 'Добавить Категорию')
@section('content')
    <div class="row">
            <h1 class="text-center page-header">Новая категория</h1>
        <div class="col-lg-3">
            <div><img id="imgPreview" src=""></div>
            <button type="button" class="btn btn-danger image-preview-clear">
                <span class="glyphicon glyphicon-remove"></span> Удалить
            </button>
        </div>
        <div class="col-lg-4">
            <form method="POST"  data-container class="category" action="{{url('/admin/category')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group select-group">
                    <label class="control-label " for="select">
                        Выбирите категорию
                    </label>
                    <select class="select form-control" id="parent_id" name="parent_id">
                        <option value="{{$categories[0][0]['id']}}">
                            {{$categories[0][0]['name']}}
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
                        Name
                    </label>
                    <input class="form-control" id="name" name="name" type="text" minlength="2" required/>
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
            @include('layouts_parts.errors')
        </div>
    </div>

    <script>
        var categories = '<?php echo json_encode($categories)?>';
        var myObj = JSON.parse(categories);
        var imgPreview =  $('#imgPreview');
        var clearButton = $('.image-preview-clear');
        var inputFile = $(".image-preview-input input:file");
        //стандартный рисунок
        function noImg() {
            imgPreview.attr('src', '{{url("/") . Img::NOIMG}}');
            clearButton.hide();
        }
        function imgInputTitle(title, filename) {
            $(".image-preview-input-title").text(title);
            $(".image-preview-filename").val(filename);
        }
        noImg();
        $(document).ready(function(){
            //манипуляция с селектами категорий
            $('.category').on('change', 'select', function () {
                var rootId = $(this).find('option').first().attr('value');
                //если категория сбрасывается на родительскую - удаляем все селекты после неё
                if(this.value === rootId) {
                    $(this).closest('.select-group').nextAll('.select-group').remove();
                } else {
                    if(myObj[this.value]) {
                        var roots = myObj[this.value]; //выбранные подкатегории
                        var parentDiv = $(this).closest('.form-group');//родительский контейнер
                        var select = parentDiv.clone(); //клонируем select
                        var option = select.find('option').remove().first(); // копируем родительскую опцию

                        select.find('select').append(option);// добавляем родительскую опцию в новый селект
                        option.attr('value', this.value); // добавляем id родительской категории
                        //добавляем к селекту опции из массива
                        $.each(roots, function(key, value){
                            var nextOption = option.clone();
                            nextOption.attr('value', value.id);
                            nextOption.text(value.name);
                            select.find('select').append(nextOption);
                        });
                        parentDiv.after(select);
                    }
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
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
        // удаляем картинку
        clearButton.on('click', function() {
            imgInputTitle('Обзор', '');
            inputFile.val("");
            noImg();
        });
    </script>
@endsection