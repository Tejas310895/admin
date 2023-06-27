<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Register Meetings</h1>
    <a href="index.php?moms" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Mettings</a>
</div>
<form method="post" action="ajax_submit.php">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_name">Meeting Subject</label>
                <input type="text" name="mom_title" id="mom_title" class="form-control" placeholder="Enter the Subject" aria-describedby="user_name" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="user_date">Meeting Date</label>
                <input type="date" name="mom_date" id="mom_date" class="form-control" aria-describedby="user_name" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group fieldGroup">
                <div class="input-group">
                    <input type="text" name="mom_objective[]" id="mom_objective" class="form-control" placeholder="Objective" required />
                    <input type="text" name="mom_raise_by[]" id="mom_raise_by" class="form-control" placeholder="Raised By" required />
                    <div class="input-group-addon mx-3 mt-1">
                        <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group fieldGroupCopy" style="display: none;">
            <div class="input-group">
                <input type="text" name="mom_objective[]" id="mom_objective" class="form-control" placeholder="Objective" />
                <input type="text" name="mom_raise_by[]" id="mom_raise_by" class="form-control" placeholder="Raised By" />
                <div class="input-group-addon mx-4 mt-1">
                    <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" name="mom_submit" class="btn btn-primary btn-block btn-lg">Submit</button>
        </div>

    </div>
</form>