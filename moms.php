<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">TEAM MEETINGS</h1>
    <a href="index.php?raise_mom" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-100"></i> RAISE NEW</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Title</th>
                        <th>Organiser</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0;
                    foreach (get_mom_details() as $values) { ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $values[1]; ?></td>
                            <td><?php echo get_users($values[2])['user_name']; ?></td>
                            <td>
                                <a href="mom_pdf.php?mom_id=<?php echo $values[0]; ?>" target="_blank" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info"></i>
                                </a>
                                <a href="ajax_submit.php?delete_mom=<?php echo $values[0]; ?>" class="btn btn-danger btn-circle btn-sm">
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