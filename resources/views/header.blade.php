<?php
  use App\Http\Controllers\ProductController;
  $total = 0;
  if(Session::has('user')){
    $total = ProductController::cartitem();
  }
?>


<nav class="navbar navbar-default" style="background-color: #d9edf7;border-color: #428bca38; height:60px;"role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Shopping :)</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="/">Home</a></li>
        @if(Session::has('user'))
        <li class=""><a href="/myorders">Order</a></li>
        @else
        <li class=""><a href="/">Order</a></li>
        @endif
      </ul>

      
      <div class="container" style="display: hidden">
          <input type="search" name="box" id="search" class="form-control" placeholder="Search" style="margin-top: 9px;width: auto;"required />
              <div  class="container-fluid"> 
                <ul class="dropdown-menu" id="Searched" style="display:block; position:relative; z-index:1;" >
                </ul>
            </div>
      </div>
      
      

      <ul class="nav navbar-nav navbar-right"  style="position: absolute; top:0px; right: 41px;">
        @if(Session::has('user'))
        <li><a href="/cartlist">Cart({{$total}})</a></li>  
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Session::get('user')['name']}}</a>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/logout">Logout</a></li>
        </ul>
      </li>
      @else
      <li>
      <a href="/Register">Register</a>
      </li>
      <li>
      <a href="/login">Login</a>
      </li>
      @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


  
  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script>
    
    $(document).ready(function(){
      $("#search").on('keyup',function(){

        var value = $(this).val();
        
        $.ajax({
              method:"GET",
              url:"/search_product",
              // dataType: 'JSON',
              data:{'name': value},

          success: function(data) {
                $("#Searched").html(data);
          }

        });
      });
    });
   
  </script>
