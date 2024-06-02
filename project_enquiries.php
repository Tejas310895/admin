<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-plus fa-fw"></i> Add Enquiry
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="ajax_submit.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Enquiry Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control" name="customer_name" id="exampleFormControlInput1" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Mobile Number</label>
                                    <input type="number" class="form-control" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="customer_contact" id="exampleFormControlInput1" placeholder="Enter Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" class="form-control" name="customer_email" id="exampleFormControlInput1" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Enqiry Description</label>
                                    <textarea class="form-control" name="customer_desc" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="enquiry_submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        </div>
        <div class="col-12">
            <ul class="nav nav-tabs border border-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="open-enq-tab" data-toggle="tab" href="#open" role="tab" aria-controls="home" aria-selected="true">NEW ENQUIRES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pen-enq-tab" data-toggle="tab" href="#pen" role="tab" aria-controls="profile" aria-selected="false">PENDING ENQUIRES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="close-enq-tab" data-toggle="tab" href="#close" role="tab" aria-controls="contact" aria-selected="false">CLOSED ENQUIRES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-enq-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="contact" aria-selected="false">CANCELLED ENQUIRES</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-enq-tab">
                    <div class="card shadow mb-4 border border-0">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach (get_enquiries('initiated') as $values) { ?>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 my-3">
                                        <div class="card shadow">
                                            <div class="card-header bg-white">
                                                APN - <?php echo $values[1]; ?> (Received <?php echo get_past_days(date("Y-m-d", strtotime($values[8]))); ?>)
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item text-uppercase"><?php echo $values[2]; ?></li>
                                                <li class="list-group-item"><?php echo $values[4]; ?></li>
                                                <li class="list-group-item"><?php echo $values[3]; ?></li>
                                            </ul>
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $values[5] ?></p>
                                            </div>
                                            <div class="card-footer p-0">
                                                <div class="btn-group btn-group-lg w-100" role="group" aria-label="Basic example">
                                                    <a type="button" href="index.php?confirm_enquiry=<?php echo $values[1]; ?>" class="btn btn-success rounded-0">Accept</a>
                                                    <a type="button" href="ajax_submit.php?enquiry_id=<?php echo $values[0]; ?>&enquiry_status=on_hold" class="btn btn-warning rounded-0">Hold</a>
                                                    <a type="button" href="ajax_submit.php?enquiry_id=<?php echo $values[0]; ?>&enquiry_status=cancel" class="btn btn-danger rounded-0" onclick="return confirm('Are you sure you want to Cancle?');">Cancle</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pen" role="tabpanel" aria-labelledby="pen-enq-tab">
                    <div class="card shadow mb-4 border border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Application no</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Conatct</th>
                                            <th>Pending Since</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0; ?>
                                        <?php foreach (get_enquiries('on_hold') as $values) { ?>
                                            <tr>
                                                <td class="p-1"><?php echo ++$counter ?></td>
                                                <td class="p-1">
                                                    <h6 title="<?php echo $values[5]; ?>"><?php echo $values[1]; ?></h6>
                                                </td>
                                                <td class="p-1"><?php echo $values[2]; ?></td>
                                                <td class="p-1"><?php echo $values[3]; ?></td>
                                                <td class="p-1"><?php echo $values[4]; ?></td>
                                                <td class="p-1"><?php echo get_past_days(date("Y-m-d", strtotime($values[8]))); ?></td>
                                                <td class="p-0">
                                                    <div class="btn-group w-100 rounded-bottom" role="group" aria-label="Basic example">
                                                        <a href="index.php?confirm_enquiry=<?php echo $values[1]; ?>" class="btn btn-success">Accept</a>
                                                        <a type="button" href="ajax_submit.php?enquiry_id=<?php echo $values[0]; ?>&enquiry_status=cancel" class="btn btn-danger rounded-0" onclick="return confirm('Are you sure you want to Cancle?');">Cancle</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="close" role="tabpanel" aria-labelledby="close-enq-tab">
                    <div class="card shadow mb-4 border border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Application no</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Conatct</th>
                                            <th>Closed On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0; ?>
                                        <?php foreach (get_enquiries('closed') as $values) { ?>
                                            <tr>
                                                <td class="p-1"><?php echo ++$counter ?></td>
                                                <td class="p-1">
                                                    <h6 title="<?php echo $values[5]; ?>"><?php echo $values[1]; ?></h6>
                                                </td>
                                                <td class="p-1"><?php echo $values[2]; ?></td>
                                                <td class="p-1"><?php echo $values[3]; ?></td>
                                                <td class="p-1"><?php echo $values[4]; ?></td>
                                                <td class="p-1"><?php echo date("Y-m-d", strtotime($values[8])); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-enq-tab">
                    <div class="card shadow mb-4 border border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Application no</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Conatct</th>
                                            <th>Cancelled On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0; ?>
                                        <?php foreach (get_enquiries('cancel') as $values) { ?>
                                            <tr>
                                                <td class="p-1"><?php echo ++$counter; ?></td>
                                                <td class="p-1">
                                                    <h6 title="<?php echo $values[5]; ?>"><?php echo $values[1]; ?></h6>
                                                </td>
                                                <td class="p-1"><?php echo $values[2]; ?></td>
                                                <td class="p-1"><?php echo $values[3]; ?></td>
                                                <td class="p-1"><?php echo $values[4]; ?></td>
                                                <td class="p-1"><?php echo date("d-m-Y", strtotime($values[8])); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>