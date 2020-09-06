

	<!--   banner code start-->
	<section class="bannerHome paddingAll boxs">
		<div class="bannerInner boxs">
	<div class="banerImgg">
		<img src="<?php echo base_url('public/front/') ?>img/banner.png" class="img-fluid" alt="banner">
			</div>
			<div class="bannerAbso">
			<div class="container">
				<div class="bannerHead">
					<div class="logoDiv">
						<a href="<?php echo base_url('home') ?>"><img src="<?php echo base_url('public/front/') ?>img/logo.svg" class="img-fluid" alt="logo"></a>
					</div>
					<div class="middleMenu">
						<ul>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#become_partner">Become a Partner</a></li>
							<li><a href="#0">Offers</a></li>
							<li><a href="#0">Services <span><img src="<?php echo base_url('public/front/') ?>img/dropdown2.svg" class="img-fluid" alt="dropdown"></span></a></li>
							<li><a href="#0">Shop <span><img src="<?php echo base_url('public/front/') ?>img/dropdown2.svg" class="img-fluid" alt="dropdown"></span></a></li>
						</ul>
					</div>
					<div class="loginCart">
						<ul>
							<li><a href="<?php echo base_url('home/your-cart') ?>"><img src="<?php echo base_url('public/front/') ?>img/cart.svg" class="img-fluid" alt="cart"></a><span class="badge"><?php echo count($this->cart->contents()); ?></span></li>
                            <?php if(!empty($this->session->userdata('login_id'))) {   ?>
                            <li class="nav-item urserShow"><a class="nav-link afterloginBtn" href="#0"><span></span><?php echo $userData['name'] ?>
									</a>
									<div class="profileChanges">
										<ul>
											<li><a href="<?php echo base_url('user/user-profile') ?>">Profile</a></li>
											<li><a href="profile.html">Notification</a></li>
											<li><a href="profile.html">Orders</a></li>
											<li><a href="profile.html">Address</a></li>
											<li><a href="<?php echo base_url('user/logout') ?>">Logout</a></li>
										</ul>
									</div>
								</li>
                            <?php }else{   ?>
                            <li><a href="#0" class="loginPop" data-toggle="modal" data-target="#loginModal">Login</a></li>     
                            <?php } ?>
						</ul>
					</div>
				</div>
				<div class="bannerContent">
					<h2 class="heading">Order your favourite foods</h2>
					<div class="cityAll1">
						<div class="cityDrop">
							<select id="mounth">
								<option>Noida</option>
								<option rel="icon-temperature">Meerut</option>
								<option>Delhi</option>
								<option>Goa</option>
							</select>
						</div>
						<div class="searchFood">
							<input type="text" class="form-control" placeholder="Search for a food, product & services">
							<span><img src="<?php echo base_url('public/front/') ?>img/search.svg" class="img-fluid" alt="search"> </span>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</section>
	<!--   banner code end-->

	<!--	counter code start-->
	<section class="counterAll paddingAll boxs">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="counterIn">
						<h2 class="subHeading"><span class="counter">2891</span></h2>
						<p class="headingSize">Restuarent</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="counterIn">
						<h2 class="subHeading member"><span class="counter">129876</span></h2>
						<p class="headingSize">Member</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="counterIn">
						<h2 class="subHeading food"><span class="counter">95634</span></h2>
						<p class="headingSize">Food</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="counterIn">
						<h2 class="subHeading order"><span class="counter">1735667</span></h2>
						<p class="headingSize">Order</p>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!--	counter code end-->

	<!--Explore Our Business code start-->
	<section class="exploreBuss paddingAll boxs">
		<div class="container">
			<div class="exploreIn boxs">
				<h2 class="headingSize">Explore Our Business</h2>
				<div class="exporeService">
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo base_url('home/restaurant-lists') ?>" class="foodAllservice boxs">
								<div class="exploreFood">

									<div class="foodImg">
										<span>
											<img src="<?php echo base_url('public/front/') ?>img/foods.svg" class="img-fluid" alt="food">
										</span>
									</div>
									<div class="exploreContent">
										<h2 class="mainHeading">Foods</h2>
										<p class="subHeading">Tousled food truck polaroid,<br> salvia bespoke small batch<br> Pinterest Marfa.</p>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-4">
							<a href="<?php echo base_url('salon');?>" class="foodAllservice boxs">
								<div class="exploreFood">

									<div class="foodImg">
										<span>
											<img src="<?php echo base_url('public/front/') ?>img/services.svg" class="img-fluid" alt="food">
										</span>
									</div>
									<div class="exploreContent">
										<h2 class="mainHeading">Services</h2>
										<p class="subHeading">Tousled food truck polaroid,<br> salvia bespoke small batch<br> Pinterest Marfa.</p>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-4">
							<a href="<?php echo base_url('home/products-shops') ?>" class="foodAllservice boxs">
								<div class="exploreFood">

									<div class="foodImg">
										<span>
											<img src="<?php echo base_url('public/front/') ?>img/products.svg" class="img-fluid" alt="food">
										</span>
									</div>
									<div class="exploreContent">
										<h2 class="mainHeading">Products</h2>
										<p class="subHeading">Tousled food truck polaroid,<br> salvia bespoke small batch<br> Pinterest Marfa.</p>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Explore Our Business code end-->

	<!--	Explore Our Menu code start-->
	<section class="exploreMenu paddingAll boxs">
		<div class="container">
			<div class="menuHead">
				<h2 class="headingSize">Explore Our Menu</h2>
				<p>Fresh & Local</p>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="exploreFirst">
						<div class="menuImg">
							<img src="<?php echo base_url('public/front/') ?>img/menu1.png" class="img-fluid" alt="menu">
						</div>
						<div class="menuName">
							<a href="restaurantslist.html">Launch <span><img src="<?php echo base_url('public/front/') ?>img/dropdown.svg" class="img-fluid" alt="drop"></span></a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="exploreFirst">
						<div class="menuImg">
							<img src="<?php echo base_url('public/front/') ?>img/menu2.png" class="img-fluid" alt="menu">
						</div>
						<div class="menuName">
							<a href="restaurantslist.html">Dinner <span><img src="<?php echo base_url('public/front/') ?>img/dropdown.svg" class="img-fluid" alt="drop"></span></a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="exploreFirst">
						<div class="menuImg">
							<img src="<?php echo base_url('public/front/') ?>img/menu3.png" class="img-fluid" alt="menu">
						</div>
						<div class="menuName">
							<a href="restaurantslist.html">Cattering <span><img src="<?php echo base_url('public/front/') ?>img/dropdown.svg" class="img-fluid" alt="drop"></span></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!--	Sed senectus euismod aliqu arcu tortor adipiscing. code start-->
	<section class="AppStore paddingAll boxs">
		<div class="appImg">
			<img src="<?php echo base_url('public/front/') ?>img/appback.png" class="img-fluid" alt="aapback">
		</div>
		<div class="appContent boxs">
			<div class="container">
				<h2 class="App">Get Our beautiful app</h2>
				<h3 class="headingSize">Sed senectus euismod aliqu <br>arcu tortor adipiscing. </h3>
				<ul>
					<li><a href="#0"><img src="<?php echo base_url('public/front/') ?>img/google.png" class="img-fluid" alt="google"></a></li>
					<li><a href="#0"><img src="<?php echo base_url('public/front/') ?>img/appstore.png" class="img-fluid" alt="google"></a></li>
				</ul>
			</div>
		</div>

	</section>
	<!--	Sed senectus euismod aliqu arcu tortor adipiscing. code end-->

	<!--	join us code start-->
	<section class="joinUs paddingAll boxs">
		<div class="joinUsHead">
			<h2 class="headingSize">Join Us</h2>
			<p>Do a part of the story</p>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="joinUsImg">
						<img src="<?php echo base_url('public/front/') ?>img/partner.svg" class="img-fluid" alt="partner">
					</div>
					<div class="joinContent">
						<h2>Become a Partner</h2>
						<p>Kogi Cosby sweater ethical squid irony disrupt, organic tote bag gluten<br> free XOXO wolf typewriter mixtape.</p>
						<a href="#0" class="btncommon" data-toggle="modal" data-target="#become_partner">Find Out More</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="joinUsImg">
						<img src="<?php echo base_url('public/front/') ?>img/career.svg" class="img-fluid" alt="partner">
					</div>
					<div class="joinContent">
						<h2>Build your career</h2>
						<p>Kogi Cosby sweater ethical squid irony disrupt, organic tote bag gluten<br> free XOXO wolf typewriter mixtape.</p>
						<a href="<?php echo base_url('home/career') ?>" class="btncommon">Find Jobs</a>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!--	join us code end-->

	