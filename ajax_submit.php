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

if (isset($_POST['procurment_submit'])) {
    $user_id = $_SESSION['user'];
    $target_dir = "../images/uploads/";
    $procurment_file_name =  "P_" . random_int(10000000, 99999999) . basename($_FILES["procurment_file"]["name"]);
    $procurment_file = $target_dir . $procurment_file_name;
    $procurment_note = $_POST['procurment_note'];
    $procurment_lead_no = $_POST['lead_no'];
    $procurment_check = $_FILES["procurment_file"]["tmp_name"];
    $sql_pre = "SELECT project_status FROM projects WHERE project_no='$procurment_lead_no'";
    $project_array = $con->query($sql_pre)->fetch_all();
    $project_status = $project_array[0][0];
    $project_status .= "_procur";
    if (!empty($procurment_check)) {
        if (move_uploaded_file($_FILES["procurment_file"]["tmp_name"], $procurment_file)) {

            $sql = "INSERT INTO procurments VALUES ('default','$procurment_lead_no','$procurment_file_name','pending','$user_id',NOW(),NOW());";
            $sql .= "UPDATE projects SET project_status='$project_status',project_updated_at=NOW() WHERE project_no='$procurment_lead_no'";

            if ($con->multi_query($sql)) {
                echo "<script>alert('Files uploaded succesfully')</script>";
                echo "<script>window.open('index.php?pending_procurment','_self')</script>";
            } else {
                echo "<script>alert('File upload failed! Try again')</script>";
                echo "<script>window.open('index.php?procurment_upload','_self')</script>";
            }
        } else {
            echo "<script>alert('File upload failed Try again')</script>";
            echo "<script>window.open('index.php?procurment_upload=$procurment_lead_no','_self')</script>";
        }
    } else {
        echo "<script>alert('File upload failed ! Try again')</script>";
        echo "<script>window.open('index.php?procurment_upload=$procurment_lead_no','_self')</script>";
    }
}

if (isset($_POST['balance_submit'])) {
    $user_id = $_SESSION['user'];
    $target_dir = "../images/uploads/";
    $balance_file_name =  "B_" . random_int(10000000, 99999999) . basename($_FILES["balance_file"]["name"]);
    $balance_file = $target_dir . $balance_file_name;
    $balance_note = $_POST['balance_note'];
    $balance_lead_no = $_POST['lead_no'];
    $balance_check = $_FILES["balance_file"]["tmp_name"];
    $sql_pre = "SELECT project_status FROM projects WHERE project_no='$procurment_lead_no'";
    $project_array = $con->query($sql_pre)->fetch_all();
    $project_status = $project_array[0][0];
    $project_status .= "_balance";
    if (!empty($balance_check)) {
        if (move_uploaded_file($_FILES["balance_file"]["tmp_name"], $balance_file)) {

            $sql = "INSERT INTO balance_sheets VALUES ('default','$balance_lead_no','$balance_file_name','pending','$user_id',NOW(),NOW());";
            $sql .= "UPDATE projects SET project_status='$project_status',project_updated_at=NOW() WHERE project_no='$balance_lead_no'";

            if ($con->multi_query($sql)) {
                echo "<script>alert('Files uploaded succesfully')</script>";
                echo "<script>window.open('index.php?pending_balance_sheet','_self')</script>";
            } else {
                echo "<script>alert('File upload failed! Try again')</script>";
                echo "<script>window.open('index.php?balance_upload','_self')</script>";
            }
        } else {
            echo "<script>alert('File upload failed Try again')</script>";
            echo "<script>window.open('index.php?balance_upload=$balance_lead_no','_self')</script>";
        }
    } else {
        echo "<script>alert('File upload failed ! Try again')</script>";
        echo "<script>window.open('index.php?balance_upload=$balance_lead_no','_self')</script>";
    }
}

if (isset($_POST['expense_submit'])) {
    $user_id = $_SESSION['user'];
    $target_dir = "../images/uploads/";
    $e_project_no = $_POST['project_no'];
    $e_expense_type = $_POST['expense_type'];
    $e_expense_amt = $_POST['expense_amt'];
    $e_expense_cat = $_POST['expense_cat'];
    $expense_file_name =  "EX_" . random_int(10000000, 99999999) . basename($_FILES["expense_proof"]["name"]);
    $expense_file = $target_dir . $expense_file_name;
    $e_expense_proof = $_FILES["expense_proof"]["tmp_name"];

    if (!empty($e_expense_proof)) {
        if (move_uploaded_file($_FILES["expense_proof"]["tmp_name"], $expense_file)) {
            $sql = "INSERT INTO project_expenses VALUES (default,'$e_project_no','$e_expense_type','$e_expense_amt','$expense_file_name','$e_expense_cat','$user_id',NOW(),NOW())";
            if ($con->query($sql)) {
                echo "<script>alert('Expenses added successfully')</script>";
                echo "<script>window.open('index.php?project_expenses','_self')</script>";
            } else {
                echo "<script>alert('Operation failed! Try again')</script>";
                echo "<script>window.open('index.php?insert_expense','_self')</script>";
            }
        }
    }
}

