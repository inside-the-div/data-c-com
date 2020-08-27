<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Nasir">
	
  <!-- Bootstrap core CSS-->

  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Main styles -->
  <link href="{{ URL::asset('css/admin.css') }}" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{URL::asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Plugin styles -->
  <link href="{{URL::asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha256-xykLhwtLN4WyS7cpam2yiUOwr709tvF3N/r7+gOMxJw=" crossorigin="anonymous" />

  {{-- sweetalert2 --}}
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha512-hAFMASi3RewTdcR5m7meVmbFAwEu+2t9oXGrckvHgW5ozmKpk7AIfOM9Y/DfdKvfVMTZB6cwXpCBPeIyaCqT2Q==" crossorigin="anonymous" /> --}}


  <!-- WYSIWYG Editor -->
  <link rel="stylesheet" href="{{URL::asset('summer-note/summernote-bs4.css') }}">
  
  @yield('custom-css')

  <!-- Your custom styles -->
  <link href="{{URL::asset('css/default.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/custom.css')}}"  rel="stylesheet">
  <!-- start title area -->
  @yield('title')
  <!-- end title area -->

  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <style>
    #mainNav.navbar-dark .navbar-collapse .navbar-nav > .nav-item.dropdown > .nav-link:after{
      transition: 0.4s;
    }
    #mainNav.navbar-dark .navbar-collapse .navbar-nav > .nav-item.dropdown > .icon_rotate:after{
      
      transform: rotate(90deg);
    }
  </style>
	
