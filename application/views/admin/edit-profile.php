

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
                                    <h4 class="mb-0 font-size-18">Edit Profile</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Profile</a></li>
                                            <!-- <li class="breadcrumb-item active">Form Elements</li> -->
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                      <?php// print_r($profileData); ?>
                    
                        <div class="row">
                           <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                           <p class="error_msg"></p>
                                        </div>
                                        <div class="card-block">
                                            <form name="editProfile" id="editProfile" method="post" action="<?php if(!empty($profileData['id'])) { echo base_url('admin/doChangeProfile/'.$profileData['id']); } else { echo ""; } ?>" enctype="multipart/form-data">
<!--                                                <div id="error_msg"></div>-->
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                     <input type="text" name="admin_name" id="admin_name" class="admin_name form-control" placeholder="Admin Name" value="<?php if(!empty($profileData['name'])) { echo $profileData['name'];}else{ echo "";} ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email ID</label>
                                                    <div class="col-sm-10">
                                                     <input type="email" name="email_id" id="email_id" class="email_id form-control" placeholder="Email Id"  value="<?php if(!empty($profileData['email'])) { echo $profileData['email'];}else{ echo "";} ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Phone No.</label>
                                                    <div class="col-sm-10">
                                                     <input type="number" name="phone" id="phone" class="image_url form-control" value="<?php if(!empty($profileData['phone'])) { echo $profileData['phone'];}else{ echo "";} ?>"><br>
                                                    </div>
                                                </div>
                                             

                                                <div class="form-group row">
                                                    <label class="col-sm-2"></label>
                                                    <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary m-b-0">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
