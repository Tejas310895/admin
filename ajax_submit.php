<?php

include("includes/db.php");

if (isset($_POST['insert__form'])) {
    $insert_user_data = $_POST['insert__form'];
    $u_name = $insert_user_data[0]['value'];
    $u_email = $insert_user_data[1]['value'];
    $u_contact = $insert_user_data[2]['value'];
    $u_role = $insert_user_data[3]['value'];
    $u_pass = password_hash('pass123', PASSWORD_DEFAULT);

    $sql = "INSERT INTO users values ('default','$u_name','$u_email','$u_contact','$u_pass','active','$u_role',NOW(),NOW())";

    if ($con->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['c_email'])) {
    $c_email = $_POST['c_email'];
    $sql = "SELECT * FROM users WHERE user_email='$c_email'";
    $results = $con->query($sql);
    if ($results->num_rows >= 1) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['edit__form'])) {
    $edit_user_data = $_POST['edit__form'];
    $u_id = $edit_user_data[0]['value'];
    $u_name = $edit_user_data[1]['value'];
    $u_contact = $edit_user_data[2]['value'];
    $u_role = $edit_user_data[3]['value'];


    $sql = "UPDATE users SET user_name='$u_name',user_contact='$u_contact',user_role='$u_role',user_updated_at=NOW() WHERE user_id='$u_id'";

    if ($con->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_GET['user_auth'])) {
    $u_auth = $_GET['user_auth'];
    $sql = "SELECT user_status FROM users WHERE user_id='$u_auth'";
    $results = $con->query($sql);
    if ($results->fetch_assoc()['user_status'] == 'active') {
        $sql = "UPDATE users SET user_status='dorment' WHERE user_id='$u_auth'";
        if ($con->query($sql) === TRUE) {
            echo "<script>window.open('index.php?users','_self')</script>";
        }
    } else {
        $sql = "UPDATE users SET user_status='active' WHERE user_id='$u_auth'";
        if ($con->query($sql) === TRUE) {
            echo "<script>window.open('index.php?users','_self')</script>";
        }
    }
}

if (isset($_GET['user_delete'])) {
    $u_del = $_GET['user_delete'];
    $sql = "UPDATE users SET user_status='inactive' WHERE user_id='$u_del'";
    if ($con->query($sql) === TRUE) {
        echo "<script>window.open('index.php?users','_self')</script>";
    }
}

if (isset($_GET['enquiry_id'])) {
    $enquiry_id = $_GET['enquiry_id'];
    $enquiry_status = $_GET['enquiry_status'];

    $sql = "UPDATE project_enquiries SET enquiry_status='$enquiry_status',enquiry_updated_at=NOW() WHERE enquiry_id='$enquiry_id'";

    if ($con->query($sql)) {
        echo "<script>alert('Status updated successfully')</script>";
        echo "<script>window.open('index.php?project_enquiry','_self')</script>";
    }
}

if (isset($_POST['submit_lead'])) {
    $lead_id = $_POST['lead_id'];
    $lead_name = $_POST['lead_name'];
    $lead_level = $_POST['lead_level'];
    $lead_type = $_POST['lead_type'];

    $sql = "INSERT INTO leads VALUES ('default','$lead_id','$lead_level','$lead_type','$lead_name','design_pending',NOW(),NOW());";
    $sql .= "UPDATE project_enquiries SET enquiry_status='closed',enquiry_updated_at=NOW() WHERE application_no='$lead_id'";

    if ($con->multi_query($sql)) {
        echo "<script>alert('Lead generated successfully')</script>";
        echo "<script>window.open('index.php?leads','_self')</script>";
    } else {
        echo "<script>alert('Lead generation failed! Try again')</script>";
        echo "<script>window.history.back()</script>";
    }
}

