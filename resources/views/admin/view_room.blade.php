<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
.table_design{

border: 2px solid white;
margin: auto;
width: 85%;
text-align: center;
margin-top: 40px;

}
.th_deg{

background-color: beige;
padding: 15px;
}
tr{
  border: 3px solid white;
}
td{
  padding:10px ;
}

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
    <th class="th_deg">Room Title</th>
    <th class="th_deg">Description</th>
    <th class="th_deg">Price</th>
    <th class="th_deg">Wifi</th>
    <th class="th_deg">Room Type</th>
    <th class="th_deg">Room View</th>
    <th class="th_deg">Delete</th>
    <th class="th_deg">Update</th>
  </tr>
  <tr>
    @foreach($data as $room)
    <tr>
      <td>{{ $room->room_title }}</td>
      <td>{!! Str::limit($room->description, 100) !!}</td>
      <td>{{ $room->price }}$</td>
      <td>{{ $room->wifi }}</td>
      <td>{{ $room->room_type }}</td>
      <td><img width="100" src="room/{{ $room->image }}" alt=""></td>
      <td>
        <a  onclick="return confirm('Are you sure you want to Delete this')"class="btn btn-danger" href="{{url('room_delete',$room->id)}}">Delete</a>
      </td>
      <td>
        <a  class="btn btn-warning" href="{{url('room_update',$room->id)}}">Update</a>
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