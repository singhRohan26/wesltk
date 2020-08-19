

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
                        <h4 class="mb-0 font-size-18">Front Banner Images</h4>
                        
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
                            $content = array('id' => 'common-image-form', 'role' => "form");
                            echo form_open_multipart('admin/doAddBannerImages/', $content);
                            ?>

                            <div class="form-group">
                                <h5 class="font-size-14">Banner Images</h5>
                                <input class="form-control" type="file" name="banner_image[]" multiple="" id="banner_image" >
                            </div>

                            <button class="btn btn-primary">Submit</button>
                            <?php echo form_close();?>
                        </div>
                        <div class="card-body">
                           <div class="row">
                            <?php
                            if(!empty($category_datas)){
                                foreach ($category_datas as $category_data) {
                                    ?>
                                    <div class="col-sm-2">
                                        <a href="<?php echo base_url('admin/delete-slider-image/'.$category_data['id']);?>" class="delete-item"><i class="fa fa-trash text-danger"></i></a>
                                        <?php if(!empty($category_data)) { ?>
                                          <img height="100" width="100" src="<?php echo base_url('uploads/banner_image/'.$category_data['banner_image']); ?>"><p></p>
                                      <?php } ?>
                                  </div>
                              <?php } } ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div> <!-- end row -->


      </div> <!-- container-fluid -->
  </div>
  <!-- End Page-content -->




