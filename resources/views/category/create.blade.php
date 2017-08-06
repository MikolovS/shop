@extends('category.category')

@section('content')
    @include('layouts_parts.errors')
    <form method="POST"  data-container class="category" action="{{url('/admin/category')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group select-group">
            <label class="control-label " for="select">
                Select a Choice
            </label>
                <select class="select form-control" id="parent_id" name="parent_id">
                <option value="0">
                    New Category
                </option>
                @foreach($categories[0] as $category)
                    <option value="{{$category['id']}}">
                        {{$category['name']}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="img">File input</label>
            <input type="file" id="img" name="img" required>
            <p class="help-block">Example block-level help text here.</p>
        </div>

        <div class="form-group ">
            <label class="control-label " for="name">
                Name
            </label>
            <input class="form-control" id="name" name="name" type="text" minlength="2" required/>
        </div>
        <div class="form-group">
            <div>
                <button class="btn btn-primary " name="submit" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </form>
    <script>
        var categories = '<?php echo json_encode($categories)?>';
        var myObj = JSON.parse(categories);
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
    </script>
@endsection