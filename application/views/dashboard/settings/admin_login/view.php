<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Login</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="all_finalist" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $i = 1;
                                foreach ($users as $user) :
                                ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo user_level($user->level); ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td>
                                <a href="<?php echo base_url('admin_login/details/' . $user->id); ?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo base_url('admin_login/edit/' . $user->id); ?>"><i class="fa fa-edit"></i></a>
                                </td>
                                </tr>
                                <?php
                                $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="<?php echo base_url('admin_login/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
