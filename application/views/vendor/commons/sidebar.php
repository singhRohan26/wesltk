

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                           
                            <li>
                                <a href="<?php echo base_url('admin/dashboard');?>" class="waves-effect">
                                    <span>Dashboard</span>
                                </a>
                            </li>
    
                           
                            <li class="<?php if(!empty($pages_side)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side)){ echo "true"; }else{ echo "fals";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>Restaurant</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('vendor/restaurant-menu');?>">Add Menus</a></li>
                                </ul>
                            </li>
                           
                            
                                                  
                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->