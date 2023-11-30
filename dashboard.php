<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Enquiries</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count(get_enquiries('initiated')); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Closed Enquiries</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count(get_enquiries('closed')); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <?php
                                $progress_table = array_column(get_task_progress(), 'prog');
                                $progress = round(array_sum($progress_table) / count($progress_table) * 100);
                                ?>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $progress; ?></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $progress; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Enquiries</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count(get_enquiries('on_hold')); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
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