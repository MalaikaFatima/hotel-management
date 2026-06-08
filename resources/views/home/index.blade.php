<!DOCTYPE html>
<html lang="en">
   <head>
     @include('home.css')
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> 
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
        @include('home.header')
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
    @include('home.banner')    
    </section>
      <!-- end banner -->
      <section class="banner_main">
         @include('home.chat')    
         </section>
      <!-- about -->
      <div class="about">
        @include('home.about')
      </div>
      <!-- end about -->
      <!-- our_room -->
      
      <!-- end our_room -->
      <!-- gallery -->
      <div  class="gallery">
       @include('home.gallery')
      </div>
      <!-- end gallery -->
      <!-- blog -->
      <div  class="blog">
        @include('home.blog')
      </div>
      <!-- end blog -->
      <!--  contact -->
      <div class="contact">
         @include('home.contact')
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer>
         @include('home.footer')
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
     @include('home.js')
     <script>
      window.addEventListener('beforeunload', function() {
         localStorage.setItem('scrollPosition', window.scrollY);
      });
   </script>

   <script>
      window.addEventListener('load', function() {
         const scrollPosition = localStorage.getItem('scrollPosition');
         if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
            localStorage.removeItem('scrollPosition');
         }
      });
   </script></body>
</html>