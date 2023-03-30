<?php

if (!empty($_GET['confirm_enquiry'])) {

?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Convert Lead to leadect</h1>
        <a href="index.php?project_enquiry" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Back</a>
    </div>
    <form method="post" action="ajax_submit.php">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="lead_id">Lead Id</label>
                    <input type="text" name="lead_id" id="lead_id" class="form-control" value="<?php echo $_GET['confirm_enquiry']; ?>" aria-describedby="lead_id" readonly>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="lead_name">Lead Name</label>
                    <input type="text" name="lead_name" id="lead_name" class="form-control" placeholder="Enter the name" aria-describedby="lead_name" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="lead_level">Lead Level</label>
                    <select id="lead_level" class="form-control" name="lead_level" required>
                        <option value="" disabled selected>Select the Level</option>
                        <option value="standard_lead">Standard</option>
                        <option value="enterprise_lead">Enterprise</option>
                        <option value="modular_lead">Modular Furniture</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="lead_type">Lead Type</label>
                    <select id="lead_type" class="form-control" name="lead_type" required>
                        <option value="" disabled selected>Select the Type</option>
                        <option value="design_build">Design & Build</option>
                        <option value="only_build">Build</option>
                    </select>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <button type="submit" name="submit_lead" class="btn btn-primary btn-block btn-lg">Submit</button>
            </div>

        </div>
    </form>
<?php } else {
    echo "<script>window.open('index.php?leadect_enquiry','_self')</script>";
} ?>