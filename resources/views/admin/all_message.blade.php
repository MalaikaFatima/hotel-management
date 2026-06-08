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
                 
                  <th class="th_deg">Name</th>
                  <th class="th_deg">Email</th>
                  <th class="th_deg">Phone</th>
                  <th class="th_deg">Message</th>
                  <th class="th_deg">Send Email</th>
                <tr>
              @foreach ($data as $item)
           
                  <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->Email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->message}}</td>
                    <td>
                      <a class="btn btn-danger" href="{{url('send_mail',$item->id)}}">Send mail</a>
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