<?php
	if(!empty($product_images)){
		foreach ($product_images as $product_image) {
?>
<li><img src="<?php echo base_url('uploads/product_image/'.$product_image['image']);?>" class="img-fluid" alt="img"></li>
<?php
		}
	}
?>