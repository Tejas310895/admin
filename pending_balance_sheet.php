<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PENDING FOR BALANCE SHEET</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Lead id</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Pending Since</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0;
                    foreach (get_projects("balance") as $values) { ?>
                        <tr>
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
                            <td><?php echo get_past_days($values[7]); ?></td>
                            <td>
                                <a href="index.php?balance_upload=<?php echo $values[1]; ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>