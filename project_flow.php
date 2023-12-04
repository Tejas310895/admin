<?php
if (!empty(get_project_complete($_GET['project_flow']))) {
    $lead_data = get_project_complete($_GET['project_flow']);
} else {
    echo "<script>window.open('index.php','_self')</script>";
}
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Project Flow - <?php echo $lead_data[0][0]; ?> <small class="badge badge-primary"> Assigned To <?php echo get_sql_single_data('user_name', 'users', "user_id='" . $lead_data[0][7] . "'")[0][0]; ?></small></h1>
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
            <div class="card-header bg-info py-2">
                <h6 class="m-0 font-weight-bold text-white">Document Logs</h6>
            </div>
            <div class="card-body p-1" style="overflow-y: scroll;">
                <table class="table table-striped text-center mb-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th> Document Type </th>
                            <th> Entered By </th>
                            <th> Files </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get_docs($lead_data[0][0], 'designs_estimations') as $vals) { ?>
                            <tr>
                                <td>Designs and Estimations</td>
                                <td><?php echo get_sql_single_data('user_name', 'users', "user_id='$vals[6]'")[0][0]; ?></td>
                                <td>
                                    <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[2]; ?>" target="_blank" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-pen-fancy"></i>
                                        </span>
                                        <span class="text">Open design</span>
                                    </a>
                                    <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[3]; ?>" target="_blank" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                        <span class="text">Open estimation</span>
                                    </a>
                                    <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[3]; ?>" target="_blank" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach (get_docs($lead_data[0][0], 'procurments') as $vals) { ?>
                            <tr>
                                <td>Procurment</td>
                                <td><?php echo get_sql_single_data('user_name', 'users', "user_id='$vals[4]'")[0][0]; ?></td>
                                <td>
                                    <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[2]; ?>" target="_blank" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-pen-fancy"></i>
                                        </span>
                                        <span class="text">Open Procurment</span>
                                    </a>
                                    <a href="ajax_submit.php?procur_delete=<?php echo $vals[3]; ?>" target="_blank" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach (get_docs($lead_data[0][0], 'balance_sheets') as $vals) { ?>
                            <tr>
                                <td>Balance Sheet</td>
                                <td><?php echo get_sql_single_data('user_name', 'users', "user_id='$vals[4]'")[0][0]; ?></td>
                                <td>
                                    <a href="ajax_submit.php?balance_delete=<?php echo $vals[2]; ?>" target="_blank" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-pen-fancy"></i>
                                        </span>
                                        <span class="text">Open Balance Sheet</span>
                                    </a>
                                    <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[3]; ?>" target="_blank" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php //foreach (get_docs($lead_data[0][0], 'mesurments') as $vals) { 
                        ?>
                        <!-- <tr>
                                <td>Mesurments</td>
                                <td><?php //echo get_sql_single_data('user_name', 'users', "user_id='$vals[4]'")[0][0]; 
                                    ?></td>
                                <td>
                                    <a href="https://images.ssarchindia.com/uploads/<?php //echo $vals[2]; 
                                                                                    ?>" target="_blank" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-pen-fancy"></i>
                                        </span>
                                        <span class="text">Open Mesurment</span>
                                    </a>
                                    <a href="ajax_submit.php?mesure_delete=<?php //echo $vals[3]; 
                                                                            ?>" target="_blank" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">delete</span>
                                    </a>
                                </td>
                            </tr> -->
                        <?php //} 
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (!empty(get_expense_flow($lead_data[0][0]))) { ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-2">
                    <h6 class="m-0 font-weight-bold text-white">Project Expenses</h6>
                </div>
                <div class="card-body p-1" style="overflow-y: scroll;">
                    <table class="table table-striped text-center mb-0">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th> Entered By </th>
                                <th> Expense Type </th>
                                <th> Expense Amount </th>
                                <th> Files </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (get_expense_flow($lead_data[0][0]) as $vals) { ?>
                                <tr>
                                    <td><?php echo get_sql_single_data('user_name', 'users', "user_id='$vals[6]'")[0][0]; ?></td>
                                    <td><?php echo $vals[2]; ?></td>
                                    <td><?php echo $vals[3]; ?></td>
                                    <td>
                                        <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[4]; ?>" target="_blank" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>
                                            <span class="text">Open file</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty(get_measurements($lead_data[0][0]))) { ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-2">
                    <h6 class="m-0 font-weight-bold text-white">Project Measurements</h6>
                </div>
                <div class="card-body p-1" style="overflow-y: scroll;">
                    <table class="table table-striped text-center mb-0">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th> Entered By </th>
                                <th> title </th>
                                <th> Category </th>
                                <th> Length </th>
                                <th> Width </th>
                                <th> Height </th>
                                <th> Quantity </th>
                                <th> Unit </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (get_measurements($lead_data[0][0]) as $vals) { ?>
                                <tr>
                                    <td><?php $user_id = $vals['entered_by'];
                                        echo get_sql_single_data('user_name', 'users', "user_id=$user_id")[0][0]; ?></td>
                                    <td><?php echo $vals['m_title']; ?></td>
                                    <td><?php echo $vals['m_category']; ?></td>
                                    <td><?php echo $vals['m_length']; ?></td>
                                    <td><?php echo $vals['m_width']; ?></td>
                                    <td><?php echo $vals['m_height']; ?></td>
                                    <td><?php echo $vals['m_qty']; ?></td>
                                    <td><?php echo $vals['m_unit']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty(get_tasks($lead_data[0][0]))) { ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-2">
                    <h6 class="m-0 font-weight-bold text-white">Project Tasks</h6>
                </div>
                <div class="card-body p-1" style="overflow-y: scroll;">
                    <table class="table table-striped text-center mb-0">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th> Task By </th>
                                <th> Task To </th>
                                <th> title </th>
                                <th> Description </th>
                                <th> Views </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (get_tasks($lead_data[0][0]) as $vals) { ?>
                                <tr>
                                    <td><?php $user_id1 = $vals['task_by'];
                                        echo get_sql_single_data('user_name', 'users', "user_id=$user_id1")[0][0]; ?></td>
                                    <td><?php $user_id2 = $vals['task_to'];
                                        echo get_sql_single_data('user_name', 'users', "user_id=$user_id2")[0][0];; ?></td>
                                    <td><?php echo $vals['task_title']; ?></td>
                                    <td><?php echo $vals['task_desc']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                            <?php echo count(get_tasks_uploads($vals['task_id'])); ?>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Views</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <?php foreach (get_tasks_uploads($vals['task_id']) as $uploads) { ?>
                                                                <div class="col-2">
                                                                    <!-- <div class="card col-3">
                                                                        <div class="card-body"> -->
                                                                    <img class="img-fluid" src="<?php echo $assets_url . $uploads['upload_link']; ?>" alt="">
                                                                    <!-- </div>
                                                                    </div> -->
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>

</div>