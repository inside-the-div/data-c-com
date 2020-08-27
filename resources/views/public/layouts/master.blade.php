<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Nasir">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('seo')
    <title>@yield('title')</title>
	


	
    <!-- GOOGLE WEB FONT -->
   	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" as="fetch" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
    !function(e,n,t){"use strict";var o="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap",r="__3perf_googleFonts_c2536";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
    </script>


    <!-- BASE CSS -->
    <link href="{{URL::asset('assets/front-end/css/bootstrap.custom.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="{{URL::asset('assets/front-end/css/style.css')}}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{URL::asset('assets/front-end/css/home_1.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/front-end/css/single-product.css')}}" rel="stylesheet">
	
	<style>
		body{
			position: relative;
		}
		.notification{
		  width: 180px;
		  height: 40px;
		  background: #4caf50;
		  position: fixed;
		  bottom: 5px;
		  left: 3px;
		  text-align: center;
		  line-height: 40px;
		  font-size: 20px;
		  color: #fff;
		  border-radius: 5px;
		  box-shadow: 0px 0px 7px 1px rgb(0 0 0 / 61%);
		  z-index: 100;
		  display:none;
		}
		#notification-already-added{
			background: #FFC107;
			color: #333;
		}
		#notification-product-updated{
			background: #4caf50;
			color: #fff;
		}
		.category-ul li a{
			text-transform: capitalize !important;
		}
	</style>



    {{-- header --}}
    @yield('header')
    {{-- end header --}}

</head>

<body>

	<div id="notification-product-added" class="notification">
	  <div id="content-1">Product Added</div>
	</div>

	<div id="notification-already-added" class="notification">
	  <div id="content-2">Already Added</div>
	</div>

	<div id="notification-product-updated" class="notification">
	  <div id="content-3">Product Updated</div>
	</div>
	
	<div id="page">

		@auth

		@if(Session::get('type') == 'admin')
		    <section style="background:#333">
		    	<div class="container">
    				    <div class="row">
    		    			<div class="col-12 py-1" >
    		    				<a target="_blank" style="font-size: 16px; color: #fff;" class=" pl-0 pr-2" href="{{route('admin.home')}}">Dashboard</a>
    		    				<a target="_blank" style="font-size: 16px; color: #fff;" class="px-2" href="{{route('admin.products')}}">Products</a>
    		    				<a target="_blank" style="font-size: 16px; color: #fff;" class="px-2" href="{{route('admin.orders')}}">Orders</a>
    		    				<a target="_blank" style="font-size: 16px; color: #fff;" class="px-2" href="{{route('admin.customers')}}">Custommer</a>
    		    			</div>
    		    		</div>
		    	</div>
		    </section>
		    @endif
		@endauth
		
		
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		<div class="main_header">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
						<div id="logo">
							<!-- <a href="index.html"><img src="img/logo.svg" alt="" width="100" height="35"></a> -->
							<a href="{{route('website.home')}}">
								<h1 class="text-white mt-2">DoDo</h1>
							</a>
						</div>
					</div>
					<nav class="col-xl-6 col-lg-7">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<!-- <a href="index.html">
	<h1 class="text-dark mt-2">DoDo</h1>
</a> -->
								<a href="index.html">
									<h1 class="text-dark mt-2">DoDo</h1>
								</a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								<li class="">
									<a href="" class="show-submenu">Custom Order</a>
									
								</li>
								<li class="megamenu ">
									<a href="{{route('website.about_page')}}" class="show-submenu-mega">About</a>
									
									<!-- /menu-wrapper -->
								</li>
								<li class="">
									<a href="{{route('website.contact_page')}}" class="show-submenu">Contact</a>
								</li>
								<li>
									<a href="">Feedback</a>
								</li>
								<li>
									<a href="" target="_parent">Blog</a>
								</li>
							</ul>
						</div>
						<!--/main-menu -->
					</nav>
					<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
						<a class="phone_top" href="tel://9438843343"><strong><span>Need Help?</span>01637017926</strong></a>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->

		<div class="main_nav Sticky">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 col-md-3">
						<nav class="categories">
							<ul class="clearfix">
								<li><span>
										<a href="#">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											Categories
										</a>
									</span>
									<div id="menu">
										<ul class="category-ul">
											@foreach(Session::get('categories') as $category)

												<li><a href="{{route('website.single_category',['slug' => $category->slug])}}" >{{$category->name}}</a></li>
											@endforeach
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
						<div class="custom-search-input">
							<form method="POST" action="{{route('website.search')}}">
								@csrf
								<input required type="text" name="keyword" placeholder="Search over 10.000 products">
								<button type="submit"><i class="header-icon_search_custom"></i></button>
							</form>
						</div>
					</div>
					<div class="col-xl-3 col-lg-2 col-md-3">
						<ul class="top_tools">
							<li>
								<div class="dropdown dropdown-cart">
									<a href="cart.html" class="cart_bt"><strong id="total_cart_products">0</strong></a>
									<div class="dropdown-menu">
										<ul id="cart_items_list">
											
											
										</ul>
										<div class="total_drop">
											<div class="clearfix"><strong>Total</strong><span id="total_price_of_cart">0.0</span></div>
											<a href="{{route('website.cart.view')}}" class="btn_1 outline">View Cart</a>
											<a id="delete-full-cart" href="#" class="btn_1" style="background: #dc3545; color: #fff;">Delete Cart</a>
											<a href="{{route('website.cart.check_out')}}" class="btn_1">Checkout</a>
										</div>
									</div>
								</div>
								<!-- /dropdown-cart-->
							</li>
							<li>
								<a href="#0" class="wishlist"><span>Wishlist</span></a>
							</li>
							<li>
								<div class="dropdown dropdown-access">
									<a href="account.html" class="access_link"><span>Account</span></a>
									<div class="dropdown-menu">
										<a href="account.html" class="btn_1">Sign In or Sign Up</a>
										<ul>
											<li>
												<a href="{{route('login')}}"><i class="ti-truck"></i>Track your Order</a>
											</li>
											<li>
												<a href="{{route('login')}}"><i class="ti-package"></i>My Orders</a>
											</li>
											<li>
												<a href="{{route('login')}}"><i class="ti-user"></i>My Profile</a>
											</li>
											<li>
												<a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
											</li>
										</ul>
									</div>
								</div>
								<!-- /dropdown-access-->
							</li>
							<li>
								<a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
							</li>
							<li>
								<a href="#menu" class="btn_cat_mob">
									<div class="hamburger hamburger--spin" id="hamburger">
										<div class="hamburger-box">
											<div class="hamburger-inner"></div>
										</div>
									</div>
									Categories
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="search_mob_wp">
				<input type="text" class="form-control" placeholder="Search over 10.000 products">
				<input type="submit" class="btn_1 full-width" value="Search">
			</div>
			<!-- /search_mobile -->
		</div>
		<!-- /main_nav -->
	</header>
	<!-- /header -->
		
	<main>

