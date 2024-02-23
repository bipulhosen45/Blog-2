<!DOCTYPE html>
<html lang="en">

  <head>

    @include('fronted.includes.head')

  </head>

  <body>
  

   

    <!-- ***** Preloader Start ***** -->
    {{-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   --}}
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('fronted.includes.nav')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    {{-- @include('fronted.includes.banner') --}}
    @yield('banner')
    <!-- Banner Ends Here -->



    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @yield('content')
              </div>
            </div>
          </div>
          @include('fronted.includes.sidebar')
        </div>
      </div>
    </section>

    @include('fronted.includes.footer')


    @include('fronted.includes.scripts')
    

  </body>
</html>