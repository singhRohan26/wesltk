

<section class="profileAll scrollTop boxs">
		<div class="container">
			<div class="profileIn boxs">
				<div class="profilrLeft">
					<div class="profileImgIn">
						<img src="img/deepu.jpg" class="img-fluid" alt="img">
					</div>
					<div class="">
						<h2><?php echo $userData['name']; ?></h2>
						<p><span><?php echo $userData['email']; ?></span> | <span><?php echo $userData['phone']; ?></span></p>
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
							<li><a href="#0" data-id="2"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Notification</a></li>
							<li><a href="#0" data-id="3"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Addresses</a></li>
							<li><a href="#0" data-id="4"><span><img src="<?php echo base_url('public/front/')?>img/rightarrow.svg" class="img-fluid" alt="arrow"></span>Change Password</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="profileAll12 profile1 active boxs">
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderHead">
									<h2>My Orders</h2>
								</div>
								<div class="orderProcess">
									<ul>
										<li><span><img src="<?php echo base_url('public/front/')?>img/bluecheck.svg" class="img-fluid" alt="check"></span>In Process</li>
										<li>12 Jul. SUNDAY 9:00 AM - 12 PM</li>
										<li>Order Amount: $ 22.90</li>
										<li><a href="#0" class="showDrop"><img src="<?php echo base_url('public/front/')?>img/dropblue.svg" class="img-fluid" alt="dropdown"></a></li>
									</ul>
								</div>
								<div class="AllorderDetail">
									<div class="orderInner">
										<div class="addressHist">
											<h2>Jenny Desouza</h2>
											<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
										</div>
										<div class="addressHist">
											<h2>Payment Informtion</h2>
											<p class="paymentdone">Success</p>
										</div>
										<div class="addressHist">
											<h2>Order ID</h2>
											<p>dffr12334456hjkk</p>
										</div>
									</div>
									<div class="orderInner2">
										<div class="foody">
											<img src="<?php echo base_url('public/front/')?>img/foody.png" class="img-fluid" alt="foody">
										</div>
										<div class="foodyContent">
											<h2>Mix Veg</h2>
											<p>North Indian, Mughlai, Seafood, Biryani</p>
											<ul class="quantity">
												<li>Quantity : <span>2</span></li>
												<li><span>$ 12.93</span></li>
												<li><a href="#0">Track Your Order</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="profileOrderDet">
							<div class="orderFirst">

								<div class="orderProcess">
									<ul>
										<li class="green"><span><img src="<?php echo base_url('public/front/')?>img/bluecheck.svg" class="img-fluid" alt="check"></span>Delivered</li>
										<li>12 Jul. SUNDAY 9:00 AM - 12 PM</li>
										<li>Order Amount: $ 22.90</li>
										<li><a href="#0" class="showDrop"><img src="<?php echo base_url('public/front/')?>img/dropblue.svg" class="img-fluid" alt="dropdown"></a></li>
									</ul>
								</div>
								<div class="AllorderDetail">
									<div class="orderInner">
										<div class="addressHist">
											<h2>Jenny Desouza</h2>
											<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
										</div>
										<div class="addressHist">
											<h2>Payment Informtion</h2>
											<p class="paymentdone">Success</p>
										</div>
										<div class="addressHist">
											<h2>Order ID</h2>
											<p>dffr12334456hjkk</p>
										</div>
									</div>
									<div class="orderInner2">
										<div class="foody">
											<img src="<?php echo base_url('public/front/')?>img/foody.png" class="img-fluid" alt="foody">
										</div>
										<div class="foodyContent">
											<h2>Mix Veg</h2>
											<p>North Indian, Mughlai, Seafood, Biryani</p>
											<ul class="quantity">
												<li>Quantity : <span>2</span></li>
												<li><span>$ 12.93</span></li>
												<li><a href="#0">Track Your Order</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderProcess">
									<ul>
										<li class="cancel"><span><img src="<?php echo base_url('public/front/')?>img/bluecheck.svg" class="img-fluid" alt="check"></span>Cancel</li>
										<li>12 Jul. SUNDAY 9:00 AM - 12 PM</li>
										<li>Order Amount: $ 22.90</li>
										<li><a href="#0" class="showDrop"><img src="<?php echo base_url('public/front/')?>img/dropblue.svg" class="img-fluid" alt="dropdown"></a></li>
									</ul>
								</div>
								<div class="AllorderDetail">
									<div class="orderInner">
										<div class="addressHist">
											<h2>Jenny Desouza</h2>
											<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
										</div>
										<div class="addressHist">
											<h2>Payment Informtion</h2>
											<p class="paymentdone">Success</p>
										</div>
										<div class="addressHist">
											<h2>Order ID</h2>
											<p>dffr12334456hjkk</p>
										</div>
									</div>
									<div class="orderInner2">
										<div class="foody">
											<img src="<?php echo base_url('public/front/')?>img/foody.png" class="img-fluid" alt="foody">
										</div>
										<div class="foodyContent">
											<h2>Mix Veg</h2>
											<p>North Indian, Mughlai, Seafood, Biryani</p>
											<ul class="quantity">
												<li>Quantity : <span>2</span></li>
												<li><span>$ 12.93</span></li>
												<li><a href="#0">Track Your Order</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="profileAll12 profile2 boxs">
						<div class="profileOrderDet">
							<div class="orderFirst">
								<div class="orderHead order">
									<h2>Notifications</h2>
								</div>
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
									<div class="AddressLeft AddressLeft2">
										<div class="addressUp">
											<div class="editProp">
												<h2>Other</h2>
											</div>
											<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
											<h3>39 mins.</h3>
										</div>
										<ul class="adres">
											<li><a href="#0">Delete Address</a></li>
											<li><a href="#0">Edit</a></li>
										</ul>
									</div>
									<div class="AddressLeft AddressLeft2 ">
										<div class="addressUp">
											<div class="editProp">
												<h2>Other</h2>
											</div>
											<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. 2972 Westheimer Rd. Santa Ana, Illinois 85486 </p>
											<h3>39 mins.</h3>
										</div>
										<ul class="adres">
											<li><a href="#0">Delete Address</a></li>
											<li><a href="#0">Edit</a></li>
										</ul>
									</div>
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