<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
     
    </div> 
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{url('myhome')}}"> <i class="icon-home"></i>Home </a></li>
           
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Hotels Rooms </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{url('create_room')}}">Add Rooms</a></li>
                <li><a href="{{url('view_room')}}">View Rooms</a></li>
                </ul>
            </li>
            <li ><a href="{{url('bookings')}}"> <i class="icon-home"></i>Bookings </a></li>
            <li>
              <a href="{{ url('myhome') }}"> 
                  <i class="icon-home"></i>Monthly Report 
              </a>
          </li>
          ```
          
            <li ><a href="{{url('view_gallery')}}"> <i class="icon-home"></i>Gallery </a></li>
            <li ><a href="{{url('all_message')}}"> <i class="icon-home"></i>Customer Message </a></li>

    </ul>
  </nav>