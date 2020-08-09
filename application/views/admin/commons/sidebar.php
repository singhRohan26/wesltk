

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
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Banner</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Tax"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/tax');?>" class=" waves-effect <?php if($title == "Tax"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Tax Management</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Notification" || $title == "View Notification"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/notification');?>" class=" waves-effect <?php if($title == "Notification" || $title == "View Notification"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Notification</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Category" || $title == "View Category"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/category');?>" class=" waves-effect <?php if($title == "Category" || $title == "View Category"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Brand | Company</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Survey Form" || $title == "View Survey Form"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/survey-form');?>" class=" waves-effect <?php if($title == "Survey Form" || $title == "View Survey Form"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Survey Form</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Customer Category"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/customer-category');?>" class=" waves-effect <?php if($title == "Customer Category"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Customer Category</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Product"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/product');?>" class=" waves-effect <?php if($title == "Product"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Product</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "User"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/user');?>" class=" waves-effect <?php if($title == "User"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>User Management</span>
                                </a>
                            </li>
                            <li class="<?php if($title == "Order Details"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/order');?>" class=" waves-effect <?php if($title == "Order Details"){ echo "active";}?>">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Order Management</span>
                                </a>
                            </li>
                          <li class="<?php if($title == "Chat Section"){ echo "mm-active";}?>">
                                <a href="<?php echo base_url('admin/Admin/chat')  ?>" class=" waves-effect <?php if($title == "Chat Section"){ echo "active";}?>">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>Chat Support</span>
                                </a>
                            </li>
                           
                             <li class="<?php if(!empty($pages_side)){ echo "mm-active"; }?>">
                                <a href="javascript: void(0);" class="has-arrow waves-effect <?php if(!empty($pages_side)){ echo "mm-active"; }?>" aria-expanded="<?php if(!empty($pages_side)){ echo "true"; }else{ echo "fals";}?>">
                                    <i class="mdi mdi-google-pages"></i>
                                    <span>Pages</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" >
                                    <li><a href="<?php echo base_url('admin/pages/about');?>">About</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/term');?>">Term</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/faq');?>">Faq's</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/privacy');?>">Privacy & Policy</a></li>
                                    <li><a href="<?php echo base_url('admin/pages/help');?>">Help</a></li>
                                    <li><a href="<?php echo base_url('admin/frontLogo');?>">Logos</a></li>
                                    <li><a href="<?php echo base_url('admin/footer-icons');?>">Footer Icons</a></li>
                                </ul>
                            </li>
                             <li class="">
                                <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                                    <i class="mdi mdi-google-pages"></i>
                                    <span>Form Management</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                                    <li><a href="<?php echo base_url('admin/feedback');?>">Feedback</a></li>
                                    <li><a href="<?php echo base_url('admin/survey1');?>">Survey Form1</a></li>
                                    <li><a href="<?php echo base_url('admin/survey2');?>">Survey Form2</a></li>
                                    <li><a href="<?php echo base_url('admin/survey3');?>">Survey Form3</a></li>
                                    <li><a href="<?php echo base_url('admin/survey4');?>">Survey Form4</a></li>
                                    <li><a href="<?php echo base_url('admin/survey5');?>">Survey Form5</a></li>
                                </ul>
                            </li>
                           
                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->