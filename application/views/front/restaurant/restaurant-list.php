<!--restaurants banner code start-->
	<section class="restaurBanner  scrollTop boxs">
		<div class="bannerRest">
			<img src="<?php echo base_url('public/front/') ?>img/banner2.png" class="img-fluid" alt="banner">
		</div>
		<div class="restBanCont">
			<div class="container">
				<h2>386 Restaurants For Your Location</h2>
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
						<div class="radio">
							<input id="radio-1" name="radio" type="radio" checked>
							<label for="radio-1" class="radio-label active">American</label>
						</div>

						<div class="radio">
							<input id="radio-2" name="radio" type="radio">
							<label for="radio-2" class="radio-label">Bakery</label>
						</div>
						<div class="radio">
							<input id="radio-10" name="radio" type="radio">
							<label for="radio-10" class="radio-label">Bengali</label>
						</div>
						<div class="radio">
							<input id="radio-3" name="radio" type="radio">
							<label for="radio-3" class="radio-label">Beverages</label>
						</div>
						<div class="radio">
							<input id="radio-4" name="radio" type="radio">
							<label for="radio-4" class="radio-label">Biryani</label>
						</div>
						<div class="radio">
							<input id="radio-5" name="radio" type="radio">
							<label for="radio-5" class="radio-label">Cafe</label>
						</div>
						<div class="radio">
							<input id="radio-6" name="radio" type="radio">
							<label for="radio-6" class="radio-label">Chinese</label>
						</div>
						<div class="radio">
							<input id="radio-7" name="radio" type="radio">
							<label for="radio-7" class="radio-label">Desserts</label>
						</div>
						<div class="radio">
							<input id="radio-8" name="radio" type="radio">
							<label for="radio-8" class="radio-label">Fast Food</label>
						</div>
						<div class="radio">
							<input id="radio-9" name="radio" type="radio">
							<label for="radio-9" class="radio-label">Healthy Food</label>
						</div>
					</div>
				</div>
				<div class="restaurntRight boxs">
					<div>
					<div class="resturaRightHead">
						<div class="restHeadd">
							<h2>Restaurants <span>(386)</span></h2>
						</div>
						<div class="searchFood searchFood2">
							<input type="text" class="form-control" placeholder="Search for a food, product & services">
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
					<div class="menuDetail menu1 active">
						<ul>
                            <?php foreach($restaurants as $restaurant) {
                            $var = explode(',',$restaurant['category']);
                            if(in_array('food',$var)){ 
                            ?>
							<li>
								<div class="menuListImg">
									<img src="<?php echo base_url('uploads/vendor/'.$restaurant['image']) ?>" class="img-fluid" alt="list">
								</div>
								<div class="menuContent">
									<span>35 Mins.</span>
									<h2><?php echo $restaurant['name'] ?></h2>
									<p>North Indian, Mughlai, Seafood, Biryani, Desserts, Kebabs</p>
									<div class="quickView">
										<a href="<?php echo base_url('home/'.$restaurant['name'].'-details') ?>">Quick View</a>
									</div>
								</div>
							</li>
							<?php }   } ?>    	
							
						</ul>
					</div>
						
				</div>
			</div>
			</div>
		</div>

	</section>