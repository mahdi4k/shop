 <nav class="navbar    navbar-fixed-top navbar-expand-md navbar-dark" id="banner">
    <div class="container">
        <div class="row">
            <!-- Brand -->
            

            <!-- Toggler/collapsibe Button -->
            <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">خدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#third-carousel">محصولات </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#we-are">تماس با ما</a>
                    </li>
                    <!-- Dropdown -->

                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <a class="navbar-brand" href=""><img src="{{URL::asset('/img/icon.gif')}}" width="40" height="40"> گروه
                <span> هیراد کویر </span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
           
          @if(Auth::check())
                        <li><span class="fa fa-user"></span><a href="{{ url('user') }}">
                                {{ Auth::user()->username }}
                            </a></li>
                    @else
                        <li><span class="fa fa-user"></span><a href="{{ url('login') }}">ثبت نام</a></li>
                    @endif
          
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search">
        </form>
      </div>
    </nav>