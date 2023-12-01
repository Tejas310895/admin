<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <?php foreach (get_project_progress() as $vals) {
                $progress_ind = round(($vals['prog'] / $vals['total_prog']) * 100);
            ?>
                <div class="card-body">
                    <h4 class="small font-weight-bold"><?php echo $vals['proj_id']; ?> <span class="float-right"><?php echo $progress_ind; ?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-<?php echo ($progress_ind < 30) ? 'danger' : (($progress_ind < 50) ? 'warning' : 'success'); ?>" role="progressbar" style="width: <?php echo $progress_ind ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>