<!--	shoping cart code start-->
	<section class="shopingCart scrollTop paddingAll boxs">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Account</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio non congue.</p>
							<ul>
								<li><a href="devilery.html" class="btncommon" data-toggle="modal" data-target="#loginModal">Login</a></li>
								<li><a href="devilery.html" class="btncommon" data-toggle="modal" data-target="#registerModal">Register</a></li>
							</ul>
						</div>
					</div>
					<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Delivery Address</h2>
						</div>
					</div>
									<div class="checkoutAll">
						<div class="checkLogin">
							<h2 class="mainHeading">Payment</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="procedTo boxs">
						<div class="procedTotal procedTotal2 boxs">
							<h2>Subtotal (<?php echo count($this->cart->contents()); ?> items) : </h2>
							<h3>$<?php echo $this->cart->total(); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>