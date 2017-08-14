@extends('admin.category.section')
@section('pageTitle', 'Категории')
@section('content')
    <h1 class="page-header">Создайте свою первую категорию</h1>
    <div class="row text-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="animate">
                    <img class="imgPreview img-rounded" src="{{url("/") . Img::NEWCATEGORY}}" alt="">
                    <p><a class="btn btn-lg btn-primary" href="{{url('/admin/category/create/root')}}" data-content>Создать новую категорию</a></p>
                    <p>Переводит на вкладку создания категории.</p>
                </div>
            </div>
    </div>
    <div id="welcome" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">х</button>
                    <h4 class="modal-title">Добро пожаловать!</h4>
                </div>
                <div class="modal-body">
                    Для того что-бы начать работать - Вам нужно создать свою первую категорию.
                    Просто нажмите на соответствующую кнопку и следуйте подсказкам.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Вперёд!</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //modal remove on ajax
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            //
            $('#welcome').modal('show');
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