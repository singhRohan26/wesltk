<ul class="menuDetailnew menuDetailnew2">
	<?php
		if(!empty($products)){
			foreach ($products as $product) {
//                print_r($product);die;
	?>
		<li>
			<div class="menuListImg menuListImg2">
				<img src="<?php echo base_url('uploads/product_image/'.$product['image']);?>" class="img-fluid" alt="list">
			</div>
			<div class="menuContent menuContent2">
				<h2><?php echo $product['name'];?><span class="foodType">
					
				</span></h2>
				<p><?php echo $product['description'];?></p>
				<h2 class="price">$<?php echo $product['price'];?></h2>

				<div class="addProduct">
					<div class="vaulebox">
						<button type="button" class="minus_btn">-</button>
						<input type="text" value="0" class="qty">
						<p class="productAdd" data-url="<?php echo base_url('addToCart/'.$product['id']);?>">Add to Cart</p>
						<button type="button" class="plus_btn">+</button>
					</div>
				</div>

			</div>
		</li>
	<?php
			}
		}else{
	?>
		<h2>No Product Found!!..</h2>
	<?php		
		}
	?>
</ul>