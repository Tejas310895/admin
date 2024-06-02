<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">TEAM DETAILS</h1>
    <a href="index.php?insert_user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> ADD NEW</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Conatct</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0;
                    foreach (get_users() as $values) { ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $values[1]; ?></td>
                            <td><?php echo $values[2]; ?></td>
                            <td>+91 <?php echo $values[3]; ?></td>
                            <td><?php if ($values[6] == 'project_lead') {
                                    echo "Project Lead";
                                } elseif ($values[6] == 'design_lead') {
                                    echo "Design Lead";
                                } elseif ($values[6] == 'accounts_lead') {
                                    echo "Accounts Lead";
                                } elseif ($values[6] == 'site_incharge') {
                                    echo "Site Incharge";
                                } elseif ($values[6] == 'site_staff') {
                                    echo "Site Staff";
                                }

                                ?></td>
                            <td>
                                <a href="index.php?edit_user=<?php echo $values[0]; ?>" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="ajax_submit.php?user_auth=<?php echo $values[0]; ?>" class="btn <?php if ($values[5] == 'dorment') {
                                                                                                                echo 'btn-success';
                                                                                                            } else {
                                                                                                                echo 'btn-warning';
                                                                                                            } ?> btn-circle btn-sm">
                                    <?php if ($values[5] == 'dorment') { ?>
                                        <i class="fas fa-unlock"></i>
                                    <?php } else { ?>
                                        <i class="fas fa-lock"></i>
                                    <?php } ?>
                                </a>
                                <a href="ajax_submit.php?user_delete=<?php echo $values[0]; ?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Are you sure you want to delete?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>