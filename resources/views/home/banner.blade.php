

<div id="myCarousel" class="carousel slide banner" data-ride="carousel">
   <ol class="carousel-indicators">
       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
       <li data-target="#myCarousel" data-slide-to="1"></li>
       <li data-target="#myCarousel" data-slide-to="2"></li>
   </ol>
   <div class="carousel-inner">
       <div class="carousel-item active">
           <img class="first-slide" src="images/banner2.jpg" alt="First slide">
           <div class="container"></div>
       </div>
       <div class="carousel-item">
           <img class="second-slide" src="images/banner1.jpg" alt="Second slide">
       </div>
   </div>
   <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
   </a>
</div>

<div class="booking_ocline">
   <div class="container">
       <div class="row">
           <div class="col-md-5">
               <div class="book_room">
                   <h1>Book a Room Online</h1>
                   
                   {{-- SINGLE FORM - No nested forms! --}}
                   <form class="book_now" action="{{ url('our_room') }}" method="GET">
                     <div class="row">
                        <div class="col-md-12 mb-3">
                           <span>Arrival</span>
                           <input 
                              type="date" 
                              class="form-control bg-white text-dark"
                              name="start_date" 
                              min="{{ date('Y-m-d') }}" 
                              required>
                        </div>
                  
                        <div class="col-md-12 mb-3">
                           <span>Departure</span>
                           <input 
                              type="date" 
                              class="form-control bg-white text-dark"
                              name="end_date" 
                              min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                              required>
                        </div>
                  
                        <div class="col-md-12">
                           <button type="submit" class="book_btn btn btn-danger w-100 text-white border-0">
                              Book Now
                           </button>
                        </div>
                     </div>
                  </form>
                  
               </div>
           </div>
       </div>
   </div>
</div>