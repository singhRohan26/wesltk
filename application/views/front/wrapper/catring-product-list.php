<ul class="menuDetailnew menuDetailnew2">
	<?php
		if(!empty($products)){
			foreach ($products as $product) {
	?>
	<li>
		<div class="menuListImg menuListImg2">
			<img src="<?php echo base_url('uploads/product_image/'.$product['image']);?>" class="img-fluid" alt="list">
		</div>
		<div class="menuContent menuContent2">
			<h2><?php echo $product['name'];?></h2>
			<p><?php echo $product['description'];?>	 <a href="<?php echo base_url('catring-detail/'. $product['id']);?>" class="readMore">Read More</a></p> 
			<h2 class="price">$<?php echo $product['price'];?></h2>

			<div class="addProduct">
				<div class="vaulebox">
					<a href="<?php echo base_url('catring-detail/'. $product['id']);?>" class="productAdd productAddbook">Book Now</a>
				</div>
			</div>

		</div>
	</li>

<?php
	}
}
?>
</ul>


