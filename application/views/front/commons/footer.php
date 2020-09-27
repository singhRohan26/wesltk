<!--	footer code start-->
	<section class="footer boxs">
		<div class="container">
			<div class="footerIn">
				<div class="scrollbar">
					<a href="#0" class="topArrow"><img src="<?php echo base_url('public/front/') ?>img/scroll.svg" class="img-fluid" alt="scroll"></a>
				</div>
				<div class="footerAl footerFirst">
					<h2>CHOBANI</h2>
					<p>Bushwick meh Blue Bottle pork belly<br> mustache skate Echo Park.</p>
					<p>© 2020 LifeSet All Rights Reserved.</p>
				</div>
				<div class="footerAl">
					<h2>Quick Links</h2>
					<ul>
						<li><a href="<?php echo base_url('about');?>">About us</a></li>
						<li><a href="<?php echo base_url('home/contact-us') ?>">Contact Us</a></li>
						<li><a href="<?php echo base_url('home/why-us') ?>">Why Us</a></li>
<!--						<li><a href="#0">Track Order</a></li>-->
					</ul>
				</div>
				<div class="footerAl">
					<h2>Help Links</h2>
					<ul>
						<li><a href="<?php echo base_url('home/cancellation-policy') ?>">Cancellation Policy</a></li>
<!--						<li><a href="faq.html">Shipping Policy</a></li>-->
						<li><a href="<?php echo base_url('home/terms-and-conditions') ?>">Terms And Conditions</a></li>
						<li><a href="<?php echo base_url('privacy-policy');?>">Privacy Policy</a></li>
					</ul>
				</div>
				<div class="socialMedia">
					<ul>
						<li><a href="#0">Twitter</a></li>
						<li><a href="#0">Facebook</a></li>
						<li><a href="#0">Instagram</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!--	footer code end-->

	<!-- Start of Popup Modal of login confirm-->
	<div class="modal  LoginModals fade" id="loginModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginLeft">
						<img src="<?php echo base_url('public/front/') ?>img/login.png" class="img-fluid" alt="login">
					</div>
					<div class="loginRight">
						<form method="post"action="<?php echo base_url('user/user-login') ?>" id="common-form">
							<ul class="headIn">
								<li>Wesltk</li>
								<li>Login Now</li>
							</ul>
                            <div class="error_msg"></div>
							<div class="loginInput">
								<div class="form-group">
									<input type="email" class="form-control inputcss" placeholder="Email Address" name="email" id="email">
								</div>
								<div class="form-group">
									<input type="password" class="form-control inputcss" placeholder="Password" name="pass" id="pass">
								</div>

							</div>
							<div class="forget">
								<a href="#0" data-dismiss="modal" data-toggle="modal" data-target="#forgetphone">Forgot Password?</a>
							</div>
							<div class="socialIconsM">
								<ul>
<!--									<li class="Btn"><a href="#0" class="btncommon">Login</a></li>-->
                                    <li class="Btn"><button type="submit" class="btncommon">Login</button></li>
									<li><a href="#0"><img src="<?php echo base_url('public/front/') ?>img/fb.svg" class="img-fluid" alt="fb"></a></li>
									<li><a href="#0"><img src="<?php echo base_url('public/front/') ?>img/go.svg" class="img-fluid" alt="fb"></a></li>
								</ul>
							</div>
							<div class="accountnot boxs">
								<p>Don't have an account?<a href="#0" data-dismiss="modal" data-toggle="modal" data-target="#registerModal"> Register</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Popup Modal of login confirm-->

	<!-- Start of Popup Modal of register confirm-->
	<div class="modal  LoginModals fade" id="registerModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginLeft">
						<img src="<?php echo base_url('public/front/') ?>img/login2.png" class="img-fluid" alt="login">
					</div>
					<div class="loginRight">
						<form method="post" action="<?php echo base_url('home/user-registration') ?>" id="common-form">
							<ul class="headIn">
								<li>Wesltk</li>
								<li>Registration Now</li>
							</ul>
                            
							<div class="loginInput">
                                <div class="error_msg"></div>
								<div class="form-group">
									<input type="Text" class="form-control inputcss" placeholder="Full Name" name="name" id="name">
								</div>
								<div class="form-group">
									<input type="email" class="form-control inputcss" placeholder="Email Address" name="emailid" id="emailid">
								</div>
