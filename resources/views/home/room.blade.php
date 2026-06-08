<div class="container">

   <div class="row mb-4">
       <div class="col-md-12">
           <div class="card">
               <div class="card-body">
                 
                   <form action="{{ url('our_room') }}" method="GET" class="row">
                       <div class="col-md-4">
                           <label>Check-in Date</label>
                           <input type="date" 
                                  name="start_date" 
                                  class="form-control" 
                                  value="{{ request('start_date') }}"
                                  min="{{ date('Y-m-d') }}"
                                  required>
                       </div>
                       <div class="col-md-4">
                           <label>Check-out Date</label>
                           <input type="date" 
                                  name="end_date" 
                                  class="form-control" 
                                  value="{{ request('end_date') }}"
                                  min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                  required>
                       </div>
                       <div class="col-md-4">
                           <label>&nbsp;</label>
                           <button type="submit" class="btn btn-primary form-control">
                               <i ></i> Check available Room
                           </button>
                       </div>
                   </form>
                   
                 
                 
               </div>
           </div>
       </div>
   </div>


   @if(session('success'))
   <div class="alert alert-success">{{ session('success') }}</div>
   @endif
   
   @if(session('error'))
   <div class="alert alert-danger">{{ session('error') }}</div>
   @endif


   @if($room->isEmpty())
       <div class="alert alert-warning text-center">
           <h4>No Rooms Available</h4>
           <p>Please try different dates</p>
       </div>
   @else
       <div class="row">
           @foreach ($room as $rooms)
           <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                   <div class="room_img">
                       <figure>
                           <img style="height: 200px; width:350px;" 
                                src="room/{{$rooms->image}}" 
                                alt="{{$rooms->room_title}}"/>
                       </figure>
                   </div>
                   <div class="bed_room">
                       <h3>{{$rooms->room_title}}</h3>
                       <p style="padding: 10px;">
                           {!! Str::limit($rooms->description, 100) !!}
                       </p>
                       
                       <div class="mb-2">
                           <span class="badge badge-info">{{ ucfirst($rooms->room_type) }}</span>
                           <span class="badge badge-success">${{ $rooms->price }}/night</span>
                       </div>
                       
                       <a class="btn btn-primary" 
                          href="{{url('room_details', $rooms->id)}}">
                           View Details & Book
                       </a>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   @endif
</div>