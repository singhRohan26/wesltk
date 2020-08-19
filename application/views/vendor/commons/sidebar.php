

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
    
                            <li class="<?php if($title == "Banner"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/banner');?>" class=" waves-effect <?php if($title == "Banner"){ echo "active";}?>">
                                    <i class="fas fa-images"></i>
                                    <span>Banner</span>
                                </a>
                            </li>
                            
                            <li class="<?php if($title == "Notification" || $title == "View Notification"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/notification');?>" class=" waves-effect <?php if($title == "Notification" || $title == "View Notification"){ echo "active";}?>">
                                    <i class="fas fa-bell"></i>
                                    <span>Notification</span>
                                </a>
                            </li>
                            
                                                        <li class="<?php if($title == "User"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/user');?>" class=" waves-effect <?php if($title == "User"){ echo "active";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>User Management</span>
                                </a>
                            </li>
                           
                            <li class="<?php if(!empty($pages_side)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side)){ echo "true"; }else{ echo "fals";}?>">
                                    <i class="fas fa-users"></i>
                                    <span>Vendor Management</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="#">New requests</a></li>
                                    <li><a href="#">Vendors list</a></li>
                                    <li><a href="#"></a></li>
                                </ul>
                            </li>
                           
                             <li class="<?php if(!empty($pages_side)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side)){ echo "true"; }else{ echo "fals";}?>">
                                    <i class="mdi mdi-google-pages"></i>
                                    <span>Pages</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('admin/pages/about');?>">About</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/faq');?>">Faq's</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/privacy');?>">Privacy & Policy</a></li>
                                </ul>
                            </li>
                                                  
                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->