

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
						<h4 class="mb-0 font-size-18">Service Menu</h4>
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/add-service-product');?>">Add Product</a></li>
						</ol>
					</div>
				</div>
			</div>     
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">

							<table id="datatable" class="table table-bordered dt-responsive nowrap" >
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Menu Name</th>
										<th>Item Name</th>
										<th>Item Price</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>


								<tbody>
									<?php
									if(!empty($products)){
										$i =1;
										foreach($products as $category){
											?>    
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $category['menu_name']; ?></td>
												<td><?php echo $category['product_name']; ?></td>
												<td><?php echo $category['price']; ?></td>
												<td><?php echo $category['status']; ?></td>
												<td>
													<a href="<?php echo base_url('vendor/edit-service-catring-product/'. $category['id']);?>" data-toggle="tooltip" title="Edit Menu"><i class="fa fa-edit"></i></a>&emsp;
													<a href="<?php echo base_url('vendor/delete-service-product/'. $category['id']);?>" data-toggle="tooltip" title="Delete Menu" class="delete-item"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
											<?php
											$i++;
										}
									}
									?>
								</tbody>
							</table>

						</div>
					</div>
				</div> <!-- end col -->

			</div> <!-- end row -->


		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->




