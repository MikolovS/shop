<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}" data-container>Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="user-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}" data-container>Войти</a></li>
                    <li><a href="{{ route('register') }}" data-container>Зарегистрироватся</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->login }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{url('/user/profile')}}" data-container>Профиль</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" data-container>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-xs btn-danger pull-right">
                                                Выйти
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="{{url('/cart/show')}}" data-container>Корзина ({{\App\Cart::cartCount()}})</a></li>
            </ul>
        </div>

    </div>
</nav>