

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
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <select class="form-control" id="filter_days" data-url="<?php echo base_url('admin/dashboardFilter');?>">
                                            <option value="">Overall</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                            <div class="row" id="content_dashboard_wrapper">
                                <div class="col-sm-6 col-xl-4">
                                    <a href="<?php echo base_url('admin/user');?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="font-size-14">Total Number of Users</h5>
                                                    </div>
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="dripicons-box"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <h4 class="m-0 align-self-center"><?php echo $total_users;?></h4>
                                                
                                            </div>
                                        </div>
                                    </a>   
                                </div>
        
                                <div class="col-sm-6 col-xl-4">
                                    <a href="<?php echo base_url('admin/order');?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="font-size-14">Total No Of Orders</h5>
                                                    </div>
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="dripicons-briefcase"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <h4 class="m-0 align-self-center"><?php echo $total_orders;?></h4>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-xl-4">
                                    <a href="<?php echo base_url('admin/completed-order');?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="font-size-14">Total Completed Orders</h5>
                                                    </div>
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="dripicons-tags"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <h4 class="m-0 align-self-center"><?php echo $total_completed_orders;?></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                               
        
                            </div>
                            <!-- end row -->


                      
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

              