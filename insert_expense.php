<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Member</h1>
    <a href="index.php?project_expenses" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Expenses</a>
</div>
<form method="post" action="ajax_submit.php" enctype="multipart/form-data">
    <input type="hidden" name="entered_by" value="<?php echo $_SESSION['user']; ?>">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="project_no">Project Id</label>
                <select id="project_no" class="form-control" name="project_no" required>
                    <option value="" disabled selected>Select the Projects</option>
                    <?php foreach (get_projects() as $vals) { ?>
                        <option value="<?php echo $vals[1]; ?>"><?php echo $vals[1]; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="expense_type">Expense Title</label>
                <input type="text" name="expense_type" id="expense_type" class="form-control" placeholder="Enter expense title" aria-describedby="user_email" required>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="expense_type">Expense Amount</label>
                <input type="number" name="expense_amt" id="expense_amt" class="form-control" placeholder="Enter expense amount" aria-describedby="user_email" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="expense_cat">Expense Purpose</label>
                <select id="expense_cat" class="form-control" name="expense_cat" required>
                    <option value="" disabled selected>Select the purpose</option>
                    <option>Material Purchase</option>
                    <option>Office Expense</option>
                    <option>Labour</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="mb-3 custom-file-button">
                <label for="expense_proof">Expense file</label>
                <input class="form-control" type="file" id="expense_proof" name="expense_proof">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" name="expense_submit" class="btn btn-primary btn-block btn-lg">Submit</button>
        </div>

    </div>
</form>