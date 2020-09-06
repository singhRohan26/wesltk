
<?php
	if(!empty($products)){
?>
		<p><?php echo $products['description'];?></p> 
		<a href="javascript:;" class="btncommon" data-dismiss="modal" data-toggle="modal" data-target="<?php if(!empty($this->session->userdata('login_id'))){ echo "#catringModals"; } else{ echo "#loginModal"; }?>" onclick="$('#product_id').val(<?php echo $products['id'];?>)">Book Now</a>
<?php
}
?>


<?php if(!empty($this->session->userdata('login_id'))){ ?>

	<!-- Start of Popup Modal of login confirm-->
	<div class="modal socialIconsM socialnew  fade" id="catringModals" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/');?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="bookingModal">
					<div class="forgetIn forgetInbook">
						<h2 class="">Please fill the form:</h2>
						<?php
							$content = array('id' => 'common-form');
							echo form_open('home/bookCatringService', $content);
						?>
						<div class="formFill">
							<div class="form-group">
								<label class="labelel">Full Name</label>
								<input type="hidden" id="product_id" name="product_id">
								<input type="text" class="form-control inputcss" name="full_name_ser" id="full_name_ser" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label class="labelel">Email Address</label>
								<input type="email" class="form-control inputcss" name="email_sir" id="email_sir" placeholder="Email">
							</div>
							<div class="form-group">
								<label class="labelel">Phone No.</label>
								<input type="number" class="form-control inputcss" name="phone_no_ser" id="phone_no_ser" placeholder="Phone No.">
							</div>
							<div class="form-group">
								<label class="labelel">Date</label>
								<input type="date" class="form-control inputcss" name="date_ser" id="date_ser" placeholder="Date">
							</div>
						</div>

						<div class="socialIconsM social socialnew">
							<ul>
								<li class="Btn"><button class="btncommon">Continue & Pay</button></li>
							</ul>
						</div>
						<?php
							echo form_close();
						?>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- End of Popup Modal of login confirm-->
	<?php
		}
	?>


