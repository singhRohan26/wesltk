<!--restaurants banner code start-->
	<section class="restaurBanner  scrollTop boxs">
		<div class="bannerRest">
			<img src="<?php echo base_url('public/front/') ?>img/banner2.png" class="img-fluid" alt="banner">
		</div>
		<div class="restBanCont">
			<div class="container">
				<h2>386 Salon For Your Location</h2>
			</div>
		</div>
	</section>
	<!--restaurants banner code end-->

	<section class="resturantList paddingAll  boxs">
		<div class="container">
			<div class="resturentData">
				<div class="resturantLeft">
					<div class="restarLeft">
						<h2>Cuisine</h2>
						<?php
							if(!empty(($menus))){
								$i= 1;
								foreach ($menus as $menu) {
						?>
							<div class="radio list-menu-res">
								<input id="radio-<?php echo $menu['id'];?>" value="<?php echo $menu['id'];?>" name="radio" type="checkbox" >
								<label for="radio-<?php echo $menu['id'];?>" class="radio-label active"><?php echo $menu['name'];?></label>
							</div>
						<?php
							$i++;
								}
							}
						?>
						
					</div>
				</div>
				<div class="restaurntRight boxs">
					<div>
					<div class="resturaRightHead">
						<div class="restHeadd">
							<h2>Catring <span>(386)</span></h2>
						</div>
						<div class="searchFood searchFood2">
							<input type="text" class="form-control search-restaurant" data-url="<?php echo base_url('home/search-catring');?>" placeholder="Search for a food, product & services">
							<span><img src="<?php echo base_url('public/front/') ?>img/search.svg" class="img-fluid" alt="search"> </span>
						</div>
					</div>
					<div class="resturantMenu">
						<ul>
							<li><a href="#0" class="active" data-id='1'>Popular</a></li>
							<li><a href="#0" data-id='2'>What’s New</a></li>
							<li><a href="#0"  data-id='3'>Near Me</a></li>
							<li><a href="#0" data-id='4'>Delivery Time</a></li>
							<li><a href="#0" data-id='5'>Price (High To Low)</a></li>
							<li><a href="#0" data-id='6'>Price ( Low To High)</a></li>
						</ul>
					</div>
					
					<div class="menuDetail menu1 active restaurant-wrapper" data-url="<?php echo base_url('home/catringWrapper');?>">
						
					</div>
						
				</div>
			</div>
			</div>
		</div>

	</section>