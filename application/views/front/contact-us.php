
	<!--restaurants banner code start-->
	<section class="restaurBanner restaurBannercont  boxs">
		<div class="bannerRest">
			<img src="<?php echo base_url('public/front/') ?>img/contact.png" class="img-fluid" alt="banner">
		</div>
	</section>
	<!--restaurants banner code end-->
	<section class="contactDetail boxs">
		<div class="contactLeft">
			<h2 class="mainHeading">Contact Us</h2>
            <form method="post" action="<?php echo base_url('home/doContactUs') ?>" id="common-form">
			<div class="form-group">
				<label class="labelel">Full Name</label>
				<input type="text" class="form-control inputcss" placeholder="Full Name" name="name" id="name">
			</div>
			<div class="form-group">
				<label class="labelel">Email Address</label>
				<input type="email" class="form-control inputcss" placeholder="Email" name="email" id="email">
			</div>
			<div class="form-group">
				<label class="labelel">Mobile No.</label>
				<input type="number" class="form-control inputcss" placeholder="12345" name="phone" id="phone">
			</div>
			<div class="form-group">
				<label class="labelel">Subject</label>
				<input type="text" class="form-control inputcss" placeholder="subject" name="subject" id="subject">
			</div>
			<div class="form-group">
				<label class="labelel">Message</label>
				<textarea class="form-control inputcss" placeholder="Lorem ipsum dolor sit amet" name="msg" id="msg"></textarea>
			</div>
			<div class="editBtn editBtn2">
				<button type="submit" class="btncommon">Submit</button>
			</div>
                </form>
		</div>
		<div class="contactRight">
			<ul>
				<li><a href="#0">
						<div class="totalCont">
							<div class="callAl">
								<img src="<?php echo base_url('public/front/') ?>img/call.svg" class="img-fluid" alt="call">
							</div>
							<span class="contactTitle">Contact No.</span>
							<span class="contactNo">8448861216</span>
						</div>
					</a></li>
								<li><a href="#0">
						<div class="totalCont">
							<div class="callAl">
								<img src="<?php echo base_url('public/front/') ?>img/call2.svg" class="img-fluid" alt="call">
							</div>
							<span class="contactTitle">Email Address.</span>
							<span class="contactNo">Infowestlk@gmail.com</span>
						</div>
					</a></li>
								<li><a href="#0">
						<div class="totalCont">
							<div class="callAl">
								<img src="<?php echo base_url('public/front/') ?>img/call3.svg" class="img-fluid" alt="call">
							</div>
							<span class="contactTitle">Address</span>
							<span class="contactNo">Dubai,</span>
						</div>
					</a></li>
			</ul>
		</div>
	</section>