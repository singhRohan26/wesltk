<?php 
//print_r($this->cart->contents());die;
if(!empty($this->cart->contents())) {  ?>	
<div class="col-sm-9">
					<div class="shopCartInHead">
						<h2>Product Description</h2>
						<h2>Price</h2>
					</div>
					<div class="shopCartIn">
                        
                        <?php foreach($this->cart->contents() as $cart) { ?>
						<div class="shopCartInAl">
							<div class="shopingDet">
								<div class="shopinImg">
									<img src="<?php echo base_url('uploads/product_image/'.$cart['image']) ?>" class="img-fluid" alt="shop">
								</div>
								<div class="shopContent">
									<h2><?php echo $cart['product_name'] ?></h2>
									<p>North Indian, Mughlai, Seafood, Biryani</p>
									<div class="productDet">
										<div class="addProduct addProduct2">
											<div class="vaulebox">
												<button type="button" class="minus_btn">-</button>
												<input type="text" value="<?php echo $cart['qty'] ?>" class="qty">
												<p class="productAdd" data-url="<?php echo base_url('addToCart/'. $cart['id']);?> ">Add to Cart</p>
												<button type="button" class="plus_btn">+</button>
											</div>
										</div>
										<a href="<?php echo base_url('home/remove-cart/'.$cart['rowid']) ?>"> X Remove</a>
									</div>
								</div>
							</div>
							<div class="priceAl">
								<h2>$ <?php echo $cart['price']; ?></h2>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="procedTo boxs">
						<div class="procedTotal boxs">
							<h2>Subtotal (<?php echo count($this->cart->contents()) ?> items) : </h2>
							<h3>$<?php echo $this->cart->total(); ?></h3>
						</div>
						<div class="priceedBtn boxs">
							<a href="<?php echo base_url('checkout/') ?>" >Proceed to Buy</a>
						</div>
					</div>
				</div>
<?php } else{   ?>
<div style="text-align:center">
<img src="<?php echo base_url('public/front/img/emptycart.png') ?>">
<p>No items in the cart!</p>
</div>
<?php } ?>