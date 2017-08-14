<div class="row">
    <div class="col-md-12 links">
    <a class="nav-link" href="{{url('/')}}" data-content>Главная</a>
    @foreach($links as $name => $url)
            <span class="glyphicon glyphicon-arrow-right"></span> <a class="nav-link" href="{{$url}}" data-content>{{$name}}</a>
    @endforeach
    </div>
</div>

<script>
    $('.links').last().removeAttr('href');
</script>