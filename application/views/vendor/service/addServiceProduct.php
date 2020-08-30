

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

	<div class="page-content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box d-flex align-items-center justify-content-between">
						<h4 class="mb-0 font-size-18">Service Product</h4>
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/service-product');?>">Back</a></li>
						</ol>
					</div>
				</div>
			</div>     
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="error_msg"></div>
							<?php 
							$content = array('id' => 'common-image-form', 'role' => "form");
							if(!empty($product)){
								echo form_open_multipart('vendor/doEditServiceProduct/'.$product['id'], $content);
							}else{
								echo form_open_multipart('vendor/doAddServiceProduct', $content);
							}
							?>
							<div class="row">
                                <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Choose Service Category</h5>
										<select class="form-control" id="admin_menu" name="admin_menu">
											<option value="">-- Choose Restaurant Category --</option>
											<?php
												if(!empty($category)){
													foreach ($category as $cat) {
											?>
											<option <?php if(!empty($product)) { if($product['admin_menu_id'] == $cat['id']){ echo "selected";} }?> value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
											<?php
													}
												}
											?>

										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Choose Your Category</h5>
										<select class="form-control" id="menu" name="menu">
											<option value="">-- Select Menu --</option>
											<?php
												if(!empty($menus)){
													foreach ($menus as $menu) {
											?>
											<option <?php if(!empty($product)) { if($product['menu_id'] == $menu['id']){ echo "selected";} }?> value="<?php echo $menu['id'];?>"><?php echo $menu['name'];?></option>
											<?php
													}
												}
											?>

										</select>
									</div>
								</div>
								
							</div>
							<div class="row">
                                <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Name</h5>
										<input class="form-control" value="<?php if(!empty($product)) { echo $product['product_name']; }?>" type="text" name="name" id="name" placeholder="Product Name....">
									</div>
								</div>
                                
                                
								<div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Price</h5>
										<input class="form-control" value="<?php if(!empty($product)) { echo $product['price']; }?>" type="text" name="price" id="price" placeholder="price....">
									</div>
								</div>
								
							</div>
							<div class="row">
                                <div class="col-sm-12">
									<div class="form-group">
										<h5 class="font-size-14">Status</h5>
										<select class="form-control" id="status" name="status">
											<option value="">-- Select Status --</option>
											<option <?php if(!empty($product)) { if($product['status'] == "Active"){ echo "selected";} }?> value="Active">Active</option>
											<option <?php if(!empty($product)) { if($product['status'] == "Inactive"){ echo "selected";} }?> value="Inactive">Inactive</option>

										</select>
									</div>
								</div>
                                
                                <!-- <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Choose Food type</h5>
										<select class="form-control" id="food_type" name="food_type">
											<option value="">-- Choose Food type --</option>
											<option <?php if(!empty($product)) { if($product['product_type'] == "Veg"){ echo "selected";} }?> value="Active">Veg</option>
											<option <?php if(!empty($product)) { if($product['product_type'] == "Non-veg"){ echo "selected";} }?> value="Non-veg">Non-veg</option>

										</select>
									</div>
								</div> -->
                                
								<div class="col-sm-12">
									<div class="form-group">
										<h5 class="font-size-14">Description</h5>
										<textarea class="form-control" name="description" id="description" placeholder="description...."><?php if(!empty($product)) { echo $product['description']; }?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<h5 class="font-size-14">Image</h5>
										<?php
											if(!empty($product_image)){
												foreach ($product_image as $image) {
										?>
											<a class="text-danger delete-item" href="<?php echo base_url('vendor/delete-service-product-image/'. $image['id']);?>"><i class="fa fa-trash"></i></a>
											<img src="<?php echo base_url('uploads/product_image/'. $image['image']);?>" style="height: 100px; width: 100px;">
										<?php
												}
											}
										?>
										<input type="file" name="image_url[]" id="image_url" multiple="" class="form-control">
									</div>
								</div>
							</div>


							<button class="btn btn-primary">Submit</button>
							<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div> <!-- end col -->

		</div> <!-- end row -->


	</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->




