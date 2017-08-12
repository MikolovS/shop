@extends('admin.category.section')

@section('pageTitle', '{{$category->name}}')
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
            <form method="POST"  data-container class="category" action="{{url('/admin/category') .'/'. $category->slug}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field('patch') !!}

                <input type="hidden" name="parent_id" id="parent_id" value="{{$parent['id']}}">
                <div class="form-group select-group">
                    <label class="control-label " for="select">
                        Категория
                    </label>
                    <select class="select form-control" disabled>
                        <option value="1">
                            Изменить категори
                        </option>
                        <option value="{{$parent['id']}}" selected>
                            {{$parent['name']}} - <p>текущая категория</p>
                        </option>
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
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" id="img" name="img"/>
                    </div>
                </span>
                </div>

                <div class="form-group ">
                    <label class="control-label " for="name">
                        Name
                    </label>
                    <input class="form-control" id="name" name="name" type="text" minlength="2" value="{{$category->name}}" required/>
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
    </div>

    <script>
        var categories = '<?php echo json_encode($categories)?>';
        var myObj = JSON.parse(categories);
        var imgPreview =  $('#imgPreview');
        var clearButton = $('.image-preview-clear');
        var inputFile = $('.image-preview-input input:file');
        var parentId = $('#parent_id');
        var currectParent = '{{$parent['id']}}';
        //стандартный рисунок
        function noImg() {
            imgPreview.attr('src', '{{$category->img}}');
            clearButton.hide();
        }
        function imgInputTitle(title, filename) {
            $('.image-preview-input-title').text(title);
            $('.image-preview-filename').val(filename);
        }
        function hiddenInput(parent_id) {
            parentId.attr('value', parent_id);
        }
        noImg();
        $(document).ready(function(){
            //манипуляция с селектами категорий
            $('.category').on('change', 'select', function () {
                var thisValue = this.value;
                console.log(thisValue);
                //если категория сбрасывается на родительскую - удаляем все селекты после неё
                $(this).closest('.select-group').nextAll('.select-group').remove();
                var rootSelect = $('.select-group').last();
                var rootId = $(rootSelect).prev().find('.select').val();
                hiddenInput(thisValue);
                //выбранное значение не должно соответсвовать ни одному из параметров
                if(myObj[thisValue] && currectParent !== thisValue && rootId !== thisValue) {
                    var roots = myObj[thisValue]; //выбранные подкатегории
                    var parentDiv = $(this).closest('.form-group');//родительский контейнер
                    var select = parentDiv.clone(); //клонируем select
                    select.find('label').text('Выбирите категорию');
                    var option = select.find('option').remove().first().text('Новая категория'); // копируем родительскую опцию
                    select.find('select').append(option);// добавляем родительскую опцию в новый селект
                    option.attr('value', thisValue); // добавляем id родительской категории
                    //добавляем к селекту опции из массива
                    $.each(roots, function(key, value){
                        var nextOption = option.clone();
                        nextOption.attr('value', value.id);
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
                        imgInputTitle('Change', file.name);
                        imgPreview.attr('src', e.target.result);
                        clearButton.show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        // удаляем картинку
        clearButton.on('click', function() {
            imgInputTitle('Browse', '');
            inputFile.val('');
            noImg();
        });
    </script>
@endsection