if (isset($_POST['mesurment_submit'])) {
    $user_id = $_SESSION['user'];
    $target_dir = "../images/uploads/";
    $mesurment_file_name =  "M_" . random_int(10000000, 99999999) . basename($_FILES["mesurment_file"]["name"]);
    $mesurment_file = $target_dir . $mesurment_file_name;
    $mesurment_note = $_POST['mesurment_note'];
    $mesurment_lead_no = $_POST['lead_no'];
    $mesurment_check = $_FILES["mesurment_file"]["tmp_name"];
    $sql_pre = "SELECT project_status FROM projects WHERE project_no='$mesurment_lead_no'";
    $project_array = $con->query($sql_pre)->fetch_all();
    $project_status = $project_array[0][0];
    $project_status .= "_mesure";
    if (!empty($mesurment_check)) {
        if (move_uploaded_file($_FILES["mesurment_file"]["tmp_name"], $mesurment_file)) {

            $sql = "INSERT INTO mesurments VALUES ('default','$mesurment_lead_no','$mesurment_file_name','pending',$user_id,NOW(),NOW());";
            $sql .= "UPDATE projects SET project_status='$project_status',project_updated_at=NOW() WHERE project_no='$mesurment_lead_no'";

            if ($con->multi_query($sql)) {
                echo "<script>alert('Files uploaded succesfully')</script>";
                echo "<script>window.open('index.php?pending_mesurments','_self')</script>";
            } else {
                echo "<script>alert('File upload failed! Try again')</script>";
                echo "<script>window.open('index.php?mesurment_upload','_self')</script>";
            }
        } else {
            echo "<script>alert('File upload failed Try again')</script>";
            echo "<script>window.open('index.php?mesurment_upload=$mesurment_lead_no','_self')</script>";
        }
    } else {
        echo "<script>alert('File upload failed ! Try again')</script>";
        echo "<script>window.open('index.php?mesurment_upload=$mesurment_lead_no','_self')</script>";
    }
}

