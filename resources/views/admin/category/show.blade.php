@extends('admin.category.section')
@section('pageTitle', 'Категории')
@section('content')
    <div class="row">
        @include('public.layouts_parts.links')
        <h1 class="page-header">
            Раздел в категории {{$category->name}}
            <a class="btn btn-primary pull-right" href="{{url('/admin/category/create/' . $category->slug)}}" data-content>
                + Добавить категорию
            </a>
        </h1>


        @foreach($categories as $category)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a class="btn btn-default" href="{{url('/admin/category/' . $category['slug'])}}" data-content>
                    <img class="imgPreview img-rounded " src="{{$category['img']}}" alt="{{$category['img']}}">
                </a>
                <h2>{{$category['name']}}</h2>
                <button type="submit" class="btn btn-xs btn-danger delete" id="{{$category['slug']}}">
                    Удалить
                </button>
                <p>
                    <a class="btn btn-default" href="{{url('/admin/category/' . $category['slug'] . '/edit')}}" data-content>Редактировать »</a>
                </p>
            </div>
        @endforeach
    </div>

    <div id="delete" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">х</button>
                    <h4 class="modal-title">Удаление категории</h4>
                </div>
                <div class="modal-body">
                    Вы уверены что хотите удалить этот товар - <span></span> ?
                    Это действие безвозвратно удалит все вложеные категории и товары.
                </div>
                <div class="modal-footer">
                    <form method="POST" data-container>
                        {{ csrf_field() }}
                        {!! method_field('delete') !!}
                        <button type="submit" class="btn btn-danger">
                            Да
                        </button>
                        <button class="btn btn-primary" data-dismiss="modal">Нет</button>
                    </form>
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

            var modal = $('#delete');
            $('.delete').on('click', function(){
                var name = $(this).closest('.col-6').find('h2').text();
                modal.find('span').text(name);
                modal.find('form').attr('action', '{{url('/admin/category')}}/' + this.id);
                modal.modal('show');
            });
            $('#yes').on('click', function(){
                $('body').removeClass('modal-open');
            });
        });
    </script>
@endsection