</head>
<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('admin.dashboard')}}">
      <!-- <img src="img/logo.svg" data-retina="true" alt="" width="142" height="36"> -->
      <h2 class="text-white font-pt" style="height: 36px;">Data-E-Com
        
      </h2>

    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">


  

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Website">
        <a target="_blank" class="nav-link" href="{{route('website.home')}}">
          <i class="fa fa-fw fa-share"></i>
          <span class="nav-link-text font-pt">Website</span>
        </a>
      </li> 

     

      <li class="nav-item @if(Request::is('admin/dashboard') || Request::is('admin/')) active @endif" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text font-pt">Dashboard</span>
        </a>
      </li>



      <li class="nav-item @if(Request::is('admin/categories')) active @endif" data-toggle="tooltip" data-placement="right" title="Category">
        <a class="nav-link" href="{{route('admin.categories')}}">
          <i class="fa fa-tags" aria-hidden="true"></i>
          <span class="nav-link-text font-pt">Category</span>
        </a>
      </li>


 




      <li class="nav-item dropdown custom-dropdown" data-placement="right" title="Products" data-toggle="tooltip" data-target="#product-dropdown" aria-expanded="false" aria-controls="product-dropdown">
        <span class="nav-link" >
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <span class="nav-link-text font-pt">Products</span>
        </span>
        <div class="collapse @if(Request::is('admin/products') || Request::is('admin/product/add')) show @endif" id="product-dropdown">
          <div class="card card-body bg-dark">
              <a class="nav-link @if(Request::is('admin/products')) active @endif" href="{{route('admin.products')}}">
               <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
                <span class="nav-link-text font-pt">All</span>
              </a>
              <a class="nav-link @if(Request::is('admin/product/add')) active @endif" href="{{route('admin.product.add')}}">
                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                <span class="nav-link-text font-pt">Add</span>
              </a>
          </div>
        </div>
      </li>


      <li class="nav-item dropdown custom-dropdown" data-placement="right" title="Orders" data-toggle="tooltip" data-target="#order-dropdown" aria-expanded="false" aria-controls="product-dropdown">
        <span class="nav-link" >
           <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          <span class="nav-link-text font-pt">Order</span>
        </span>
        <div class="collapse @if(Request::is('admin/orders') || Request::is('admin/return')) show @endif" id="order-dropdown">
          <div class="card card-body bg-dark">
              <a class="nav-link @if(Request::is('admin/orders'))  active @endif" href="{{route('admin.orders')}}">
               <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
                <span class="nav-link-text font-pt">All</span>
              </a>
              <a class="nav-link @if(Request::is('admin/return')) active @endif" href="">
                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                <span class="nav-link-text font-pt">Return</span>
              </a>
          </div>
        </div>
      </li>
  
      


    <li class="nav-item dropdown custom-dropdown" data-placement="right" title="Customers" data-toggle="tooltip" data-target="#customers-dropdown" aria-expanded="false" aria-controls="review-dropdown">
      <span class="nav-link" >
        <i class="fa fa-male" aria-hidden="true"></i>
        <span class="nav-link-text font-pt">Customers</span>
      </span>
      <div class="collapse @if(Request::is('admin/customers') || Request::is('admin/reviews')) show @endif" id="customers-dropdown">
        <div class="card card-body bg-dark">
            <a class="nav-link @if(Request::is('admin/customers')) active @endif " href="{{route('admin.customers')}}">
             <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
              <span class="nav-link-text font-pt">All</span>
            </a>
            <a class="nav-link @if(Request::is('admin/reviews')) active @endif"  href="{{route('admin.reviews')}}">
              <i class="fa fa-star" aria-hidden="true"></i>
              <span class="nav-link-text font-pt">Reviews</span>
            </a>
        </div>
      </div>
    </li>





  <li class="nav-item dropdown custom-dropdown" aria-controls="emails-dropdown" aria-expanded="false" data-target="#emails-dropdown" data-toggle="tooltip" data-placement="right" title="Email">
    <span class="nav-link" >
      <i class="fa fa-envelope" aria-hidden="true"></i>
     <span class="nav-link-text font-pt">Emails</span>
    </span>
    <div class="collapse @if(Request::is('admin/emails') || Request::is('admin/email/send/page')) show @endif" id="emails-dropdown">
      <div class="card card-body bg-dark">
          <a class="nav-link @if(Request::is('admin/emails')) active @endif " href="{{route('admin.emails')}}">
           <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
            <span class="nav-link-text font-pt">All</span>
          </a>
          
      </div>
    </div>
  </li>
      
      

        






        <li class="nav-item dropdown custom-dropdown" data-placement="right" title="Data" data-toggle="tooltip" data-target="#data-dropdown" aria-expanded="false" aria-controls="data-dropdown">
          <span class="nav-link" >
            <i class="fa fa-line-chart" aria-hidden="true"></i>
            <span class="nav-link-text font-pt">Data</span>
          </span>
          <div class="collapse " id="data-dropdown">
            <div class="card card-body bg-dark">
             
                <a class="nav-link" href="{{route('admin.data.sells')}}">
                 <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                  <span class="nav-link-text font-pt">Sells</span>
                </a>
                
            </div>
          </div>
        </li>

        
        <li class="nav-item @if(Request::is('admin/reports')) active @endif" data-toggle="tooltip" data-placement="right"  title="Report">
          <a class="nav-link" href="{{route('admin.reports')}}">
            <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
            <span class="nav-link-text font-pt">Report</span>
          </a>
        </li>
        



        <li class="nav-item @if(Request::is('admin/settings')) active @endif" data-toggle="tooltip" data-placement="right"  title="Settings">
          <a class="nav-link" href="{{route('admin.settings')}}">
            <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
            <span class="nav-link-text font-pt">Settings</span>
          </a>
        </li>
      

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li>
          <a  class="nav-link">
            <div class="spinner-border spinner-border-sm" id="loading-spinner" role="status" >
              <span class="sr-only">Loading...</span>
            </div>
          </a>
        </li>

        <li class=" dropdown ">
          <a class="nav-link dropdown-toggle" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu " aria-labelledby="alertsDropdown" style="right: 0% !important; left:initial;">
            <a class="dropdown-item nav-item " href="{{route("admin.profile")}}"><i class="fa fa-fw fa-user"></i>Profile</a>


            <a class="dropdown-item nav-item " href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


          </div>
        </li>





      </ul>
    </div>
  </nav>
  <!-- /Navigation-->

  <div class="content-wrapper">
    <div class="container-fluid">
      





    @if (Session::has('access'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{Session::get('access')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif



		  <!-- start main content area  -->
      @yield('content')
      <!-- end main content area -->
        
	  </div>
	  <!-- /.container-fluid-->
  </div>
    <!-- /.container-wrapper-->



    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © DoDo Online Shop</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>








        <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ URL::asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('js/admin-datatables.js') }}"></script>
  
    <script src="{{ URL::asset('summer-note/summernote-bs4.min.js') }}"></script>

   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('js/admin.js') }}"></script>
    <script src="{{ URL::asset('js/function.js') }}"></script>
    {{-- <script src="{{ URL::asset('js/admin-custom.js') }}"></script> --}}
    <script src="{{ URL::asset('js/ajax-delete.js') }}"></script>


    <script>

        // ajax call setup header 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // end header setup 

      
        $(document).ready(function(){

          @if(Session::has('success'))
            Toast.fire({
              icon: 'success',
              title: "{{Session::get('success')}}"
            })
          @endif

          @if ($errors->any())
              @foreach ($errors->all() as $error)
                toastr.error("{{$error}}");
              @endforeach
          @endif



          $(".custom-dropdown").click(function(){

           

            
            $(this).attr('data-toggle','collapse');

            var nav_link = $(this).find('span').eq(0);

            nav_link.toggleClass('icon_rotate');

          })



          $("#loading-spinner").hide();


          $("#website-cache-control-btn").click(function(e){

            $(this).addClass('active');


            $("#loading-spinner").show();
           
            var id = 1;

            $.ajax({
               type:'POST',
               url:'/clear-cache',
               data:{id:id},
               success:function(data){


                  $("#loading-spinner").hide();
                 
                 

                  Toast.fire({
                    icon: 'success',
                    title: data.message
                  })
               }

            });
            e.preventDefault();
          })




        }) // end ajax
       
    </script>

    @yield('footer-section')
    </body>
</html>


