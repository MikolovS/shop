
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">

        <div class="navbar-header">
            <div class="pull-left visible-xs" id="sidebarToggle">
                <button class="btn btn-xs btn-success" id="sidebarToggle">Menu  <span class="glyphicon glyphicon-menu-right"></span></button>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">Project admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="user-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" data-container>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-group-justified btn-danger">
                                                Logout
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
            </ul>
        </div>

    </div>
</nav>