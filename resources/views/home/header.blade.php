<style>
   /* Prevent navigation text wrapping */
.navigation .navbar-nav .nav-link,
.navigation .navbar-nav .btn {
    white-space: nowrap;
    font-size: 14px;
    padding: 8px 12px;
}

.navigation .navbar-nav .nav-item {
    padding: 0 3px;
}

/* Reduce button padding */
.navigation .btn {
    padding: 6px 15px;
    font-size: 14px;
}

   /* Prevent navigation text wrapping */
.navigation .navbar-nav .nav-link,
.navigation .navbar-nav .btn {
    white-space: nowrap;
    font-size: 14px;
    padding: 8px 12px;
}

.navigation .navbar-nav .nav-item {
    padding: 0 3px;
}

/* Reduce button padding */
.navigation .btn {
    padding: 6px 15px;
    font-size: 14px;
}

/* Logo size control */
.logo_section .logo img {
    max-width: 650px;
    max-height: 70px;
    width: 140px;
    height: auto;
    object-fit: contain;
}

/* Adjust logo container alignment */
.logo_section .center-desk {
    display: flex;
    align-items: center;
    height: 100%;
}

.logo_section .logo {
    display: flex;
    align-items: center;
}
</style>


 <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="{{url('/')}}"><img src="images/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{url('/')}}">Home</a>
                              </li>
                           
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('our_room')}}">Our rooms</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('our_gallery')}}">Gallery</a>
                              </li>
                             
                              <li class="nav-item">
                                 <a class="nav-link" href="{{url('contact_us')}}">Contact Us</a>
                              </li>
                             



 @if (Route::has('login'))
               
                    @auth
                       <x-app-layout>
    

   
                     </x-app-layout>

                    @else
                         <li class="nav-item" style="padding-right: 10px">
                                 <a class="btn btn-success" href="{{url('login')}}">Login</a>
                              </li>

                        @if (Route::has('register'))
                           <li class="nav-item" >
                                 <a class="btn btn-primary" href="{{url('register')}}">Register</a>
                              </li>
                             
                        @endif
                    @endauth
                
            @endif

                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>