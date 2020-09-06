<!--restaurants banner code start-->
	<section class="restaurBanner  scrollTop boxs">
		<div class="bannerRest">
			<img src="<?php echo base_url('public/front/');?>img/banner2.png" class="img-fluid" alt="banner" style="width: 100%;">
		</div>
		<div class="restBanCont">
			<div class="container">
				<h2><?php echo strip_tags($about_data['heading']);?></h2>
			</div>
		</div>
	</section>
	<!--restaurants banner code end-->

	<section class="aboutU boxs">
		<div class="container">
			<div class="aboutIn boxs">
				<h2><?php echo $about_data['heading'];?></h2>
				<?php echo $about_data['message'];?>
				
			</div>
		</div>
	</section>
	
	<section class="exploreBuss exploreBuss2  paddingAll boxs">
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
											<img src="<?php echo base_url('public/front/');?>img/foods.svg" class="img-fluid" alt="food">
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
											<img src="<?php echo base_url('public/front/');?>img/services.svg" class="img-fluid" alt="food">
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
											<img src="<?php echo base_url('public/front/');?>img/foods.svg" class="img-fluid" alt="food">
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
