

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
						<h4 class="mb-0 font-size-18">Delivery Boys List</h4>
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url('vendor/add-delivery-boy');?>">Add Delivery Boy</a></li>
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
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>


								<tbody>
									<?php
									if(!empty($boys)){
										$i =1;
										foreach($boys as $boy){
											?>    
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $boy['name']; ?></td>
												<td><?php echo $boy['email']; ?></td>
												<td><?php echo $boy['phone']; ?></td>
												<td><?php echo $boy['status']; ?></td>
												<td>
													<a href="<?php echo base_url('vendor/edit-delivery-boy/'. $boy['delivery_boy_id']);?>" data-toggle="tooltip" title="Edit user" class=""><i class="fa fa-edit"></i></a>
                                                    
													<a href="<?php echo base_url('vendor/delete-boy/'. $boy['delivery_boy_id']);?>" data-toggle="tooltip" title="Delete User" class="delete-item"><i class="fa fa-trash"></i></a>
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




