

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
                                <li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
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
                    <div class="card-body">

                     <p class="error_msg"></p>
                     <div class="card-block">
                       <form name="editProfile" id="editProfile" method="post" action="<?php if(!empty($profileData['vendor_id'])) { echo base_url('vendor/doChangeProfile/'.$profileData['vendor_id']); } else { echo ""; } ?>" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" name="vendor_name" id="vendor_name" class="admin_name form-control" placeholder="Admin Name" value="<?php if(!empty($profileData['name'])) { echo $profileData['name'];}else{ echo "";} ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                 <label class="col-form-label">Email ID</label>
                                 <input type="email" name="email_id" id="email_id" class="email_id form-control" placeholder="Email Id"  value="<?php if(!empty($profileData['email'])) { echo $profileData['email'];}else{ echo "";} ?>">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-6">
                         <div class="form-group">
                            <label class="col-form-label">Phone No.</label>
                            <input type="number" name="phone" id="phone" class="image_url form-control" value="<?php if(!empty($profileData['phone'])) { echo $profileData['phone'];}else{ echo "";} ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label class="col-form-label">Web Site Url</label>
                            <input type="text" name="website" id="website" class="form-control" value="<?php if(!empty($profileData['website'])) { echo $profileData['website'];}else{ echo "";} ?>" placeholder="Website Url...">
                        </div>
                    </div>
                         
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label class="col-form-label">Upload Images</label>
                            <input type="file" name="image_url" id="image_url" multiple="" class="form-control">
                             <img src="<?php echo base_url('uploads/vendor/'. $profileData['image']);?>" style="height: 100px; width: 150px;">
                        </div>
                    </div>
                </div>   


                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary m-b-0">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>
<!-- end row -->
</div>
<!-- container-fluid -->
</div>
<!-- End Page-content -->
