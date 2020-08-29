<ul class="menuDetailnew menuDetailnew2">
	<?php
		if(!empty($products)){
			foreach ($products as $product) {
	?>
		<li>
			<div class="menuListImg menuListImg2">
				<img src="<?php echo base_url('public/front/');?>img/list1.png" class="img-fluid" alt="list">
			</div>
			<div class="menuContent menuContent2">
				<h2><?php echo $product['name'];?><span class="foodType">
					<?php
						if($product['product_type'] == "Veg"){
					?>
						<img src="<?php echo base_url('public/front/');?>img/veg.svg" class="img-fluid" alt="veg">
					<?php
						}else if($product['product_type'] == "Non-veg"){
					?>
						<img src="<?php echo base_url('public/front/');?>img/nonveg.svg" class="img-fluid" alt="veg">
					<?php
						}
					?>
				</span></h2>
				<p><?php echo $product['description'];?></p>
				<h2 class="price">$<?php echo $product['price'];?></h2>
                
                
                
                <?php
						$product_cart = "";
						$qty = 0;
						if(!empty($this->cart->contents())) {
            				foreach($this->cart->contents() as $cart){
            					if($product['id'] == $cart['id']){
            						$qty = $cart['qty'];
            						$product_cart = $product['id'];
            					}
            				}
            			}
			?>
<!--				<div class="productAdd">-->
					<div class="addProduct">
						<div class="vaulebox">
							<button type="button" class="minus_btn" <?php if(!empty($product_cart)){ ?> style="display: block;" <?php } ?>>-</button>
							<input readonly="" type="text" value="<?php echo $qty; ?>" class="qty" <?php if(!empty($product_cart)){ ?> style="display: block;" <?php } ?>>
							<p class="productAdd pr_add_chk" data-url="<?php echo base_url('addToCart/'. $product['id']);?>" <?php if(!empty($product_cart)){ ?> style="display: none;" <?php } ?>>Add to cart</p>
							<button type="button" class="plus_btn" <?php if(!empty($product_cart)){ ?> style="display: block;" <?php } ?>>+</button>
						</div>
					</div>
<!--				</div>-->
                
                
                
<!--
				<div class="addProduct">
					<div class="vaulebox">
						<button type="button" class="minus_btn">-</button>
						<input type="text" value="0" class="qty">
						<p class="productAdd"  data-url="<?php echo base_url('addToCart/'.$product['id']);?>">Add to Cart</p>
						<button type="button" class="plus_btn">+</button>
					</div>
				</div>
-->

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