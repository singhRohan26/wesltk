<!--	shoping cart code start-->
<form method="post" action="<?php echo base_url('booking/test'); ?>" id="stripe_form">
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
							 
							<div class="reviewForm">
								<div class="formFill">
							<div class="form-group fifty">
								<label class="labelel">Full Name</label>
								<input type="text" class="form-control inputcss" name="full_name_ser" id="full_name_ser" placeholder="Full Name">
							</div>
							<div class="form-group fifty right">
								<label class="labelel">Email Address</label>
								<input type="email" class="form-control inputcss" name="email_sir" id="email_sir" placeholder="Email">
							</div>
							<div class="form-group fifty">
								<label class="labelel">Phone No.</label>
								<input type="number" class="form-control inputcss" name="phone_no_ser" id="phone_no_ser" placeholder="Phone No.">
							</div>
							<div class="form-group fifty right">
								<label class="labelel">Date</label>
								<input type="date" class="form-control inputcss" name="date_ser" id="date_ser" placeholder="Date">
							</div>
							<div class="form-group">
								<label class="labelel">Time</label>
								<input type="time" class="form-control inputcss" name="time_ser" id="time_ser" placeholder="2:30 pm">
							</div>
							<div class="form-group">
								<label class="labelel">Address</label>
								<input type="text" class="form-control inputcss" placeholder="Address" id="address" name="address" >
							</div>
							<div class="form-group fifty">
									<label class="labelel">Pincode</label>
									<input type="number" class="form-control inputcss" placeholder="pincode" name="pincode" id="pincode" >
							</div>
							<div class="form-group fifty right">
								<label class="labelel">City</label>
								<input type="text" class="form-control inputcss" placeholder="city" name="city" id="city" >
							</div>
							<div class="form-group fifty">
								<label class="labelel">State</label>
								<input type="text" class="form-control inputcss" placeholder="state" name="state" id="state" >
							</div>
							<div class="form-group fifty right">
									<label class="labelel">Country</label>
									<input type="text" class="form-control inputcss" placeholder="country" name="country" id="country" >
								</div>
							
							</div>
							</div>
							<div class="socialIconsM socialIconsM33 socialIconsM2">
								<ul>
									<li class="Btn"><button type="submit" class="btncommon">Submit</button></li>
								</ul>
							</div>

						
							
							</div>
						</div>
				<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Select Payment Method</h2>
							<div class="paymentMethod">
								<div class="payment-status text-danger"></div>
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
													<input type="number" name="acc" id="acc" class="form-control inputcss" placeholder="Card No.">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Card Holder Name</label>
													<input type="text" name="holder_name" id="holder_name" class="form-control inputcss" placeholder="Card Holder Name">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Expiry Year</label>
													<input type="number" name="exp_date" id="exp_date" class="form-control inputcss" placeholder="Expiry date">
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">Expiry Month</label>
													<input type="number" name="exp_month" id="exp_month" class="form-control inputcss" placeholder="Expiry date">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="accountDel">
												<div class="form-group">
													<label class="labelel">CVV</label>
													<input type="number" name="cvv" id="cvv" class="form-control inputcss" placeholder="xxx">
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
									<li class="Btn"><button type="submit" class="btncommon prcd_buy" data-url="<?php echo base_url('booking/order');?>">Submit</button></li>
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