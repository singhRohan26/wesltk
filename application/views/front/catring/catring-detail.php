
	<!--restaurant details code start-->
	<section class="restaurantDet scrollTop paddingAll   boxs">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="restImgs">
						<img src="<?php echo base_url('uploads/vendor/'.$restaurant['image']); ?>" class="img-fluid" alt="resturant">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="detailContent">
						<a href="#0" class="lacation"><span><img src="<?php echo base_url('public/front/');?>img/location.svg" class="img-fluid" alt="location"></span>Sector 16, Noida</a>
						<h2 class="new"><?php echo $restaurant['name'] ?></h2>
						<p>North Indian, Mughlai, Seafood, Biryani, Desserts, Kebabs</p>
						<div class="OrderDetail">
							<ul>
								<li>Minimum Order Amount :</li>
								<li>AED 150.00</li>
							</ul>
							<ul>
								<li>Working Hours Today :</li>
								<li>10.00 AM - 4.00 PM</li>
							</ul>
							<ul>
								<li>Delivery Time :</li>
								<li>120 Mins.</li>
							</ul>

						</div>
						<div class="orderBtn">
							<ul>
								<li><a href="#0"><span><img src="<?php echo base_url('public/front/');?>img/direction.svg" class="img-fluid" alt="direction"></span>Direction</a></li>
								<li><a href="shopingCart.html"><span><img src="<?php echo base_url('public/front/');?>img/book.svg" class="img-fluid" alt="direction"></span>Bookmark</a></li>
								<li><a href="#0" class="sharebtn"><span><img src="<?php echo base_url('public/front/');?>img/share.svg" class="img-fluid" alt="direction"></span>Share</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--restaurant details code end-->
	<!--	order review code start-->
	<section class="orderReview boxs">
		<div class="container">
			<div class="resturaRightHead resturaRightHead2">
				<div class="resturantMenu resturantMenu2 res_menu_type">
					<ul>
						<li><a href="#0" class="active" data-id='1' data-url="<?php echo base_url('home/catring-listing/'. $restaurant['vendor_id']);?>">Order Online</a></li>
						<li><a href="#0" data-id='2' data-url="<?php echo base_url('home/review-listing/'. $restaurant['vendor_id']);?>">Reviews</a></li>
						<li><a href="#0" data-id='3' data-url="<?php echo base_url('home/product-img/'. $restaurant['vendor_id'].'/'.$type='food');?>">Photos</a></li>
					</ul>
				</div>
				<div class="searchFood searchFood3 searchFood2">
					<input type="text" class="form-control serach-product" data-url="<?php echo base_url('home/catring-product/'. $restaurant['vendor_id']);?>" placeholder="Search for a food, product & services">
					<span><img src="<?php echo base_url('public/front/');?>img/search.svg" class="img-fluid" alt="search"> </span>
				</div>
			</div>
		</div>
	</section>
	<!--	order review code end-->

	<section class="resturantList paddingAll  boxs">
		<div class="container">
			<div class="resturentData resturentData2 active view1 boxs">
				<div class="resturantLeft resturantLeft2">
					
					<div class="restarLeft">
						<?php
							if(!empty($menus)){
								foreach ($menus as $menu) {
						?>
							<div class="radio restaurant_cat_type">
								<input id="radio-<?php echo $menu['id'];?>" value="<?php echo $menu['id'];?>" name="radio" type="checkbox">
								<label for="radio-<?php echo $menu['id'];?>" class="radio-label"><?php echo $menu['name'];?></label>
							</div>
						<?php
								}
							}
						?>
					</div>
				</div>
				
				<div class="restaurntRight restaurntRight2 view1 boxs">
					<div>
						<div class="menuDetail menuShow product-wrapper1" data-url="<?php echo base_url('home/salon-listing/'. $restaurant['vendor_id']);?>">
							
						</div>
					</div>
				</div>
			</div>
			<div class="resturentData resturentData2 view2">
				<div class="reviewAll product-wrapper2">
					
				</div>
			</div>
			<div class="resturentData resturentData2 view3">
				<ul class="customerIm customerIm2 product-wrapper3">
					
				</ul>
			</div>
		</div>

	</section>