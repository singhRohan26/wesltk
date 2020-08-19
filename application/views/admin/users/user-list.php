<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                 <div class="card-header">
                <i class="fa fa-user" aria-hidden="true"></i>
                <a class="notify" href="#"> Users List</a>
            </div>
            <p class="error_msg"></p>
            </div>

            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                            <tr>
                                
                                <th>Sno.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                              <tbody>
                            <?php $a=1; foreach($users as $user){  ?>
                            <tr>
                                <td><?php echo $a;  ?></td>
                                <td></td>
                                <td><?php echo $user['name'];  ?></td>
                                <td><?php echo $user['email'];  ?></td>
                                <td><?php echo $user['phone'];  ?></td>
                                <td></td>
                            </tr>
                            <?php $a++; } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
    <!-- End Page-content -->