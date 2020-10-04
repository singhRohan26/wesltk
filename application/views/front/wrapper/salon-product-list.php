<ul class="menuDetailnew menuDetailnew2">
	<?php
		if(!empty($products)){
			foreach ($products as $product) {
	?>
	<li>
		<div class="menuListImg menuListImg2">
			<img src="<?php echo base_url('uploads/product_image/'.$product['image']);?>" class="img-fluid" alt="list">
		</div>
		<div class="menuContent menuContent2">
			<h2><?php echo $product['name'];?></h2>
			<p><?php echo $product['description'];?>	<!-- <a href="#0" class="readMore">Read More</a></p> -->
			<h2 class="price">$<?php echo $product['price'];?></h2>

			<div class="addProduct">
				<div class="vaulebox">
					<p class="productAdd productAddbook" data-toggle="modal" data-target="#bookModals<?php echo $product['id'];?>">Book Now</p>
				</div>
			</div>

		</div>
	</li>
		
<!-- Start of Popup Modal of login confirm-->
	<div class="modal  BookModals fade" id="bookModals<?php echo $product['id'];?>" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="closeBtn">
					<a href="#0" data-dismiss="modal"><img src="<?php echo base_url('public/front/');?>img/close.svg" class="img-fluid" alt="close"></a>
				</div>
				<div class="bookingModal">
					<div class="forgetIn forgetInbook">
						<h2 class=""><?php echo $product['name'];?></h2>
						<p><?php echo $product['description'];?>

						</p>
						<h2 class="price">$<?php echo $product['price'];?></h2>
						<div class="socialIconsM  social">
							<ul>
								<li class="Btn"><a href="javascript:;" class="btncommon" data-dismiss="modal" data-toggle="modal" data-target="<?php if(!empty($this->session->userdata('login_id'))){ echo "#formModals"; } else{ echo "#loginModal"; }?>" onclick="$('#product_id').val(<?php echo $product['id'];?>);">Book Now</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Popup Modal of login confirm-->
	<?php
			}
		}else{
	?>
		<h2>No Product Found!!..</h2>
	<?php		
		}
	?>
</ul>

<?php if(!empty($this->session->userdata('login_id'))){ ?>

	<!-- Start of Popup Modal of login confirm-->
	<div class="modal socialIconsM socialnew  fade" id="formModals" role="dialog">
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
							echo form_open('home/bookService', $content);
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
							<div class="form-group">
								<label class="labelel">Time</label>
								<input type="time" class="form-control inputcss" name="time_ser" id="time_ser" placeholder="2:30 pm">
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
<script type="text/javascript">
	$(document).on('click', '.btncommon', function(){
		$('body').addClass('modal-open')
	})
</script>