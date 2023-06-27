<?php $lead_data = get_project_complete($_GET['balance_upload']) ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lead Flow - <?php echo $_GET['balance_upload']; ?></h1>
    <a href="index.php?pending_designs" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Pending Balance Sheets</a>
</div>
<div class="row">


    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 mb-2">
        <div class="card p-1">
            <div class="card-header bg-info text-white p-2">
                Lead Id
            </div>
            <div class="card-body p-2">
                <p class="card-text"><?php echo $lead_data[0][0]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 mb-2">
        <div class="card p-1">
            <div class="card-header bg-info text-white p-2">
                Lead Title
            </div>
            <div class="card-body p-2">
                <p class="card-text"><?php echo $lead_data[0][1]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 mb-2">
        <div class="card p-1">
            <div class="card-header bg-info text-white p-2">
                Enquired by
            </div>
            <div class="card-body p-2">
                <p class="card-text"><?php echo $lead_data[0][4]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 mb-2">
        <div class="card p-1">
            <div class="card-header bg-info text-white p-2">
                Contact
            </div>
            <div class="card-body p-2">
                <p class="card-text">+91 <?php echo $lead_data[0][5]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
        <div class="card p-1">
            <div class="card-header bg-info text-white p-2">
                Description
            </div>
            <div class="card-body p-2">
                <p class="card-text">
                    <?php echo $lead_data[0][6]; ?>
                </p>
            </div>
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header bg-info py-3">
                <h4 class="m-0 font-weight-bold text-white">Upload Balance Sheet Files</h4>
            </div>
            <div class="card-body p-1">
                <table class="table table-light text-center mb-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th> Balance Sheet </th>
                            <th> Note </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="ajax_submit.php" method="post" enctype="multipart/form-data">
                            <tr>
                                <td>
                                    <input type="hidden" name="lead_no" value="<?php echo $lead_data[0][0]; ?>">
                                    <div class="mb-3 custom-file-button">
                                        <input class="form-control" type="file" id="formFile" name="balance_file">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="input" class="form-control" placeholder="Enter Your Note" name="balance_note" required="required">
                                </td>
                                <td>
                                    <button type="submit" name="balance_submit" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </span>
                                        <span class="text">Submit</span>
                                    </button>
                                </td>
                            </tr>
                        </form>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>