<!--
								<div class="form-group">
									<input type="number" class="form-control inputcss" placeholder="Mobile Number" name="phone" id="phone">
								</div>
-->
                                <div class="form-group flexClass">
									<input type="number" class="form-control inputcss" placeholder="91" name="phonecode" id="phonecode">
									<input type="number" class="form-control inputcss" placeholder="Mobile Number" name="phone" id="phone">
								</div>
                                
								<div class="form-group">
									<input type="password" class="form-control inputcss" placeholder="Password" name="password" id="password">
								</div>
								<div class="form-group">
									<input type="password" class="form-control inputcss" placeholder="Confirm Password" name="cpass" id="cpass">
								</div>

							</div>
							<div class="socialIconsM">
								<ul>
<!--									<li class="Btn"><a href="#0" class="btncommon">Register</a></li>-->
                                    <li class="Btn"><button type="submit" class="btncommon">Register</button></li>
								</ul>
							</div>
							<div class="accountnot boxs">
								<p>Already have an account?<a href="#0" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"> Login</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Popup Modal of register confirm-->

	<!-- Start of Popup Modal of login confirm-->
    <div class="modal  LoginModals fade" id="forgetphone" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginLeft">
						<img src="<?php echo base_url('public/front/') ?>img/login.png" class="img-fluid" alt="login">
					</div>
					<div class="loginRight">
						<form method="post" action="<?php echo base_url('home/forgot-password') ?>" id="common-form">
							<div class="forgetIn">
								<h2>Forgot Password?</h2>
								<p>Enter your Phone Number</p>
							</div>

                            <div class="form-group">
									<input type="Text" class="form-control inputcss" placeholder="Phone Number" name="mobile" id="mobile" autocomplete="off">
								</div>
							<div class="socialIconsM socialIconsM2">
								<ul>
									<li class="Btn"><button class="btncommon" >Continue</button></li>
								</ul>
							</div>
							<div class="accountnot boxs">
								<p>Didn’t received OTP? <a href="#0" > Resend</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>




	<div class="modal  LoginModals fade" id="forgetModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginLeft">
						<img src="<?php echo base_url('public/front/') ?>img/login.png" class="img-fluid" alt="login">
					</div>
					<div class="loginRight">
						<form method="post" action="<?php echo base_url('home/check-otp/') ?>" id="common-form">
							<div class="forgetIn">
								<h2>Forgot Password</h2>
								<p>Enter your 4 digit code to sent <span>xxx xxxx 6001</span></p>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="partitioned" name="partitioned" maxlength="4">
								
							</div>
							<div class="socialIconsM socialIconsM2">
								<ul>
									<li class="Btn"><button class="btncommon">Continue</button></li>
								</ul>
							</div>
							<div class="accountnot boxs">
								<p>Didn’t received OTP? <a href="#0" > Resend</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


    <div class="modal  LoginModals fade" id="resetModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginLeft">
						<img src="<?php echo base_url('public/front/') ?>img/login.png" class="img-fluid" alt="login">
					</div>
					<div class="loginRight">
						<form method="post" action="<?php echo base_url('home/reset-password') ?>" id="common-form">
							<div class="forgetIn">
								<h2>Reset Password</h2>
<!--								<p> <span>xxx xxxx 6001</span></p>-->
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="fpass" name="fpass" placeholder="New password" autocomplete="off">
								
							</div>
                            <div class="form-group">
								<input type="password" class="form-control" id="fcpass" name="fcpass" placeholder="Confirm password" autocomplete="off">
								
							</div>
                            
							<div class="socialIconsM socialIconsM2">
								<ul>
									<li class="Btn"><button class="btncommon">Continue</button></li>
								</ul>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- End of Popup Modal of login confirm-->

