<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LEADS PANEL</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Lead id</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0;
                    foreach (get_leads() as $values) { ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $values[1]; ?></td>
                            <td><?php echo $values[4]; ?></td>
                            <td><?php if ($values[2] == 'standard_lead') {
                                    echo "Standard Lead";
                                } elseif ($values[2] == 'enterprise_lead') {
                                    echo "Enterprise Lead";
                                } elseif ($values[2] == 'modular_lead') {
                                    echo "Modular Lead";
                                } ?></td>
                            <td><?php if ($values[3] == 'design_build') {
                                    echo "Design & Build";
                                } elseif ($values[3] == 'only_build') {
                                    echo "Build";
                                } ?>
                            </td>
                            <td><?php if ($values[5] == 'design_pending') {
                                    echo "Pending for designs & Estimation";
                                } elseif ($values[5] == 'approval_pending') {
                                    echo "Pending for approval";
                                } elseif ($values[5] == 'design_approved') {
                                    echo "Pending for Finalizing";
                                } else {
                                    echo "Converted to project";
                                } ?>
                            </td>
                            <td>
                                <?php if ($values[5] == 'design_finalized') { ?>
                                    <a href="index.php?project_flow=<?php echo $values[1]; ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info"></i>
                                    <?php } else { ?>
                                        <a href="index.php?lead_flow=<?php echo $values[1]; ?>" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>