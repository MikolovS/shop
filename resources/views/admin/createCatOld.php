@extends('admin.category.section')

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
                <input type="hidden" name="parent_id" id="parent_id" value="1">
                <div class="form-group select-group">
                    <label class="control-label " for="select">
                        Выбирите категорию
                    </label>
                    <select class="select form-control" required>
                        <option value="1">
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
                        <span class="image-preview-input-title">Browse</span>
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
            @include('public.layouts_parts.errors')
        </div>
    </div>

    <script>
        var categories = '<?php echo json_encode($categories)?>';
        var myObj = JSON.parse(categories);
        var imgPreview =  $('#imgPreview');
        var clearButton = $('.image-preview-clear');
        var inputFile = $('.image-preview-input input:file');
        var parentId = $('#parent_id');
        //стандартный рисунок
        function noImg() {
            imgPreview.attr('src', '{{url("/") . Img::NOIMG}}');
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
                //удаляем все поля после текущего
                $(this).closest('.select-group').nextAll('.select-group').remove();
                // защита от дублирующих форм
                var rootSelect = $('.select-group').last();
                var rootId = $(rootSelect).prev().find('.select').val();
                hiddenInput(thisValue);
                if (rootId !== thisValue) {
                    if(myObj[this.value]) {
                        var roots = myObj[thisValue]; //выбранные подкатегории
                        var parentDiv = $(this).closest('.form-group');//родительский контейнер
                        var select = parentDiv.clone(); //клонируем select
                        var option = select.find('option').remove().first(); // копируем родительскую опцию
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