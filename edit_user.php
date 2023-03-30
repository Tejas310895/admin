<?php $user_details = get_users($_GET['edit_user']) ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit details</h1>
    <a href="index.php?users" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Members</a>
</div>
<form method="post" action="" id="edit_user_form">
    <input class="form-control d-none" type="text" name="user_id" value="<?php echo $user_details['user_id']; ?>">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_name">Member Name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $user_details['user_name']; ?>" aria-describedby="user_name" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_email">Member Email</label>
                <input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $user_details['user_email']; ?>" aria-describedby="user_email" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_contact">Member Contact</label>
                <input type="number" name="user_contact" id="user_contact" class="form-control" value="<?php echo $user_details['user_contact']; ?>" aria-describedby="user_contact" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_role">Member Role</label>
                <select id="user_role" class="form-control" name="user_role" required>
                    <option value="<?php echo $user_details['user_role']; ?>" selected>
                        <?php if ($user_details['user_role'] == 'project_lead') {
                            echo "Project Lead";
                        } elseif ($user_details['user_role'] == 'design_lead') {
                            echo "Design Lead";
                        } elseif ($user_details['user_role'] == 'accounts_lead') {
                            echo "Accounts Lead";
                        } ?>
                    </option>
                    <?php if ($user_details['user_role'] == 'project_lead') { ?>
                        <option value="design_lead">Designer</option>
                        <option value="accounts_lead">Accounts</option>
                    <?php } elseif ($user_details['user_role'] == 'design_lead') { ?>
                        <option value="project_lead">Project Lead</option>
                        <option value="accounts_lead">Accounts</option>
                    <?php } elseif ($user_details['user_role'] == 'accounts_lead') { ?>
                        <option value="project_lead">Project Lead</option>
                        <option value="design_lead">Designer</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
        </div>

    </div>
</form>