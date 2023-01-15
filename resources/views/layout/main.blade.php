@include('layout.header')
	<!--header section start -->
    @include('layout.navbar')
    <!-- header section end -->
    
    @yield('content')

    @yield('script')
   @include('layout.footer')

