<!doctype html>
<html lang="en">

<head>

  
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Document Title, Description, and Author -->
  <title>@yield('title','Hall Plus')</title>
  <meta name="description" content="Planet is a Free Bootstrap Blog Template.">
  <meta name="author" content="BootstrapBrain">

  <!-- Favicon and Touch Icons -->
  <link rel="icon" type="image/png" sizes="512x512" href="{{asset('/Frontend/assets/img/logo.png')}}">

  <!-- Google Fonts Files -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset('Frontend/assets/css/planet-bsb.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      
      <!-- Font Awesome (for icons) -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
      

<body>

  <!-- Header -->
  <header id="header" class="sticky-top bsb-tpl-header-sticky bsb-tpl-header-sticky-animationX">

    <!-- Navbar 1 - Bootstrap Brain Component -->
    <nav class="navbar navbar-expand-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret bsb-tpl-navbar-sticky bg-white border-bottom border-light-subtle" data-bsb-sticky-target="#header">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{asset('/Frontend/assets/img/logo.png')}}"class="bsb-tpl-logo" alt="">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('home')}}#about-us">About us</a>
              </li>
              @if(!Auth::guard('customers')->user())
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('customerloginIndex')}}">Login</a>
              </li>
              @endif
              @if(Auth::guard('customers')->user())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Avenue</a>
                <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="categoryDropdown">
                  <li><a class="dropdown-item" href="{{route('all.avenues')}}">Classroom-based Lectures</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" id="blogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reservations</a>
                <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="blogDropdown">
                  <li><a class="dropdown-item" href="/Customer-Online-Avenue/all-bookings">All Reservations</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Customer-Online-Avenue/profile/{{  Auth::guard('customers')->user()->id}}">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('customerLogout')}}">Logout</a>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </nav>
@endif
  </header>
  @yield('content')
  
  <!-- Footer 6 - Bootstrap Brain Component -->
  <footer class="footer">

    <!-- Widgets - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5 py-xl-8 border-top border-light-subtle">
      <div class="container overflow-hidden">
        <div class="row gy-3 gy-md-5 gy-xl-0 align-items-sm-center">
          <div class="col-xs-12 col-sm-6 col-xl-3 order-0 order-xl-0">
            <div class="footer-logo-wrapper text-center text-sm-start">
              <a href="#!">
              </a>
            </div>
          </div>

          <div class="col-xs-12 col-xl-6 order-2 order-xl-1">
            <ul class="nav justify-content-center">
          
          </div>

        
          </div>
        </div>
      </div>
    </div>

    <!-- Copyright - Bootstrap Brain Component -->
    <div class="bg-light py-3 py-md-5 border-top border-light-subtle">
      <div class="container overflow-hidden">
        <div class="row">
          <div class="col">
            <div class="footer-copyright-wrapper text-center">
              &copy; 2023. All Rights Reserved.
            </div>
            <div class="credits text-secondary text-center mt-2 fs-7">
              Built by <a href="https://bootstrapbrain.com/" class="link-secondary text-decoration-none">BootstrapBrain</a> with <span class="text-primary">&#9829;</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- Javascript Files: Vendors -->
  <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Javascript Files: Controllers -->
  <script src="{{asset('Frontend/assets/controller/planet-bsb.js')}}"></script>

  <!-- BSB Body End -->
</body>

</html>

