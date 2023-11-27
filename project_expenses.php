<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PROJECT EXPENSES</h1>
    <a href="index.php?insert_expense" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> ADD NEW</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Lead id</th>
                        <th>Expense Title</th>
                        <th>Type</th>
                        <th>Expense File</th>
                        <th>Expense Amount</th>
                        <th>Entered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (get_project_expenses() as $vals) { ?>
                        <tr>
                            <td><?php echo $vals[1]; ?></td>
                            <td><?php echo $vals[2]; ?></td>
                            <td><?php echo $vals[5]; ?></td>
                            <td>
                                <a href="https://images.ssarchindia.com/uploads/<?php echo $vals[4]; ?>" target="_blank" class="btn btn-info btn-icon-split">
                                    <span class="icon text-white">
                                        <i class="fas fa-pen-fancy"></i>
                                    </span>
                                    <span class="text">Open file</span>
                                </a>
                            </td>
                            <td><?php echo $vals[3]; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($vals[7])); ?></td>
                            <td>
                                <a href="ajax_submit.php?delete_expenses=<?php echo $vals[0]; ?>" class="btn btn-danger btn-circle btn-sm">
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