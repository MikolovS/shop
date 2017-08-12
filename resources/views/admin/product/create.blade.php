@extends('admin.product.section')

@section('pageTitle', 'Добавить Товар')
@section('content')
    <div class="row">
        <h1 class="text-center page-header">Новый товар в категории {{$category->name}}</h1>
        <div class="col-lg-3">
            <div><img id="imgPreview" src=""></div>
            <button type="button" class="btn btn-danger image-preview-clear">
                <span class="glyphicon glyphicon-remove"></span> Удалить
            </button>
        </div>
        <div class="col-lg-4">
            <form method="POST"  data-container class="category" action="{{url('/admin/product')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="category_slug" id="category_slug" value="{{$category->slug}}" required>
                <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}" required>

                <label class="control-label" for="select">
                    Выбирите фотографию
                </label>
                <div class="form-group image-preview form-inline{{ $errors->has('img') ? ' has-error' : '' }}">
                    <input class="form-control image-preview-filename" disabled >
                    <span class="form-group-btn">
                        <div class="btn btn-primary image-preview-input">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <span class="image-preview-input-title">Обзор</span>
                            <input type="file" accept="image/png, image/jpeg, image/gif" id="img" name="img" value="{{old('img')}}" required/>
                        </div>
                    </span>
                    @if ($errors->has('img'))
                        <span class="help-block">
                            <strong>{{ $errors->first('img') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label" for="name">
                        Название
                    </label>
                    <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" minlength="2" required/>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label class="control-label" for="price">
                        Цена
                    </label>
                    <input class="form-control" id="price" name="price" type="number" value="{{old('price')}}" placeholder="0.00" step="0.01" required/>
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
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
        var imgPreview =  $('#imgPreview');
        var clearButton = $('.image-preview-clear');
        var inputFile = $('.image-preview-input input:file');
        //стандартный рисунок
        function noImg() {
            imgPreview.attr('src', '{{url("/") . Img::NOIMG}}');
            clearButton.hide();
        }
        function imgInputTitle(title, filename) {
            $('.image-preview-input-title').text(title);
            $('.image-preview-filename').val(filename);
        }
        noImg();
        $(document).ready(function(){
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
        });
    </script>
@endsection