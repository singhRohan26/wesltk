

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
						<h4 class="mb-0 font-size-18">Add Delivery Boy</h4>
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/product-lists');?>">Back</a></li>
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
							if(!empty($delivery)){
								echo form_open_multipart('vendor/doEditDeliveryBoy/'.$delivery['delivery_boy_id'], $content);
							}else{
								echo form_open_multipart('vendor/doAddDeliveryBoy', $content);
							}
							?>
							
							<div class="row">
                                <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Name</h5>
										<input class="form-control" value="<?php if(!empty($delivery)) { echo $delivery['name']; }?>" type="text" name="name" id="name" placeholder="Delivery Boy Name....">
									</div>
								</div>
                                
                                
								<div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Email</h5>
										<input class="form-control" value="<?php if(!empty($delivery)) { echo $delivery['email']; }?>" type="text" name="email" id="email" placeholder="Email....">
									</div>
								</div>
								
							</div>
							<div class="row">
                                
                                <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Phone</h5>
										<input class="form-control" value="<?php if(!empty($delivery)) { echo $delivery['phone']; }?>" type="text" name="phone" id="phone" placeholder="Phone....">
									</div>
								</div>
                                
                                <div class="col-sm-6">
									<div class="form-group">
										<h5 class="font-size-14">Status</h5>
										<select class="form-control" id="status" name="status">
											<option value="">-- Select Status --</option>
											<option <?php if(!empty($product)) { if($delivery['status'] == "Active"){ echo "selected";} }?> value="Active">Active</option>
											<option <?php if(!empty($product)) { if($delivery['status'] == "Inactive"){ echo "selected";} }?> value="Inactive">Inactive</option>

										</select>
									</div>
								</div>
                                
                                
                                
								<div class="col-sm-12">
									<div class="form-group">
										<h5 class="font-size-14">Password</h5>
										<input class="form-control" value="<?php if(!empty($delivery)) { echo $delivery['password']; }?>" type="password" name="pass" id="pass" placeholder="Password....">
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




