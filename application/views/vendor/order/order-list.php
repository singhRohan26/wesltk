

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
						<h4 class="mb-0 font-size-18">Orders List</h4>
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
										<th>Order Id</th>
										<th>Name</th>
										<th>Sub total</th>
										<th>Status</th>
										<th>Assign to</th>
									</tr>
								</thead>


								<tbody>
									<?php
									if(!empty($orders)){
										$i =1;
										foreach($orders as $order){
											?>    
											<tr>
												<td><?php echo $i;?></td>
												<td># <?php echo $order['unique_id']; ?></td>
												<td><?php echo $order['name']; ?></td>
												<td>AED <?php echo $order['sub_total']; ?></td>
												<td><?php
                                                            if ($order['status'] == 'Completed' || $order['status'] == 'Cancelled') {
                                                                echo $order['status'];
                                                            } else { ?>

                                                                <?php echo form_dropdown(['name' => 'order_status', 'id' => 'order_status', 'class' => 'form-control change-order-status', 'data-url' => base_url('vendor/changeOrderStatus/' . $order['unique_id'])], ['Processing' => 'Processing', 'Cancelled' => 'Cancelled', 'Completed' => 'Completed'], $order['status']); ?>

                                                            <?php } ?>
                                                </td>
												<td>
												<div class="form-group"> 
                                                <div class="controls">
                                                    <select name="deivery" class="form-control"  style="width:100%;" id="deivery" data-url="<?php echo base_url('vendor/assignDeliveryBoy/'.$order['unique_id']) ?>">
                                                        <option value="">--ASSIGN TO--</option>
                                                        
                                                        <?php if(!empty($boys)) { foreach($boys as $boy){ 
                                                             ?>
                                                        <option value="<?php echo $boy['delivery_boy_id'] ?>" <?php if($boy['delivery_boy_id'] == $order['delivery_boy_id']) { echo 'selected'; } ?> ><?php if(!empty($boy['name'])){ echo $boy['name']; } ?></option>
                                                        <?php  } }else{ ?>
                                                             <option value="">No Delivery boy</option>
                                                       <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>
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




