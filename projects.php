<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PROJECTS PANEL</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Project id</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0;
                    foreach (get_projects() as $values) {

                    ?>
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
                            <?php
                            $status = "";
                            if (@strpos($values[5], 'procur') == false) {
                                $status .= 'Procurment ';
                            } elseif (@strpos($values[5], 'balance') == false) {
                                $status .= 'Balance ';
                            } elseif (@strpos($values[5], 'mesure') == false) {
                                $status .= 'Mesurments ';
                            } else {
                                $status .= 'Project Complied';
                            }

                            if (@strpos($values[5], 'Complied') == false) {
                                $status .= 'Pending';
                            }


                            ?>
                            <td><?php echo ucfirst(strtolower($status));  ?>
                            </td>
                            <td>
                                <a href="index.php?project_flow=<?php echo $values[1]; ?>" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info"></i></a>
                                <a href="projectSummary_pdf.php?project_id=<?php echo $values[1]; ?>" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-download"></i></a>
                                <button type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#assignInch">
                                    <i class="fas fa-people-arrows"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="assignInch" tabindex="-1" aria-labelledby="assignInchLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="assignInchLabel">Assign Incharge</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="ajax_submit.php" method="post">
                                                    <input type="hidden" name="proj_no" value="<?php echo $values[1]; ?>">
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="incharge_id" id="exampleFormControlSelect1">
                                                            <option disabled selected>Select Incharge</option>
                                                            <?php

                                                            foreach (get_site_incharges() as $incharges) {
                                                                echo "<option value='".$incharges['user_id']."'>" . $incharges['user_name'] . "</option>";
                                                            }

                                                            ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" name="assign_incharge" type="submit" id="button-addon2">
                                                                <i class="fas fa-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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