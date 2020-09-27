

<section class="profileAll scrollTop boxs">
		<div class="container">
			<div class="profileIn boxs">
				<div class="profilrLeft">
					<div class="profileImgIn">
						<img src="<?php if(!empty($userData['image'])){ echo base_url('uploads/users/'. $userData['image']); }else{ echo base_url('public/front/img/default.png'); }?>" class="img-fluid" alt="img">
					</div>
					<div class="">
						<h2><?php echo $userData['name']; ?></h2>
						<p><span><?php echo $userData['email']; ?></span> | <span>+<?php echo $userData['phone']; ?></span></p>
					</div>
				</div>
				<div class="profilrright">
					<a href="#0" data-toggle="modal" data-target="#editModal"><span><img src="<?php echo base_url('public/front/')?>img/editwhite.svg" class="img-fluid" alt="edit"></span>Edit Profile</a>
				</div>
			</div>
		</div>
	</section>

	<section class="profileDetail paddingAll boxs">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="profileOrders">
						<ul>
							<li><a href="#0" class="active" data-id="1"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Orders</a></li>
							<li><a href="#0" data-id="2"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Notifications</a></li>
							<li><a href="#0" data-id="3"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Address</a></li>
							<li><a href="#0" data-id="4"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Change Password</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="profileAll12 profile1 active boxs">
                        <div class="orderHead">
									<h2>My Orders</h2>
								</div>
                        <?php
                    if(!empty($orderLists)){ 
//                        print_r($orderLists);die;
                        foreach($orderLists as $order){  ?>
						<div class="profileOrderDet">
							<div class="orderFirst">
								
								<div class="orderProcess">
									<ul>
										<li class="<?php if($order['status'] == 'Cancelled'){ echo 'cancel'; } elseif($order['status'] == 'Completed') { echo 'green'; } else { echo ''; } ?>"><span><img src="<?php echo base_url('public/front/')?>img/bluecheck.svg" class="img-fluid" alt="check"></span><?php echo $order['status']; ?></li>
										<li><?php echo date("F jS, Y", strtotime($order['created_at'])); ?></li>
										<li>Order Amount: $ <?php echo $order['sub_total']; ?></li>
										<li><a href="#0" class="showDrop"><img src="<?php echo base_url('public/front/')?>img/dropblue.svg" class="img-fluid" alt="dropdown"></a></li>
									</ul>
								</div>
								<div class="AllorderDetail">
									<div class="orderInner">
										<div class="addressHist">
											<h2><?php echo $order['user_name']; ?></h2>
											<p><?php echo $order['address']; ?> ,<?php echo $order['pincode']; ?></p>
										</div>
										<div class="addressHist">
											<h2>Payment Informtion</h2>
											<p class="paymentdone">Success</p>
										</div>
										<div class="addressHist">
											<h2>Order ID</h2>
											<p># <?php echo  $order['unique_id']; ?></p>
										</div>
                                        <?php if($order['status'] == 'Processing' || $order['status'] == 'Accepted' ){   ?>
                                        <div class="addressHist">
											<a href="<?php echo base_url('booking/cancelOrder/'.$order['unique_id']) ?>" class="delete-item"><h2 class="text-danger">Cancel order?</h2></a>

										</div>
                                        <?php } ?>
                                        
                                        <?php if($order['status'] == 'Completed'){   ?>
                                        <div class="addressHist">
											<a href="#" data-toggle="modal" data-target="#review<?php echo $order['unique_id'] ?>"><h2 class="text-warning">Add Review</h2></a>
                                            
                                            
        <div class="modal  ReviewModals fade" id="review<?php echo  $order['unique_id'] ?>" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
                <form method="post" action="<?php echo base_url('home/add-review') ?>" id="common-form">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Review and Rating</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput reviewAll boxs">
                                <div class="reviewAllnew">
                                    <ul class="rating_chk">
                                        <li ><a data-rating="1" href="#" class="fas fa-star"></a></li>
                                        <li><a data-rating="2" href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" data-rating="3" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star" data-rating="4"></a></li>
                                        <li><a href="#" class="fas fa-star"  data-rating="5"></a></li>
                                    </ul>
                                    
                                </div>
                                <div class="rateExp">
                                    <input type="hidden" name="rating" id="rating" value="">
                                    <p class="headingSize"> Rate Your Experience</p>
                                </div><br>
                                <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $order['vendor_id']; ?>">
                                <div class="form-group">
                                    <textarea class="form-control inputForm" rows="4" name="review" id="review" placeholder="What did you liked so much?"></textarea>
                                </div>
                                <div class="otpBtn">
                                    
                                    <div class="socialIconsM socialIconsM33 socialIconsM2">
								<ul>
									<li class="Btn"><button class="btncommon" type="submit">Add Review</button></li>
								</ul>
							</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>    
										</div>
                                        <?php } ?>
									</div>
                                    <?php foreach($order['details'] as $detail){  ?>
									<div class="orderInner2">
										<div class="foody">
											<img src="<?php echo base_url('uploads/product_image/'.$detail['image'])?>" class="img-fluid" alt="foody">
										</div>
                                        
										<div class="foodyContent">
											<h2><?php echo $detail['name']; ?></h2>
											<p><?php echo $detail['description']; ?></p>
											<ul class="quantity">
												<li>Quantity : <span><?php echo $detail['qty']; ?></span></li>
												<li><span>$ <?php echo $detail['price']; ?></span></li>
<!--												<li><a href="#0">Track Your Order</a></li>-->
											</ul>
										</div>
                                        
									</div>
                                    <?php } ?>
                                    
                                    
                                    
								</div>
							</div>
						</div>
						<?php } } else{ ?>
                        <center><p>No Orders Yet!</p></center>

                        
                        <?php } ?>
						
					</div>
					<div class="profileAll12 profile2 boxs">
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderHead order">
									<h2>Notifications</h2>
								</div>
