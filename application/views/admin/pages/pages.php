	

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
                                    <h4 class="mb-0 font-size-18"><?php echo $title;?></h4>
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
        								 <div id="error_msg"></div>
                                         <?php 
                                                $content = array('id' => 'common-form', 'role' => "form");
                                                echo form_open('admin/doupdateContent/'.$page_data['id'], $content);
                                            ?>
	                                            <div class="row">
                                                	
	                                            	<div class="col-12">
		                                                <div class="form-group">
		                                                    <h5 class="font-size-14">Heading</h5>
		                                                    <textarea class="form-control" id="page_heading" name="page_heading"><?php if(!empty($page_data)) { echo $page_data['heading']; }?></textarea>
		                                                </div>
                                                	</div>
	                                            </div> 
	                                            <div class="row">
                                                	
	                                            	<div class="col-12">
		                                                <div class="form-group">
		                                                    <h5 class="font-size-14">Content</h5>
		                                                    <textarea class="form-control" id="page_name" name="page_name"><?php if(!empty($page_data)) { echo $page_data['message']; }?></textarea>
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

                
             

       