<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Member</h1>
    <a href="index.php?users" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Members</a>
</div>
<form method="post" action="" id="insert_user_form">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_name">Member Name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter the name" aria-describedby="user_name" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_email">Member Email</label>
                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter the email" aria-describedby="user_email" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_contact">Member Contact</label>
                <input type="number" name="user_contact" id="user_contact" class="form-control" placeholder="Enter the Number" aria-describedby="user_contact" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_role">Member Role</label>
                <select id="user_role" class="form-control" name="user_role" required>
                    <option value="" disabled selected>Select the role</option>
                    <option value="project_lead">Project Lead</option>
                    <option value="design_lead">Designer</option>
                    <option value="accounts_lead">Accounts</option>
                    <option value="site_incharge">Site Incharge</option>
                    <option value="site_staff">Site Staff</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
        </div>

    </div>
</form>