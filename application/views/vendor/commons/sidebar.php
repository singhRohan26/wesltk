

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                           
                            <li>
                                <a href="<?php echo base_url('vendor/dashboard');?>" class="waves-effect">
                                    <span>Dashboard</span>
                                </a>
                            </li>
    
                            <?php
                                if(in_array('food', explode(',', $userData['category']))){
                            ?>
                            <li class="<?php if(!empty($pages_side_res)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side_res)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side_res)){ echo "true"; }else{ echo "false";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>Restaurant</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('vendor/restaurant-menu');?>">Add Menus</a></li>
                                    <li><a href="<?php echo base_url('vendor/restaurant-product');?>">Add Product</a></li>
                                </ul>
                            </li>
                           <?php
                                } if(in_array('product', explode(',', $userData['category']))){
                           ?>
                            <li class="<?php if(!empty($pages_side_product)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side_product)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side_product)){ echo "true"; }else{ echo "false";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>Products</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('vendor/restaurant-menu');?>">Add Category</a></li>
                                    <li><a href="<?php echo base_url('vendor/product-lists');?>">Add Product</a></li>
                                </ul>
                            </li>
                            <?php
                                } if(in_array('service', explode(',', $userData['category']))){
                            ?>
                            <li class="<?php if(!empty($pages_side_service)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side_service)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side_service)){ echo "true"; }else{ echo "false";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>Services</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('vendor/service-menu');?>">Add Sallon Category</a></li>
                                    <li><a href="<?php echo base_url('vendor/service-product-lists');?>">Add Saloon Product</a></li>
                                    <li><a href="<?php echo base_url('vendor/service-catring-menu');?>">Add Catring Category</a></li>
                                    <li><a href="<?php echo base_url('vendor/service-catring-product-lists');?>">Add Catring Product</a></li>
                                </ul>
                            </li>
                            <?php
                                }
                            ?>
                                                  
                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->