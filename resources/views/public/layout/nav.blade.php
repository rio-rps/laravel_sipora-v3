 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0">
     <nav class="navbar navbar-expand-lg navbar-light">
         <a href="" class="navbar-brand p-0">
             <h1 class="display-6 text-dark">
                 <img src="{{ asset('images/logo/logo_dishub2.png') }}" alt="Logo">
             </h1>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
             <span class="fa fa-bars"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarCollapse">
             <div class="navbar-nav ms-auto py-0">
                 <a href="/" class="nav-item nav-link  fw-bold">
                     <i class="fa fa-desktop"></i> Beranda
                 </a>
                 <a href="{{ route('register') }}" class="nav-item nav-link fw-bold">
                     <i class="fa fa-address-card"></i> Register Akun
                 </a>
                 {{--  <a href="service.html" class="nav-item nav-link">Tentang</a>
                 <a href="blog.html" class="nav-item nav-link">Website Induk</a>  --}}
             </div>
             <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 flex-shrink-0">
                 <i class="fa fa-sign-in-alt me-1"></i>
                 LOGIN
             </a>
         </div>

     </nav>
 </div>

 <!-- Navbar & Hero End -->
