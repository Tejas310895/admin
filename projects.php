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
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>