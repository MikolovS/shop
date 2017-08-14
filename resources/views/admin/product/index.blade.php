@extends('admin.product.section')
@section('pageTitle', 'Продукты')
@section('content')
    <div class="row">
        @include('public.layouts_parts.links')
        <h1 class="page-header">
            {{$category->name}}
            <a class="btn btn-primary pull-right" href="{{url("/") . '/admin/product/create/' . $category->slug}}" data-content>
               + Добавить товар
            </a>
        </h1>
        @foreach($products as $product)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a class="btn btn-default" href="{{url('/admin/product/' . $product['slug'] . '/edit')}}" data-content>
                    <img class="imgPreview img-rounded" src="{{$product['img']}}" alt="{{$product['img']}}">
                </a>
                <h2>{{$product['name']}}</h2>
                <button type="submit" class="btn btn-xs btn-danger delete" id="{{$product['slug']}}">
                    Удалить
                </button>
            </div>
        @endforeach
    </div>
    <div id="delete" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">х</button>
                    <h4 class="modal-title">Удаление товара</h4>
                </div>
                <div class="modal-body">
                    Вы уверены что хотите удалить этот товар - <span></span> ?
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
                modal.find('form').attr('action', '{{url('/admin/product')}}/' + this.id);
                modal.modal('show');
            });
            $('#yes').on('click', function(){
                $('body').removeClass('modal-open');
            });
        });
    </script>
@endsection