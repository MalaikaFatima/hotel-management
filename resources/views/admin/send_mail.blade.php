<!DOCTYPE html>
<html>
  <head>   <base href="/public">
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

<center>
    <h1 style="font-size: 40px; font-weight:bold; color:white;">Mail send to {{$data->name}}</h1>

    <form action="{{url('mail',$data->id)}}" method="Post">
        @csrf
        <div class="div_deg">
            <label  >Greeting</label>
            <input type="text" name="greeting">
        </div>

        <div class="div_deg">
            <label >Mail Body
            </label>
            <textarea name="body" id="" ></textarea>
        </div>

        <div class="div_deg">
         <label >Action_Text </label>
         <input type="text" name="action_text"></input>
        </div>
        <div class="div_deg">
            <label >Action_Url </label>
            <input type="text" name="action_url"></input>
           </div>
           
           <div class="div_deg">
            <label >End Line</label>
            <input type="text" name="endline"></input>
           </div>

        <div class="div_deg">
            <input   class="btn btn-primary" type="submit" value="Send mail">
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