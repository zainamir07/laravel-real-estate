<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <nav class="site-nav">
    <div class="container">
      <div class="menu-bg-wrap">
        <div class="site-navigation">
          <a href="{{url('/')}}" class="logo m-0 float-start">Property</a>

          <ul
            class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
          >
            <li class="active"><a href="{{url('/')}}">Home</a></li>
            <li class="has-children">
              <a href="{{url('properties')}}">Properties</a>
              <ul class="dropdown">
                <li><a href="{{url('properties/R')}}">Rent Property</a></li>
                <li><a href="{{url('properties/S')}}">Sell Property</a></li>
                {{-- <li class="has-children">
                  <a href="#">Dropdown</a>
                  <ul class="dropdown">
                    <li><a href="#">Sub Menu One</a></li>
                    <li><a href="#">Sub Menu Two</a></li>
                    <li><a href="#">Sub Menu Three</a></li>
                  </ul>
                </li> --}}
              </ul>
            </li>


            <li><a href="{{url('contact')}}">Contact</a></li>
            {{-- <li><a href="services.html">Services</a></li> --}}
            @if (session()->has('user_id'))
            <li class="has-children">
              <a href="{{url('dashboard')}}">Dashboard</a>
              <ul class="dropdown">
              <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('mylisting')}}">My Listing</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>
                <li><a href="{{url('logout')}}">Logout</a></li>
              </ul>
            </li>
            @else 
            <li><a href="{{url('login')}}">Login</a></li>
            <li><a href="{{url('register')}}">Register</a></li>
            @endif

           
          </ul>

          <a
            href="#"
            class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
            data-toggle="collapse"
            data-target="#main-navbar"
          >
            <span></span>
          </a>
        </div>
      </div>
    </div>
  </nav>
