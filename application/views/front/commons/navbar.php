	<!-- Header Start -->
	<div class="header boxs">
		<div class="container">
			<nav class="navbar navbar-default">
				<nav class="navbar navbar-expand-md">
					<a class="navbar-brand" href="<?php echo base_url('home') ?>"><img src="<?php echo base_url('public/front/') ?>img/logoblue.svg" class="img-fluid" alt="logo"></a>
					<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav"><span class="navIcon"></span></button>
					<div class="navbar-collapse" id="nav">
						<div class="headerBox d-flex align-items-center float-right">
							<ul class="navbar-nav">
								<li class="nav-item"><a class="nav-link active" href="javascript:void(0);" data-toggle="modal" data-target="#become_partner">Become a Partner </a></li>
								<li class="nav-item afterLogin categoryBox"><a class="nav-link subMenu" href="javascript:void(0)"> Offers </a>
								</li>
								<li class="nav-item"><a class="nav-link" href="#0">Services <span><img src="<?php echo base_url('public/front/') ?>img/dropblue.svg" class="img-fluid" alt="dropdown"></span></a></li>
								<li class="nav-item"><a class="nav-link" href="#0">Shop <span><img src="<?php echo base_url('public/front/') ?>img/dropblue.svg" class="img-fluid" alt="dropdown"></span> </a></li>
								<li class="nav-item"><a class="nav-link" href="#0"><span><img src="<?php echo base_url('public/front/') ?>img/cart2.svg" class="img-fluid" alt="cart"></span> </a></li>

								
                                <?php if(!empty($this->session->userdata('login_id'))){  ?>
								<li class="nav-item urserShow"><a class="nav-link afterloginBtn" href="#0"><span><img src="<?php echo base_url('public/front/') ?>img/user.png" class="img-fluid" alt="user"></span><?php echo $userData['name'] ?>
									</a>
									<div class="profileChanges">
										<ul>
											<li><a href="<?php echo base_url('user/user-profile') ?>">Profile</a></li>
											<li><a href="profile.html">Notification</a></li>
											<li><a href="profile.html">Orders</a></li>
											<li><a href="profile.html">Address</a></li>
											<li><a href="<?php echo base_url('user/logout') ?>">Logout</a></li>
										</ul>
									</div>
								</li>
                                <?php }else{   ?>
                                <li class="nav-item loginShow"><a class="nav-link loginBtn" href="#0">Login</a></li>
                                <?php } ?>
							</ul>
							
                                	
						</div>
					</div>
				</nav>

			</nav>

		</div>
	</div>
	<!-- Header End -->


<!-- Start of Popup Modal of edit-profile -->
	<div class="modal  LoginModals LoginModals2 fade" id="become_partner" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/')?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<?php
					$content = array('class' => 'common-image-form');
					echo form_open('becomePartner/', $content);
				?>
					<div class="editPopup">
						<h2>Become A Partner</h2>
						<div class="error_msg"></div>
						<div class="form-group">
							<label class="labelel">Full Name</label>
							<input type="text" name="vendor_name" id="vendor_name" class="form-control inputcss" placeholder="Name" >
						</div>
						<div class="form-group">
							<label class="labelel">Email Address</label>
							<input type="text" class="form-control inputcss" name="vendor_email" id="vendor_email" placeholder="Email"  >
						</div>
						<div class="form-group">
							<label class="labelel">Number</label>
							<input type="number" class="form-control inputcss" placeholder="Number" name="vendor_phone" id="vendor_phone" >
						</div>
						<div class="form-group">
							<label class="labelel">Website</label>
							<input type="text" class="form-control inputcss" placeholder="Website" name="vendor_website" id="vendor_website" >
						</div>
						<div class="form-group">
							<!-- <label class="labelel">Choose category</label> -->
							<select class="form-control">
								<option>Choose category</option>
								<option value="Food">Food</option>
								<option value="Services">Services</option>
								<option value="Products">Products</option>
							</select>
						</div>
						<div class="editBtn">
							<button type="submit" class="btncommon">Submit</button>
						</div>
					</div>
				<?php
					echo form_close();
				?>	
			</div>
		</div>
	</div>
	<!-- End of Popup Modal of edit-profile -->