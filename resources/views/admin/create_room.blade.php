<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
label{
    
    display: inline-block;
    width: 200px;
   
}
.div_deg{
  padding-top:30px; 
 
}
.div_center{
    text-align: center;
    padding-top: 40px;
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
           <div class="div_center">
            <h1 style="font-size:30px; 
            color:beige;
            font-weigth:bold;">Add Rooms</h1>
                <form action="{{url('add_room')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_deg">
                        <label  >Room title</label>
                        <input type="text" name="title">
                    </div>

                    <div class="div_deg">
                        <label >Description
                        </label>
                        <textarea name="description" id="" ></textarea>
                    </div>

                    <div class="div_deg">
                     <label >price </label>
                     <input type="number" name="price"></input>
                    </div>

                    <div class="div_deg">
                       <label >Room type </label>
                       <select name="type">
                        <option selected value="regular">Regular</option>
                        <option  value="premium">Premium</option>
                        <option   value="deluxe">Deluxe</option>
                       </select>
                    </div>

                    <div class="div_deg">
                        <label >Free Wifi </label>
                        <select name="wifi" >
                         <option selected value="yes">yes</option>
                         <option  value="no">No</option>
                        </select>
                     </div>

                    <div class="div_deg">
                    <label >Upload image</label>
                    <input type="file" name="image">    
                                       
                    </div> 
                    <div class="div_deg">
                        <input   class="btn btn-primary" type="submit" value="Add Room">
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>