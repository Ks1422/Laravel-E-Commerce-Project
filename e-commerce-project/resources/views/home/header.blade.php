<header class="header_section">
  <nav class="navbar navbar-expand-lg custom_nav-container ">
    <a class="navbar-brand" href="index.html">
      <span>
        Giftos
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item {{Request::is('/')?'active':''}}">
          <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{Request::is('shop') ? 'active':''}}">
          <a class="nav-link" href="{{url('/shop')}}">
            Shop
          </a>
        </li>
        <li class="nav-item {{Request::is('why') ? 'active':''}}">
          <a class="nav-link" href="{{url('/why')}}">
            Why Us
          </a>
        </li>
        <li class="nav-item {{Request::is('testimonial') ? 'active':''}}">
          <a class="nav-link" href="{{url('/testimonial')}}">
            Testimonial
          </a>
        </li>
        <li class="nav-item {{Request::is('contact') ? 'active':''}}">
          <a class="nav-link" href="{{('/contact')}}">Contact Us</a>
        </li>
      </ul>
      @if (Route::has('login'))
      @auth

      <a href="{{url('/myorders')}}" class="mr-2 text-dark {{Request::is('myorders')? 'active':''}}">
        My Orders
      </a>

      <a href="{{url('mycart')}}">
        <i class="fa fa-shopping-bag ml-4" aria-hidden="true"></i>
        {{$count}}
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf

        <input type="submit" value="logout" class="btn btn-success ml-5">

      </form>
      @else
      <div class="user_option {{Request::is('login')?'active':''}}">
        <a href="{{url('/login')}}">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>
            Login
          </span>
        </a>
        <a href="{{url('/register')}}">
          <i class="fa fa-vcard {{Request::is('register')?'active':''}}" aria-hidden="true"></i>
          <span>
            Register
          </span>
        </a>
        @endauth
        @endif



      </div>
    </div>
  </nav>
</header>