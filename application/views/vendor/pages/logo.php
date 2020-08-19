	

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Front Logos</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                                            
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        								 <div class="error_msg"></div>
                                         <?php 
                                                $content = array('id' => 'common-image-form', 'role' => "form");
                                                echo form_open_multipart('admin/doUpdateLogo/', $content);
                                            ?>
	                                            <div class="row">
                                                	
	                                            	<div class="col-6">
		                                                <div class="form-group">
		                                                    <h5 class="font-size-14">Header Logo</h5>
                                                        <?php if (!empty($frontData['header_logo'])) { ?>
                                                          <div class="form-group row" >
                                                            <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                  <img src="<?php echo base_url('uploads/front_page/' . $frontData['header_logo']); ?>" style='height: 100px; width: 100px;' class="img-responsive">
                                                                </div>
                                                              </div>
                                                            <?php } ?>
		                                                   <input type="file" name="header_logo" id="header_logo" class="form-control">
		                                                </div>
                                                	</div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <h5 class="font-size-14">Footer Logo</h5>
                                                            <?php if (!empty($frontData['footer_logo'])) { ?>
                                                          <div class="form-group row" style="background: #1b2630;">
                                                            <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                  <img src="<?php echo base_url('uploads/front_page/' . $frontData['footer_logo']); ?>" style='height: 100px; width: 100px;' class="img-responsive">
                                                                </div>
                                                              </div>
                                                            <?php } ?>
                                                           <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                                                        </div>
                                                    </div>
	                                            </div> 
                                                <div class="row">
                                                    
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5 class="font-size-14">Footer Content</h5>
                                                           <textarea name="footer_content" id="footer_content" class="form-control"><?php echo $frontData['footer_content'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div> 
	                                                
	                                          
                                                <button class="btn btn-primary">Submit</button>
                                                <?php echo form_close();?>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                           
                        </div> <!-- end row -->
        
                      
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
             

       