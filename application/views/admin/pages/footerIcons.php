

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
                                    <h4 class="mb-0 font-size-18">Footer Icons</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" >
                                            <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Link</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php
                                                if(!empty($icons)){
                                                    $i =1;
                                                    foreach($icons as $icon){
                                            ?>    
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $icon['link']; ?></td>
                                                <td><img src="<?php echo base_url('uploads/icons/'.$icon['image_url']); ?>" height="50" width="50"></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/edit-icon/'. $icon['id']);?>"><i class="fa fa-edit"></i></a>&emsp;
                                                    <a href="<?php echo base_url('admin/delete-icon/'. $icon['id']);?>" class="delete-item"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                           <?php
                                                $i++;
                                                    }
                                                }
                                           ?>
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="error_msg"></div>
                                         <?php 
                                                $content = array('id' => 'common-image-form', 'role' => "form");
                                                if(!empty($icon_data)){
                                                    echo form_open_multipart('admin/doEditIcons/'.$icon_data['id'], $content);
                                                }else{
                                                    echo form_open_multipart('admin/doAddIcons', $content);
                                                }
                                            ?>
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Icon Link</h5>
                                                    <textarea class="form-control" type="text" name="link" id="link" placeholder="Link...."><?php if(!empty($icon_data)) { echo $icon_data['link']; }?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Icon Image</h5>
                                                    <?php if(!empty($icon_data)) { ?>
                                                      <img height="100" width="100" src="<?php echo base_url('uploads/icons/'.$icon_data['image_url']); ?>"><p></p>
                                                    <?php } ?>
                                                    <input class="form-control" type="file" name="image_url" id="image_url" >
                                                </div>                                           
                                                <button class="btn btn-primary">Submit</button>
                                                <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
        
                      
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
             

       