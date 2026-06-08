<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
  </head>
  <body>
    <header class="header">   
      @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
<center>


<h1 style="font-size: 40px;font-weight:bold;color:wheat;">
    Gallery
</h1>
<br>
<div class="row">
   
@foreach ($gallery as $item)
<div class="col-md-4">
  <img style="height: 200px!important; width:300px!important;" src="/gallery/{{$item->image}}"><br>
 <a href="{{url('delete_gallery',$item->id)}}" class="btn btn-danger"  >Delete Image</a> <br>

<br>
</div>  
@endforeach
</div>
<form action="{{url('upload_gallery')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div style="padding:30px;">

        <label style="color: white; font-weight:bold;" >Upload</label>
        <input type="file" name="image" required>
 
        <input class="btn btn-primary" type="submit" value="Add Image" >
    </div>
</form>
</center>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>