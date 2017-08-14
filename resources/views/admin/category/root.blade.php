@extends('admin.category.section')
@section('pageTitle', 'Категории')
@section('content')
    <h1 class="page-header">Раздел в категории {{$category->name}}</h1>
    <div class="row text-center">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <div class="animate">
                    <img class="imgPreview img-rounded" src="{{url("/") . Img::NEWCATEGORY}}" alt="">
                    <p><a class="btn btn-lg btn-primary" href="{{url("/") . '/admin/category/create/' . $category->slug}}" data-content>Создать Дочернюю ктегорию</a></p>
                    <p>Делает данный раздел родительским.</p>
                    <p>Позволяет создавать новые под-категории.</p>
                    <p><strong>Запрещает созавать в данной категории<br> товары</strong></p>
                </div>
            </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="animate">
                <img class="imgPreview img-rounded" src="{{url("/") . Img::NEWPRODUCT}}" alt="">
                <p><a class="btn btn-lg btn-success" href="{{url("/") . '/admin/product/create/' . $category->slug}}" data-content>Создать Новый товар</a></p>
                <p>Делает раздел родительским.</p>
                <p>Добавляет в раздел новый товар.</p>
                <p><strong>Запрещает созавать в данной категории<br> новые под-категории.</strong></p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //modal remove on ajax
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            //
            var row = $('.row');
            row.on('mouseenter', '.animate', function() {
                $(this).animate({'zoom': '1.1', 'opacity' : '1'}, 'fast');
            });
            row.on('mouseleave', '.animate', function() {
                $(this).animate({'zoom': '1.0', 'opacity' : '0.8'}, 'fast');
            });
        });
    </script>
@endsection