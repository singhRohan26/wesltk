

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
                                    <h4 class="mb-0 font-size-18">Restaurant Menu</h4>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('vendor/dashboard');?>">Dashboard</a></li>
                                    </ol>
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
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php
                                                if(!empty($menus)){
                                                    $i =1;
                                                    foreach($menus as $category){
                                            ?>    
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $category['name']; ?></td>
                                                <td><?php echo $category['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('vendor/edit-restaurant-menu/'. $category['id']);?>" data-toggle="tooltip" title="Edit Menu"><i class="fa fa-edit"></i></a>&emsp;
                                                    <a href="<?php echo base_url('vendor/delete-restaurant-menu/'. $category['id']);?>" data-toggle="tooltip" title="Delete Menu" class="delete-item"><i class="fa fa-trash"></i></a>
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
                                        <h4><?php if(!empty($menu_data)){ echo "Edit"; } else { echo "Add"; } ?> Menu</h4>
                                        <div class="error_msg"></div>
                                         <?php 
                                                $content = array('id' => 'common-form', 'role' => "form");
                                                if(!empty($menu_data)){
                                                    echo form_open_multipart('vendor/editRestaurantMenu/'.$menu_data['id'], $content);
                                                }else{
                                                    echo form_open_multipart('vendor/addRestaurantMenu', $content);
                                                }
                                            ?>
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Name</h5>
                                                    <input class="form-control" value="<?php if(!empty($menu_data)) { echo $menu_data['name']; }?>" type="text" name="name" id="name" placeholder="Name....">
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Status</h5>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="">-- Select Status --</option>
                                                        <option <?php if(!empty($menu_data)) { if($menu_data['status'] == "Active"){ echo "selected";} }?> value="Active">Active</option>
                                                        <option <?php if(!empty($menu_data)) { if($menu_data['status'] == "Inactive"){ echo "selected";} }?> value="Inactive">Inactive</option>

                                                    </select>
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

                
             

       