<!--
								<div class="customerReview customerReview2">
									<div class="customerAl">
										<div class="customerProfile">
											<div class="profileImg">
												<img src="<?php echo base_url('public/front/')?>img/customer.png" class="img-fluid" alt="customer">
											</div>
											<div class="profileContent">
												<h2>Garima</h2>
												<div class="rating">
													<div class="ratingTime">
														<p>07/08/2020 | 25 Mins. ago</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<p class="revie">Mauris fames ut vitae blandit sagittis eget eget. Mi, leo varius leo est a turpis vitae neque. Luctus urna ipsum enim, quis ipsum amet in a ultricies. Sodales metus tincidunt vitae nunc dolor porttitor. Amet tristique in amet risus in nibh viverra aliquet. Dui maecenas risus sed eu blandit. Proin ultrices interdum sollicitudin volutpat.
									</p>

								</div>
-->
							<center><p>No Notifications Yet!</p></center>	
							</div>
						</div>
					</div>
					<div class="profileAll12 profile3 boxs">
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderHead ">
									<h2>Address</h2>
								</div>
								<div class="Adresses">
                                    <?php
                                            if(!empty($address)){ 
                                        foreach($address as $add) { ?>
									<div class="AddressLeft AddressLeft2">
										<div class="addressUp">
											<div class="editProp">
												<h2><?php echo $add['name'] ?></h2>
											</div>
											<p><?php echo $add['address'] ?>,<?php echo $add['city_id'] ?>,<?php echo $add['state_id'] ?> </p>
											<h3><?php echo $add['pincode'] ?></h3>
										</div>
										<ul class="adres">
											<li><a href="<?php echo base_url('booking/deleteAddress/'.$add['id']) ?>">Delete Address</a></li>
											<li><a href="#0" data-toggle="modal" data-target="#reviewModals<?php echo $add['id'] ?>">Edit</a></li>
										</ul>
									</div>
                                
                                    
<div class="modal  ReviewModals fade" id="reviewModals<?php echo $add['id'] ?>" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content" id="address_wrapper">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginRight loginRightreview">
						<form method="post" action="<?php echo base_url('booking/doEditAddress/'.$add['id']) ?>" id="common-form"> 
							<div class="forgetIn">
								<h2 class="">Add new address</h2>
							</div>
							<div class="reviewForm">
								<div class="form-group">
									<label class="labelel">Name</label>
									<input type="text" class="form-control inputcss" placeholder="Name" name="username" id="username" value="<?php echo $add['name'] ?>">
								</div>
<!--
								<div class="form-group">
									<label class="labelel">Contact number</label>
									<input type="number" class="form-control inputcss" placeholder="number">
								</div>
-->
								<div class="form-group">
									<label class="labelel">Address</label>
									<input type="text" class="form-control inputcss" placeholder="Address" id="address" name="address" value="<?php echo $add['address'] ?>">
								</div>
									<div class="form-group fifty">
									<label class="labelel">Pincode</label>
									<input type="number" class="form-control inputcss" placeholder="pincode" name="pincode" id="pincode" value="<?php echo $add['pincode'] ?>">
								</div>
									<div class="form-group fifty right">
									<label class="labelel">City</label>
									<input type="text" class="form-control inputcss" placeholder="city" name="city" id="city" value="<?php echo $add['city_id'] ?>">
								</div>
													<div class="form-group fifty">
									<label class="labelel">State</label>
									<input type="text" class="form-control inputcss" placeholder="state" name="state" id="state" value="<?php echo $add['state_id'] ?>">
								</div>
									<div class="form-group fifty right">
									<label class="labelel">Country</label>
									<input type="text" class="form-control inputcss" placeholder="country" name="country" id="country" value="<?php echo $add['country_id'] ?>">
								</div>
							
							</div>
							<div class="addressType">
								<h2 class="">Address type</h2>
								<ul>
									<li>Work</li>
									<li>Home</li>
									<li>Other</li>
								</ul>
							</div>
							<div class="socialIconsM socialIconsM33 socialIconsM2">
								<ul>
									<li class="Btn"><button type="submit" class="btncommon">Submit</button></li>
								</ul>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
                                    
                                    
                                    
                                    
									<?php } } else {   ?>
                                    <center><p>No Addresses Yet!</p></center>
                                    <?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="profileAll12 profile4 boxs">
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderHead ">
									<h2>Change Password</h2>
								</div>
								<?php
									$content = array('class' => 'common-form');
									echo form_open('user/change-password/', $content);
								?>
									<div class="error_msg"></div>
									<div class="passwordIn">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="labelel">Old Password</label>
													<input type="password" name="opass" id="opass" class="form-control inputcss" placeholder="xxx">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="labelel">New Password</label>
													<input type="password" name="npass" id="npass" class="form-control inputcss" placeholder="xxx">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="labelel">Confirm Password</label>
													<input type="password" name="cpass" id="cpass" class="form-control inputcss" placeholder="xxx">
												</div>
											</div>
										</div>
									</div>
									<div class="passwordUp">
										<button type="submit" class="btncommon">Save Password</button>
									</div>
								<?php
									echo form_close();
								?>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>