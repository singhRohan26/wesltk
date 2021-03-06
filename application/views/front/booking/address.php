<!--	shoping cart code start-->
<form method="post" action="<?php echo base_url('booking/order') ?>">
	<section class="shopingCart scrollTop paddingAll boxs">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="checkoutAll checkoutAllnew">
						<div class="checkLogin">
							<h2 class="mainHeading">Logged In<span><img src="<?php echo base_url('public/front/') ?>img/click.svg" class="img-fluid" alt="click"></span></h2>
							<p><span><?php echo $userData['name']; ?></span> | <span> <?php echo $userData['email']; ?> </span> | <span> <?php echo $userData['phone']; ?></span></p>
						</div>
					</div>
					<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Delivery Address</h2>
							<div class="Adresses">
                                
                                <?php 
                                	$sr = 1;
                                	foreach($address as $add){  
                            	?>
								<div class="AddressLeft <?php if($sr % 2 == 0){ echo "AddressRight";}?>">
									<div class="addressUp">
										<div class="editProp">
											<h2><?php echo $add['name']; ?></h2>
											<a href="#0"><img src="<?php echo base_url('public/front/') ?>img/edit.svg" class="img-fluid" alt="edit" data-toggle="modal" data-target="#reviewModals<?php echo $add['id'] ?>"></a>
										</div>
										<p><?php echo $add['address'] ?>,<?php echo $add['pincode'] ?></p>
                                        <p><?php echo $add['city_id'] ?>,<?php echo $add['country_id'] ?></p>
										<h3>39 mins.</h3>
									</div>
									<ul class="adres">
										<li><a href="#0">Delete Address</a></li>
										<li><a href="#0">Delivery here  <input type="radio" name="address_id" id="address_id" value="<?php echo $add['id'] ?>"></a></li>
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
                                
                                
                                <?php $sr++; } ?>
								<div class="AddressLeft AddressRight">
									<div class="addressUp">
										<div class="editProp">
											<h2>Add New Address</h2>
										</div>
										<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
									</div>
									<ul class="adres">
										<li><a href="#0" data-toggle="modal" data-target="#reviewModals">Add New Address</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Select Payment Method</h2>
							<div class="paymentMethod">
								<div class="radio radio2">
									<input id="radion1" name="card_type" type="radio" value="card">
									<label for="radion1" class="radio-label active">Credit Card/Debit Card<span><img src="<?php echo base_url('public/front/') ?>img/dropdown.svg" class="img-fluid" alt="drop"></span></label>
								</div>
								<div class="accountDetail">
									<div class="row">
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Card Number</label>
													<input type="number" class="form-control inputcss" placeholder="Card No.">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Card Holder Name</label>
													<input type="text" class="form-control inputcss" placeholder="Card Holder Name">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Expiry date</label>
													<input type="number" class="form-control inputcss" placeholder="Expiry date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">CVV</label>
													<input type="number" class="form-control inputcss" placeholder="xxx">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="paymentMethod">
								<div class="radio radio2">
									<input id="radion2" name="card_type" type="radio" value="net">
									<label for="radion2" class="radio-label ">Net Banking<span><img src="<?php echo base_url('public/front/') ?>img/dropdown.svg" class="img-fluid" alt="drop"></span></label>
								</div>
								<div class="accountDetail">
									<div class="row">
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Card Number</label>
													<input type="number" class="form-control inputcss" placeholder="Card No.">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Card Holder Name</label>
													<input type="text" class="form-control inputcss" placeholder="Card Holder Name">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Expiry date</label>
													<input type="number" class="form-control inputcss" placeholder="Expiry date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">CVV</label>
													<input type="number" class="form-control inputcss" placeholder="xxx">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            
                            <div class="paymentMethod">
								<div class="radio radio2">
									<input id="radion3" name="card_type" type="radio" value="cod">
									<label for="radion3" class="radio-label ">Cash on delivery</label>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="procedTo boxs">
						<div class="procedTotal boxs">
							<h2>Subtotal (<?php echo count($this->cart->contents()); ?> items) : </h2>
							<h3>$<?php echo $this->cart->total(); ?></h3>
						</div>
						<div class="priceedBtn boxs">
<!--							<a href="">Continue</a>-->
                            <div class="socialIconsM socialIconsM33 socialIconsM2">
								<ul>
									<li class="Btn"><button type="submit" class="btncommon prcd_buy prcd_buy_ck" data-url="<?php echo base_url('booking/order');?>">Submit</button></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <input type="hidden" name="total" id="total" value="<?php echo $this->cart->total(); ?>">
</form>