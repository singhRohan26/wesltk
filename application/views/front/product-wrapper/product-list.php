<ul>
	<?php 
		if(!empty($products)){
			foreach($products as $restaurant) {
			$var = explode(',',$restaurant['category']);
			if(in_array('product',$var)){ 
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
						<a href="<?php echo base_url('shop-details/'.str_replace(' ','-',$restaurant['name']));?>">Quick View</a>
					</div>
				</div>
			</li>
		<?php } }  } else{
		?>
			<h2>No Shops Found!!..</h2>
		<?php
			}
		?>    	

	</ul>