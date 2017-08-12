<nav id="sidebar">
    <div class="sidebar-header visible-md visible-lg" id="sidebarCollapse">
        <h3>
            <i class="glyphicon glyphicon-align-left"></i>
            Menu
            <i class="glyphicon glyphicon-triangle-left pull-right"></i>
        </h3>
        <strong><i class="glyphicon glyphicon-align-left"></i></strong>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-home"></i>
                Category
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="{{url('/admin/category/create')}}" data-container>Добавить Категорию</a></li>
                <li><a href="{{url('/admin/category')}}" data-container>Все категории</a></li>
                <li><a href="#">Home 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-duplicate"></i>
                Товары
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="{{url('/admin/product/create')}}">Новый товар</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-link"></i>
                Portfolio
            </a>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-paperclip"></i>
                FAQ
            </a>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-send"></i>
                Contact
            </a>
        </li>
    </ul>
</nav>