<?php $lead_data = get_project_complete("'project_initiated'", $_GET['project_flow']) ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Project Flow - <?php echo $lead_data[0][0]; ?></h1>
    <a href="index.php?projects" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Projects</a>
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
                <p class="card-text"><?php echo $lead_data[0][5]; ?></p>
            </div>
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header bg-info py-3">
                <h4 class="m-0 font-weight-bold text-white">Design & Estimations Logs</h4>
            </div>
            <div class="card-body p-1" style="overflow-y: scroll;">
                <table class="table table-light text-center mb-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th> Entered By </th>
                            <th> Designs </th>
                            <th> Estimations </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get_designs($lead_data[0][0]) as $vals) { ?>
                            <tr>
                                <td><?php echo get_sql_single_data('user_name', 'users', "user_id='$vals[5]'")[0][0]; ?></td>
                                <td>
                                    <a href="../uploads/<?php echo $vals[2]; ?>" target="_blank" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-pen-fancy"></i>
                                        </span>
                                        <span class="text">Open design</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="../uploads/<?php echo $vals[3]; ?>" target="_blank" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                        <span class="text">Open estimation</span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>