@if(Request::is('/'))
		<div id="carousel-home" class="container mt-2">
			<div class="owl-carousel owl-theme">

				@foreach(Session::get('sliders') as $slider)
				<div class="owl-slide cover" style="background-image: url({{URL::asset('/assets/img/slider')}}/{{$slider->image}}); border-radius: 15px 15px 0px 0px; border:2px solid #004dda;">
					
				</div>
				@endforeach

			</div>
			<div id="icon_drag_mobile"></div>
		</div>
		<!--/carousel-->
@endif
<!--/end slider-->


		{{-- main content start --}}
			
		@yield('content')

		{{-- main content end --}}






	
		
	</main>
	<!-- /main -->

	<footer class="revealed">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1">Quick Links</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<li><a href="{{route('website.about_page')}}">About us</a></li>
							<li><a href="{{route('website.contact_page')}}">Contacts</a></li>
							<li><a href="{{route('website.faq_page')}}">Faq</a></li>
							<li><a href="{{route('website.help_page')}}">Help</a></li>
							<li><a href="{{route('customer.home')}}">My account</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_2">Categories</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
							<li><a href="{{route('website.single_category',['slug'=>'men'])}}">Men</a></li>
							<li><a href="{{route('website.single_category',['slug'=>'boy'])}}">Boy</a></li>
							<li><a href="{{route('website.single_category',['slug'=>'women'])}}">Women</a></li>
							<li><a href="{{route('website.single_category',['slug'=>'girl'])}}">Girl</a></li>
							<li><a href="{{route('website.single_category',['slug'=>'kids'])}}">Kids</a></li>
							
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3">Contacts</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li><i class="ti-home"></i>Dhanmondi-32<br>Dhaka - BD</li>
							<li><i class="ti-headphone-alt"></i>{{Session::get('phone')}}</li>
							<li><i class="ti-email"></i><a href="#0">{{Session::get('email')}}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_4">Keep in touch</h3>
					<div class="collapse dont-collapse-sm" id="collapse_4">
						<div id="newsletter">
						    <div class="form-group">
						        <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
						        <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
						    </div>
						</div>
						<div class="follow_us">
							<h5>Follow Us</h5>
							<ul>
								{{-- <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li> --}}
								{{-- <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li> --}}
								{{-- <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li> --}}
								{{-- <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li> --}}
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
						{{-- <li>
							<div class="styled-select lang-selector">
								<select>
									<option value="English" selected>English</option>
									<option value="French">French</option>
									<option value="Spanish">Spanish</option>
									<option value="Russian">Russian</option>
								</select>
							</div>
						</li> --}}
{{-- 						<li>
							<div class="styled-select currency-selector">
								<select>
									<option value="US Dollars" selected>US Dollars</option>
									<option value="Euro">Euro</option>
								</select>
							</div>
						</li> --}}
						<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="additional_links">
						<li><a href="{{route('website.condition_page')}}">Terms and conditions</a></li>
						<li><a href="{{route('website.privacy_page')}}">Privacy</a></li>
						<li><span>Copyright © @php echo date('Y') @endphp {{Session::get('copyright')}}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="{{URL::asset('assets/front-end/js/common_scripts.min.js')}}"></script>
    <script src="{{URL::asset('assets/front-end/js/main.js')}}"></script>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="{{URL::asset('assets/front-end/js/carousel-home.min.js')}}"></script>
	<script src="{{URL::asset('assets/front-end/js/single-product.js')}}"></script>
	<script src="{{URL::asset('assets/front-end/js/add-to-cart.js')}}"></script>


	<script>
		// ajax call setup header 
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		// end header setup 
	</script>

	
	{{-- footer content --}}
	@yield('footer')
	{{-- footer end --}}
</body>
</html>