if (isset($_POST['design_submit'])) {
    $target_dir = "../images/uploads/";
    $design_file_name =  "D_" . random_int(10000000, 99999999) . basename($_FILES["design_file"]["name"]);
    $estimation_file_name =  "E_" . random_int(10000000, 99999999) . basename($_FILES["estimation_file"]["name"]);
    $design_file = $target_dir . $design_file_name;
    $estimation_file = $target_dir . $estimation_file_name;
    $design_note = $_POST['design_note'];
    $design_lead_no = $_POST['lead_no'];
    $design_check = $_FILES["design_file"]["tmp_name"];
    $estimation_check = $_FILES["estimation_file"]["tmp_name"];
    if (!empty($design_check) && !empty($estimation_check)) {
        if (move_uploaded_file($_FILES["design_file"]["tmp_name"], $design_file) && move_uploaded_file($_FILES["estimation_file"]["tmp_name"], $estimation_file)) {

            $sql = "INSERT INTO designs_estimations VALUES ('default','$design_lead_no','$design_file_name','$estimation_file_name','pending',1,NOW(),NOW());";
            $sql .= "UPDATE leads SET lead_status='approval_pending',lead_updated_at=NOW() WHERE lead_no='$design_lead_no'";

            if ($con->multi_query($sql)) {
                echo "<script>alert('Files uploaded succesfully')</script>";
                echo "<script>window.open('index.php?pending_designs','_self')</script>";
            } else {
                echo "<script>alert('File upload failed! Try again')</script>";
                echo "<script>window.open('index.php?pending_designs','_self')</script>";
            }
        } else {
            echo "<script>alert('File upload failed Try again')</script>";
            echo "<script>window.open('index.php?design_upload=$design_lead_no','_self')</script>";
        }
    } else {
        echo "<script>alert('File upload failed ! Try again')</script>";
        echo "<script>window.open('index.php?design_upload=$design_lead_no','_self')</script>";
    }
}

if (isset($_GET['design_status_id'])) {
    $d_e_id = $_GET['design_status_id'];
    $d_e_status = $_GET['d_e_status'];

    if ($d_e_status == 'finalize') {
        $get_lead_sql = "SELECT * FROM leads WHERE lead_no='$d_e_id'";
        $get_lead_results = $con->query($get_lead_sql);
        if ($get_lead_results->num_rows > 0) {
            $lead_data = $get_lead_results->fetch_assoc();
            $lead_no = $lead_data['lead_no'];
            $lead_level = $lead_data['lead_level'];
            $lead_type = $lead_data['lead_type'];
            $lead_name = $lead_data['lead_name'];
            $sql = "UPDATE designs_estimations SET d_e_status='finalized',d_e_updated_at=NOW() WHERE lead_no='$d_e_id';";
            $sql .= "UPDATE leads SET lead_status='design_finalized',lead_updated_at=NOW() WHERE lead_no='$d_e_id';";
            $sql .= "INSERT INTO projects VALUES ('default','$lead_no','$lead_level','$lead_type','$lead_name','project_initiated',NOW(),NOW())";
        } else {
            die();
        }
    } else {
        $get_file_sql = "SELECT design_file_id,estimation_file_id FROM designs_estimations WHERE lead_no ='$d_e_id'";
        $results = $con->query($get_file_sql);
        if ($results->num_rows > 0) {
            $data = $results->fetch_all();
            $un_design_file = $data[0][0];
            $un_estimation_file = $data[0][1];
        }
        if (file_exists("../images/uploads/$un_design_file") && file_exists("../images/uploads/$un_estimation_file")) {
            if (unlink("../images/uploads/$un_design_file") && unlink("../images/uploads/$un_estimation_file")) {
                $sql = "DELETE FROM designs_estimations WHERE lead_no='$d_e_id';";
                $sql .= "UPDATE leads SET lead_status='design_pending',lead_updated_at=NOW() WHERE lead_no='$d_e_id'";
            }
        }
    }

    if ($con->multi_query($sql)) {
        echo "<script>alert('Designs approved successfully')</script>";
        echo "<script>window.open('index.php?leads','_self')</script>";
    } else {
        echo "<script>alert('Designs sent for rework')</script>";
        echo "<script>window.open('index.php?leads','_self')</script>";
    }
}
