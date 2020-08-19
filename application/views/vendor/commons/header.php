<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title><?php echo $title;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('public/admin/assets/images/favicon.ico');?>">
        <!-- DataTables -->
        <link href="<?php echo base_url('public/admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('public/admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css'); ?>" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url('public/admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css'); ?>" />  
        <!-- slick css -->
        <link href="<?php echo base_url('public/admin/assets/libs/slick-slider/slick/slick.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('public/admin/assets/libs/slick-slider/slick/slick-theme.css');?>" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="<?php echo base_url('public/admin/assets/libs/jqvmap/jqvmap.min.css');?>" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('public/admin/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('public/admin/assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('public/admin/assets/css/app.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/admin/assets/css/styles.css');?>" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                          

                            <a href="<?php echo base_url('admin/dashboard');?>" class="logo logo-light">
                                <span class="logo-sm" >
                                    <img src="<?php echo base_url('public/admin/assets/images/logo.png') ?>" alt="" style="position: absolute;height: 40px;width: 40px;border-radius: 50%;left: 4px;top: 10px;">
                                </span>
                                <span class="logo-lg" >
                                    <img src="<?php echo base_url('public/admin/assets/images/logo.png') ?>" alt="" style="position: absolute;height: 40px;width: 80px;left: 70px;top:20px">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>

                        <!-- App Search-->
                        
                    </div>

                    <div class="d-flex">


                       <!--  <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-danger badge-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-medium text-uppercase"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-pill badge-danger">New 3</span>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <img src="<?php echo base_url('public/admin/');?>assets/images/users/avatar-3.jpg"
                                                class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Andrew Mackie</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="mdi mdi-package-variant-closed"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">One could refuse to pay expensive translators.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <img src="<?php echo base_url('public/admin/');?>assets/images/users/avatar-4.jpg"
                                                class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Dominic Kellway</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                                    </a>
                                </div>
                            </div>
                        </div> -->

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--
                                <img class="rounded-circle header-profile-user" src=""
                                    alt="Header Avatar">
-->
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $userData['name'];?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                 <a class="dropdown-item" href="<?php echo base_url('admin/edit-profile') ?>"><i class="fas fa-user-alt"></i> Edit Profile</a>
                                 
                                <a class="dropdown-item" href="<?php echo base_url('admin/change-password') ?>"><i class="fas fa-edit"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('admin/logout') ?>"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
