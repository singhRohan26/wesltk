<ul>
	<?php 
		if(!empty($restaurants)){
			foreach($restaurants as $restaurant) {
			$var = explode(',',$restaurant['category']);
			if(in_array('service',$var)){ 
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
						<a href="<?php echo base_url('salon-details/'.str_replace(' ','-',$restaurant['name']));?>">Quick View</a>
					</div>
				</div>
			</li>
		<?php } }  } else{
		?>
			<h2>No saloon Found!!..</h2>
		<?php
			}
		?>    	

	</ul>