if (isset($_GET['procur_delete'])) {
    $p_id = $_GET['procur_delete'];
    $get_file_sql = "SELECT procurment_file_id FROM procurments WHERE lead_no ='$p_id'";
    $results = $con->query($get_file_sql);
    if ($results->num_rows > 0) {
        $data = $results->fetch_all();
        $un_procur_file = $data[0][0];
    }
    $get_file_status  = "SELECT project_status FROM projects WHERE project_no='$p_id'";
    $status_dump = $con->query($get_file_sql);
    if ($status_dump->num_rows > 0) {
        $data = $status_dump->fetch_all();
        $project_status = $data[0][0];
    }
    $project_status = str_replace("_procur", "", $project_status);
    if (file_exists("../images/uploads/$un_procur_file")) {
        if (unlink("../images/uploads/$un_procur_file")) {
            $sql = "DELETE FROM procurments WHERE lead_no='$p_id';";
            $sql .= "UPDATE projects SET project_status='$project_status',lead_updated_at=NOW() WHERE project_no='$p_id'";
        }
    }
    if ($con->multi_query($sql)) {
        echo "<script>alert('Deleted successfully')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    } else {
        echo "<script>alert('Failed! Try again')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    }
}

if (isset($_GET['balance_delete'])) {
    $b_id = $_GET['balance_delete'];
    $get_file_sql = "SELECT balance_sheet_file FROM balance_sheets WHERE lead_no ='$b_id'";
    $results = $con->query($get_file_sql);
    if ($results->num_rows > 0) {
        $data = $results->fetch_all();
        $un_balance_file = $data[0][0];
    }
    $get_file_status  = "SELECT project_status FROM projects WHERE project_no='$b_id'";
    $status_dump = $con->query($get_file_sql);
    if ($status_dump->num_rows > 0) {
        $data = $status_dump->fetch_all();
        $project_status = $data[0][0];
    }
    $project_status = str_replace("_balance", "", $project_status);
    if (file_exists("../images/uploads/$un_balance_file")) {
        if (unlink("../images/uploads/$un_balance_file")) {
            $sql = "DELETE FROM balance_sheets WHERE lead_no='$b_id';";
            $sql .= "UPDATE projects SET project_status='$project_status',lead_updated_at=NOW() WHERE project_no='$b_id'";
        }
    }
    if ($con->multi_query($sql)) {
        echo "<script>alert('Deleted successfully')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    } else {
        echo "<script>alert('Failed! Try again')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    }
}

if (isset($_GET['mesure_delete'])) {
    $m_id = $_GET['mesure_delete'];
    $get_file_sql = "SELECT balance_sheet_file FROM mesurments WHERE lead_no ='$m_id'";
    $results = $con->query($get_file_sql);
    if ($results->num_rows > 0) {
        $data = $results->fetch_all();
        $un_mesure_file = $data[0][0];
    }
    $get_file_status  = "SELECT project_status FROM projects WHERE project_no='$m_id'";
    $status_dump = $con->query($get_file_sql);
    if ($status_dump->num_rows > 0) {
        $data = $status_dump->fetch_all();
        $project_status = $data[0][0];
    }
    $project_status = str_replace("_mesure", "", $project_status);
    if (file_exists("../images/uploads/$un_mesure_file")) {
        if (unlink("../images/uploads/$un_mesure_file")) {
            $sql = "DELETE FROM mesurments WHERE lead_no='$m_id';";
            $sql .= "UPDATE projects SET project_status='$project_status',lead_updated_at=NOW() WHERE project_no='$m_id'";
        }
    }
    if ($con->multi_query($sql)) {
        echo "<script>alert('Deleted successfully')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    } else {
        echo "<script>alert('Failed! Try again')</script>";
        echo "<script>window.open('index.php?projects;','_self')</script>";
    }
}

if (isset($_POST['mom_submit'])) {
    $user_id = $_POST['user_id'];
    $mom_title = $_POST['mom_title'];
    $mom_objective_arr = $_POST['mom_objective'];
    $mom_raised_arr = $_POST['mom_raise_by'];
    $mom_date = $_POST['mom_date'];

    $insert_mom = "INSERT INTO mom VALUES ('default','$mom_title','$user_id','active','$mom_date',NOW(),NOW())";

    if ($con->query($insert_mom)) {
        $last_id = $con->insert_id;
        if (!empty($mom_objective_arr)) {
            for ($i = 0; $i < count($mom_objective_arr); $i++) {
                if (!empty($mom_objective_arr[$i])) {
                    $mom_objective = $mom_objective_arr[$i];
                    $mom_raised = $mom_raised_arr[$i];
                    $insert_obj = "INSERT INTO mom_objectives VALUES ('default','$last_id','$mom_objective','$mom_raised',NOW(),NOW())";
                    $con->query($insert_obj);
                }
            }
        }
        echo "<script>alert('MOM successfully registered')</script>";
        echo "<script>window.open('index.php?moms','_self')</script>";
    } else {
        echo "<script>alert('Failed! Try again')</script>";
        echo "<script>window.open('index.php?moms','_self')</script>";
    }
}


if (isset($_POST['search_submit'])) {
    $pro_lead_num = $_POST['lead_no'];

    $lead_qry = "SELECT * FROM leads WHERE lead_no='$pro_lead_num'";
    $proj_qry = "SELECT * FROM projects WHERE project_no='$pro_lead_num'";
    $results_proj = $con->query($proj_qry);
    $results_lead = $con->query($lead_qry);
    if ($results_proj->num_rows > 0) {
        echo "<script>window.open('index.php?project_flow=$pro_lead_num','_self')</script>";
    } elseif ($results_lead->num_rows > 0) {
        echo "<script>window.open('index.php?lead_flow=$pro_lead_num','_self')</script>";
    } else {
        echo "<script>alert('Enter the correct number')</script>";
        echo "<script>history.go(-1)</script>";
    }
}

if (isset($_GET['delete_mom'])) {
    $mom_id = $_GET['delete_mom'];

    $d_sql = "DELETE FROM mom where mom_id='$mom_id';";
    $d_sql .= "DELETE FROM mom_objectives where mom_id='$mom_id'";

    if ($con->multi_query($d_sql)) {
        echo "<script>alert('Deleted Successfully')</script>";
        echo "<script>window.open('index.php?moms','_self')</script>";
    } else {
        echo "<script>alert('Delete failed ! Try again')</script>";
        echo "<script>history.go(-1)</script>";
    }
}
