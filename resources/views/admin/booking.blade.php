<!DOCTYPE html>
<html>
  <head> 
    {{-- <base href="/public">  --}}
   @include('admin.css')
   <style type="text/css">
   .table_design {
  border: 2px solid white;
  margin: 40px auto;
  width: 98%;
  text-align: center;
  table-layout: fixed;
  border-collapse: collapse;
  font-size: 15px; /* 🩵 smaller font size for the table */
}

.th_deg {
  background-color: beige;
  padding: 8px;
  color: black;
  font-weight: 600;
  white-space: nowrap;
  font-size: 14px; /* 🩵 smaller header font */
}

tr {
  border: 2px solid #2c2c2c;
}

td {
  padding: 7px;
  vertical-align: middle;
  word-wrap: break-word;
  font-size: 14px; /* 🩵 slightly smaller text in cells */
}

.room_image {
  width: 120px !important;
  height: 85px !important;
  object-fit: cover;
  border-radius: 6px;
}

/* Perfect widths for 13 columns */
.table_design th:nth-child(1) { width: 3%; }
.table_design th:nth-child(2) { width: 9%; }
.table_design th:nth-child(3) { width: 11%; }
.table_design th:nth-child(4) { width: 10%; }
.table_design th:nth-child(5) { width: 7%; }
.table_design th:nth-child(6) { width: 7%; }
.table_design th:nth-child(7) { width: 7%; }
.table_design th:nth-child(8) { width: 9%; }
.table_design th:nth-child(9) { width: 9%; }
.table_design th:nth-child(10) { width: 6%; }
.table_design th:nth-child(11) { width: 11%; }
.table_design th:nth-child(12) { width: 8%; }
.table_design th:nth-child(13) { width: 8%; }

   </style>
  </head>
  <body>
    <header class="header">   
      @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <table class="table_design">
              <tr>
                <th class="th_deg">ID</th>
                <th class="th_deg">Customer</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Phone</th>
                <th class="th_deg">Checkin</th>
                <th class="th_deg">Checkout</th>
                <th class="th_deg">Status</th>
                <th class="th_deg">Room Title</th>
                <th class="th_deg">Room Type</th>
                <th class="th_deg">Amenities</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Update</th>
              </tr>
              
              @foreach($data as $room)
              <tr>
                <td>{{$room->room_id}}</td>
                <td>{{$room->name}}</td>
                <td>{{$room->email}}</td>
                <td>{{$room->phone}}</td>
                <td>{{$room->start_date}}</td>  
                <td>{{$room->end_date}}</td>
                <td>
                  @if ($room->status=='approve')
                  <span style="color: rgb(129, 196, 223)">Approved</span>                           
                  @endif
                  @if ($room->status=='rejected')
                  <span style="color: rgb(241, 241, 236)">Rejected</span>                          
                  @endif
                  @if ($room->status=='waiting')
                  <span style="color: rgb(183, 223, 188)">Waiting</span>                          
                  @endif
                </td>
                <td>{{$room->room->room_title}}</td>
                <td>{{$room->room->room_type}}</td>
             
                <td>
                  {{ $room->total_price ?? $room->room->price + $room->amenities->sum('price') }}
                </td>
                
                <td>
                  <img class="room_image" src="/room/{{$room->room->image}}" alt="Room Image">
                </td>
                <td>
                  <a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger" href="{{url('delete_booking',$room->id)}}">Delete</a>
                </td>
                <td>
                  <span style="padding-bottom:10px;">
                    <a class="btn btn-warning" href="{{url('approved_book',$room->id)}}">Approve</a>
                  </span>
                  <a class="btn btn-success" href="{{url('rejected_booking',$room->id)}}">Rejected</a>
                </td>
              </tr>
              @endforeach
            </table>

          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>