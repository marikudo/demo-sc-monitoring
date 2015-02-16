<html>
	<head>
	<title><?=$title?></title>
	<!--title logo-->
	<link rel="icon" href="<?=base_url()?>assets/images/logo.png">
	
	<!--##################-->
	<!--#########################-->
	
	<script type="text/javascript" src="<?=base_url()?>assets/reservation/js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/reservation/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/reservation/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/reservation/js/action.js"></script>



	<!--
	<script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('public/js/bootstrap.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('public/js/action.js')?>"></script>
	
	<script type="text/javascript" src="<?=base_url('public/nivo/jquery.nivo.slider.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('public/elevatezoom/jquery.elevatezoom.js')?>"></script>

	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/bootstrap-theme.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/bootstrap.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/jquery-ui.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/jquery-ui.structure.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/jquery-ui.theme.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/nivo/themes/default/default.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/nivo/nivo-slider.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/font-awesome/font-awesome.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/font-awesome/css/font-awesome.css')?>" />-->


	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/reservation/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/reservation/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/reservation/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/reservation/css/style.css">

	<!--#########################-->


	<!-- fjfajfhajhakjfhgkjalkdgjkljajkagklagkakakfkgl -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>		
			<!-- asfdasfdsf -->



	</head>
	<body>
	<div id="popimage_container">
	</div>
	<div id="container">
		<div id="left-container">
			<div id="side-content">
				<div id="side-header">
					<img src="<?=base_url()?>assets/reservation/images/floral-reserve-icon.png"/>
					<h4 class="title">Select Dates</h4>
				</div>
				<div id="side-body">
			 		<form action="#" class="form-horizontal" method="POST">
			 			<div class="form-group">
			 				<div class="col-xs-12">
			 					<label>Check In:</label>
			 					<div class="input-group input-group-sm">
			 						<input type="text" name="arrival" id="arrival" class="form-control">
			 						<span class="input-group-btn">
			 							<button class="btn btn-warning"><i class="fa fa-calendar"></i></button>
			 						</span>
			 					</div>
			 				</div>
			 			</div>
	 					<div class="form-group">
			 				<div class="col-xs-12">
			 				<label>Check Out:</label>
			 					<div class="input-group input-group-sm">
			 						<input type="text" name="departure" id="departure" class="form-control">
			 						<span class="input-group-btn">
			 							<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-calendar"></i></button>
			 						</span>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="form-group">
			 				<div class="col-xs-12">
			 					<input type="submit" class="btn btn-block btn-default" id="book" value="">
			 				</div>
			 			</div>
			 		</form>
				</div>
				<div id="side-footer">
					<ul id="side-icons">
						<li><a href="https://twitter.com/HotelFelicidad"><img src="<?=base_url();?>assets/reservation/images/tweeter-icon.png"></a></li>
						<li><a href="https://www.facebook.com/hotelfelicidadvigan"><img src="<?=base_url();?>assets/reservation/images/facebook-icon.png"></a></li>
						<li><a href="http://www.experiencephilippines.org/vigan-ilocos-sur/"><img src="<?=base_url();?>assets/reservation/images/dot-icon.png"></a></li>
						<li><a href="#"><img src="<?=base_url();?>assets/reservation/images/instagram-icon.png"></a></li>
						<li><a href="https://foursquare.com/v/hotel-felicidad/4f3fd347e4b0ae0655802c49"><img src="<?=base_url();?>assets/reservation/images/foursquare-icon.png"></a></li>
						<li><a href="http://www.tripadvisor.com.ph/Hotel_Review-g424958-d3655405-Reviews-Hotel_Felicidad-Vigan_Ilocos_Sur_Province_Ilocos_Region_Luzon.html"><img src="<?=base_url();?>assets/reservation/images/tripadvisory-icon.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>	
	<!--<div id='cont'>
		<div id="container">
			
					<a href="<?=base_url('home')?>"><img src="<?=base_url()?>assets/reservation/images/upper-logo.png" id="upper_logo" title="hotel Felicidad"></a>
			 <div id="left_container">
			 	<div id="padding">
			 		<h2>Select Dates</h2>
			 			<div class="form-group">
			 				<div class="col-xs-12">
			 					<label>Check In:</label>
			 					<div class="input-group input-group-sm">
			 						<input type="text" name="arrival" id="arrival" class="form-control">
			 						<span class="input-group-btn">
			 							<button class="btn btn-warning"><i class="fa fa-calendar"></i></button>
			 						</span>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="form-group">
			 				<div class="col-xs-12">
			 					<div class="input-group input-group-sm">
			 						<input type="text" name="departure" id="departure" class="form-control">
			 						<span class="input-group-btn">
			 							<button type="button" class="btn btn-warning"><i class="fa fa-calendar"></i></button>
			 						</span>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="form-group">
			 				<div class="col-xs-12">
			 					<input type="submit" class="btn btn-sm btn-default" id="book" value="">
			 				</div>
			 			</div>
			 		</form>
					
						<div id="img_container">
						</div>
					
			 	</div>
			 </div>
			 
			 <div id="right_container">
			 	<div id="menu_home_container">
		<ul id="home_menu">
			<li class="left_menu <?=($active==1) ? 'active' :null?>"><span>About us</span>
				<ul class="home_submenu">
					<li><a href="<?=base_url('about-us/history')?>">History</a></li>
					<li><a href="<?=base_url('about-us/aboutvigan')?>">About Vigan</a></li>
					<li><a href="<?=base_url('about-us/hotelcumgallery')?>">Hotel Cum Gallery</a></li>
					<li><a href="<?=base_url('about-us/pressroom')?>">Press Room</a></li>
				</ul>
			</li>
			<li class="left_menu <?=($active==2) ? 'active' :null?>"><span>Accommodation</span>
				<ul class="home_submenu">
					<li><a href="<?=base_url('accommodation/roomssuites')?>">Rooms & Suites</a></li>
					<li><a href="<?=base_url('accommodation/policy')?>">Hotel Policies</a></li>
					<li><a href="<?=base_url('accommodation/amenities')?>">Amenities & Services</a></li>
					<li><a href="<?=base_url('accommodation/tearoom')?>">Tea Room</a></li>
				</ul>
			</li>
			<li class="left_menu <?=($active==3) ? 'active' :null?>"><a href="<?=base_url('packages');?>">Packages</a>

			</li>
			<li class="space">&nbsp</li>
			<li class="right_menu <?=($active==4) ? 'active' :null?>" ><span>Things to do</span>
				<ul class="home_submenu">
					<li><a href="<?=base_url('things-to-do/activities')?>">Activities</a></li><br />
					<li><a href="<?=base_url('things-to-do/dining')?>">Dining</a></li><br />
					<li><a href="<?=base_url('things-to-do/shopping')?>">Shopping</a></li>
					<li><a href="<?=base_url('things-to-do/events')?>">Events</a></li>
				</ul>
			</li>
			<li class="right_menu  <?=($active==5) ? 'active' :null?>"><a href="<?=base_url('home/private-events')?>">Private Events</a></li>
			<li class="<?=($active==6) ? 'active' :null?>"><a href="<?=base_url('home/contact-us')?>">Contact us</a></li>
		</ul>
			 	</div>
			 	<div id="menu_line_left"></div>
			 	<div id="menu_line_right"></div>
			 	<div id="space"></div>

			 #######################################################-->


