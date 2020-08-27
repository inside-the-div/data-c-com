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
  <!-- Main styles -->
  <link href="{{ URL::asset('css/admin.css') }}" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{URL::asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Plugin styles -->
  <link href="{{URL::asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet">

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
    .active{
      background: #f8f8f8 !important;
      color: #333 !important;
    }
  </style>
	
</head>
<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="/">
      <!-- <img src="img/logo.svg" data-retina="true" alt="" width="142" height="36"> -->
      <h2 class="text-white font-pt" style="height: 36px">DoDo Online Shop | Customer</h2>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">


      <li class="nav-item " data-toggle="tooltip" data-placement="right" title="site">
        <a class="nav-link" href="/" target="_blank">
          <i class="fa fa-fw fa-share"></i>
          <span class="nav-link-text font-pt">Site</span>
        </a>
      </li>

      <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link @if(Request::is('customer')) active @endif" href="{{route('customer.home')}}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text font-pt">Dashboard</span>
        </a>
      </li>

      <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link @if(Request::is('customer/order') || Request::is('customer/order/*')) active @endif" href="{{route('customer.order')}}">
          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          <span class="nav-link-text font-pt">My Order</span>
        </a>
      </li>

      <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link @if(Request::is('customer/reviews')) active @endif " href="{{route('customer.reviews')}}">
          <i class="fa fa-star" aria-hidden="true"></i>
          <span class="nav-link-text font-pt">Reviews</span>
        </a>
      </li>

      <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link @if(Request::is('customer/profile')) active @endif" href="{{route('customer.profile')}}">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text font-pt">Profile</span>
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

        <li class=" dropdown ">
          <a class="nav-link dropdown-toggle" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu " aria-labelledby="alertsDropdown" style="right: 0% !important; left:initial;">
            <a class="dropdown-item nav-item " href="{{route('customer.profile')}}"><i class="fa fa-fw fa-user"></i>Profile</a>


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
      

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{$error}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endforeach
    @endif

  <div id="success-message">
    @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>

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
          <small>Copyright © DoDo Online Shop 2020</small>
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
    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('js/admin.js') }}"></script>
    <script src="{{ URL::asset('js/function.js') }}"></script>

    @yield('footer-section')
    </body>
</html>