<!-- Start of Popup Modal of edit-profile -->
	<div class="modal  LoginModals LoginModals2 fade" id="editModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
                
                <?php
					$content = array('id' => 'common-image-form');
					echo form_open_multipart('user/updatProfile/', $content);
				?>
                
                
				<div class="editPopup">
					<h2>Edit Profile</h2>
						<div class="avatar-upload">
							<div class="avatar-edit">
								<input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" />
								<label for="imageUpload"></label>
							</div>
							<div class="avatar-preview">
								<div id="imagePreview" style="background-image: url(<?php if(!empty($userData['image'])){ echo base_url('uploads/users/'. $userData['image']); }else{ echo base_url('public/front/deepu.jpg'); }?>);">
								</div>
							</div>
					</div>
					<div class="error_msg"></div>
						<div class="form-group">
							<label class="labelel">Full Name</label>
							<input type="text" name="profile_name" id="profile_name" class="form-control inputcss" placeholder="Name" value="<?php echo $userData['name'] ?>">
						</div>
						<div class="form-group">
							<label class="labelel">Email Address</label>
							<input type="text" class="form-control inputcss" name="profile_email" id="profile_email" placeholder="Email"  value="<?php echo $userData['email'] ?>" disabled>
						</div>
						<div class="form-group">
							<label class="labelel">Number</label>
							<input type="number" class="form-control inputcss" placeholder="Number" name="profile_phone" id="profile_phone" value="<?php echo $userData['phone'] ?>">
						</div>
						<div class="editBtn">
							<button type="submit" class="btncommon">Update</button>
						</div>
				</div>
                <?php
					echo form_close();
				?>
			</div>
            
		</div>
	</div>
	<!-- End of Popup Modal of edit-profile -->
<!-- Start of Popup Modal of vendor -->
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
							<label class="labelel">Phone Number</label>
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
	<!-- End of Popup Modal of vendor -->


	<!-- Start of Popup Modal of address code end-->
	<div class="modal  ReviewModals fade" id="reviewModals" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="loginAll">
					<div class="loginRight loginRightreview">
						<form method="post" action="<?php echo base_url('booking/doAddAddress') ?>" id="common-form"> 
							<div class="forgetIn">
								<h2 class="">Add new address</h2>
							</div>
							<div class="reviewForm">
								<div class="form-group">
									<label class="labelel">Name</label>
									<input type="text" class="form-control inputcss" placeholder="Name" name="username" id="username">
								</div>
<!--
								<div class="form-group">
									<label class="labelel">Contact number</label>
									<input type="number" class="form-control inputcss" placeholder="number">
								</div>
-->
								<div class="form-group">
									<label class="labelel">Address</label>
									<input type="text" class="form-control inputcss" placeholder="Address" id="address" name="address">
								</div>
									<div class="form-group fifty">
									<label class="labelel">Pincode</label>
									<input type="number" class="form-control inputcss" placeholder="pincode" name="pincode" id="pincode">
								</div>
									<div class="form-group fifty right">
									<label class="labelel">City</label>
									<input type="text" class="form-control inputcss" placeholder="city" name="city" id="city">
								</div>
													<div class="form-group fifty">
									<label class="labelel">State</label>
									<input type="text" class="form-control inputcss" placeholder="state" name="state" id="state">
								</div>
									<div class="form-group fifty right">
									<label class="labelel">Country</label>
									<input type="text" class="form-control inputcss" placeholder="country" name="country" id="country">
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
	<!-- End of Popup Modal of  address code end-->

<!--
 	<div class="modal  ReviewModals fade" id="review" role="dialog">

         <div class="modal-dialog">
            <div class="modal-content">
                <div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
                <form method="post" action="" id="common-form">
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
-->



<!-- Start of Popup Modal of display map -->
	<div class="modal  LoginModals LoginModals2 fade" id="mapModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/') ?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
                
                <div id="map"></div>
                
                
				
                
			</div>
            
		</div>
	</div>
	<!-- End of Popup Modal of display map -->

	<script src="<?php echo base_url('public/front/') ?>js/jquery.js"></script>
	<script src="<?php echo base_url('public/front/') ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('public/front/') ?>js/slick.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js'></script>
	<script src='https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js'></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?php echo base_url('public/front/') ?>script.js"></script>
	<script src="<?php echo base_url('public/front/') ?>js/custom.js"></script>
    <script src="<?php echo base_url('public/front/') ?>js/event.js"></script>
    <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIYtKPyUvUy4ouNk-bA444gwfQHVxiMF0&callback=initMap">
    </script>
</body>

</html>
