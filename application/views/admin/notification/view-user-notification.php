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
                        <h4 class="mb-0 font-size-18">Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/notification'); ?>"> Back</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>Date And Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($notifications)) {
                                            $i = 1;
                                            foreach ($notifications as $notification) {
                                                ?>
                                                <tr>
                                                    <td style="width: 20px;"><?php echo $i; ?></td>
                                                    <td><?php echo $notification['title']; ?></td>
                                                    <td title="<?php echo $notification['message']; ?>"><?php echo substr($notification['message'],0 ,90); ?>...</td>
                                                    <td><?php echo $notification['created_at']; ?></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>