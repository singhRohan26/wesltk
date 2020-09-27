<div class="container">
						<div class="rivewTop">
							<div class="reviewTopLeft restHeadd">
								<h2>Reviews <span>(<?php echo count($allreviews)  ?>)</span></h2>
								
							</div>
							
						</div>
    
                <?php 
                if(!empty($allreviews)){  
                    foreach($allreviews as $review){  ?>
						<div class="customerReview">
							<div class="customerAl">
								<div class="customerProfile">
									<div class="profileImg">
                                        <?php if(!empty($review['image'])){   ?>
										<img src="<?php echo base_url('uploads/users-profile/'.$review['image']);?>" class="img-fluid" alt="<?php echo $review['name'] ?>">
                                        <?php } else{   ?>
                                        <img src="<?php echo base_url('public/front/');?>img/default.png" class="img-fluid" alt="customer">
                                        <?php } ?>
									</div>
									<div class="profileContent">
										<h2><?php echo $review['name'] ?></h2>
										<div class="rating">
											<ul>
                                                <?php for ($i = 1; $i <= $review['rating']; $i++) {?>
                                                  <li>
                                                    <img src="<?php echo base_url('public/front/');?>img/star1.png" class="img-fluid " alt="star">
													
												</li>
                                                   <?php } ?>
												
												
											</ul>
											<div class="ratingTime">
												<p>| <?php echo date("F jS, Y", strtotime($review['created_at'])); ?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="customerThumb">
									<h2>was this report helpful?</h2>
									<a href="#0" class="thumbUp"><span><img src="<?php echo base_url('public/front/');?>img/thumb.svg" class="img-fluid" alt="thumb"></span>0</a>
									<a href="#0" class="thumdown"><span><img src="<?php echo base_url('public/front/');?>img/thumb.svg" class="img-fluid" alt="thumb"></span>0</a>
								</div>
							</div>
							<p class="revie"><?php echo $review['review'] ?>
							</p>
							
						</div>
						<?php } } else {   ?>
    <center><p>No Reviews yet!</p></center>
                        <?php } ?>
					</div>