<?php
foreach ($users as $user) :
?>
<!-- page content -->
<div class="right_col" role="main">
<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Input new User</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
            <form class="form-horizontal form-label-left" action="<?php echo base_url('admin_login/update/' . $user->id); ?>" method="POST">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name *</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" placeholder="Your Name" name="name" value="<?php echo $user->name; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name *</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="email" class="form-control" placeholder="your@email.com" value="<?php echo $user->email; ?>" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">User Level</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="level" class="form-control">
                            <option value="1" <?php echo $user->level == '1' ? 'selected' : '' ; ?>>Kasir</option>
                            <option value="2" <?php echo $user->level == '2' ? 'selected' : '' ; ?>>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="password" class="form-control" placeholder="password" name="password">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
endforeach;
?>
<?php
    $this->load->view('dashboard/js');
?>
