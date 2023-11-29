<?php

function get_past_days($date)
{
    date_default_timezone_set("Asia/Calcutta");
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $now - $your_date;

    if (round($datediff / (60 * 60 * 24)) == 0) {
        return 'Today';
    } elseif (round($datediff / (60 * 60 * 24)) == 1) {
        return 'Yesterday';
    } else {
        return (round($datediff / (60 * 60 * 24))) . "days ago";
    }
}
function get_users($id = 'ALL')
{
    require("includes/db.php");
    if ($id == 'ALL') {
        $sql = "SELECT * FROM users WHERE user_role!='admin' ORDER BY user_id desc";
        $results = $con->query($sql);
        return $results->fetch_all();
    } else {
        $sql = "SELECT * FROM users WHERE user_id=$id";
        $results = $con->query($sql);
        return $results->fetch_assoc();
    }
}

function get_enquiries($status)
{
    require("includes/db.php");
    $sql = "SELECT * FROM project_enquiries WHERE enquiry_status='$status' ORDER BY enquiry_id DESC";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}


function get_leads($status = 'ALL')
{
    require("includes/db.php");
    if ($status == 'ALL') {
        $sql = "SELECT * FROM leads ORDER BY lead_id DESC";
    } elseif ($status) {
        $sql = "SELECT * FROM leads WHERE lead_status='$status' ORDER BY lead_id DESC";
    }
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_lead_complete($status, $lead_no)
{
    require("includes/db.php");
    $sql = "SELECT l.lead_no,l.lead_name,l.lead_status,l.lead_updated_at,e.c_name,e.c_contact,e.c_desc FROM leads AS l INNER JOIN project_enquiries AS e ON l.lead_no=e.application_no WHERE l.lead_status in ($status) AND l.lead_no='$lead_no'";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_docs($lead_no, $column)
{
    require("includes/db.php");
    $sql = "SELECT * FROM $column WHERE lead_no='$lead_no'";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function  get_sql_single_data($column, $table, $where)
{
    require("includes/db.php");
    $sql = "SELECT $column FROM $table WHERE $where";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_designs($lead_no)
{
    require("includes/db.php");
    $sql = "SELECT * FROM designs_estimations WHERE lead_no='$lead_no'";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_design_files($lead_no)
{
    require("includes/db.php");
    $sql = "SELECT design_file_id,estimation_file_id FROM designs_estimations WHERE lead_no='$lead_no'";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_project_complete($project_no)
{
    require("includes/db.php");
    $sql = "SELECT p.project_no,p.project_name,p.project_status,p.project_updated_at,e.c_name,e.c_contact,e.c_desc FROM projects AS p INNER JOIN project_enquiries AS e ON p.project_no=e.application_no WHERE p.project_no='$project_no'";
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_projects($status = 'ALL')
{
    require("includes/db.php");
    if ($status == 'ALL') {
        $sql = "SELECT * FROM projects ORDER BY project_id DESC";
    } elseif ($status) {
        $sql = "SELECT * FROM projects WHERE project_status not like '%$status%' ORDER BY project_id DESC";
    }
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}

function get_project_expenses()
{
    require("includes/db.php");
    $sql = "SELECT * FROM project_expenses";
    $results = $con->query($sql)->fetch_all();
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}

function get_expense_flow($project_no)
{
    require("includes/db.php");
    $sql = "SELECT * FROM project_expenses WHERE project_no='$project_no'";
    $results = $con->query($sql)->fetch_all();
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}

function get_mom_details()
{
    require("includes/db.php");
    $user_id = $_SESSION['user'];
    $sql = "SELECT * FROM mom WHERE entered_by='$user_id'";
    $results = $con->query($sql)->fetch_all();
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}

function get_mom_pdf($mom_id)
{
    require("includes/db.php");
    $sql = "SELECT * FROM mom WHERE mom_id='$mom_id'";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    $results = array_shift($results);
    $sql1 = "SELECT * FROM mom_objectives WHERE mom_id=$mom_id";
    $results['objectives'] = $con->query($sql1)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}
function get_measurements($proj_no)
{
    require("includes/db.php");
    $sql = "SELECT * FROM mesurments WHERE project_no='$proj_no'";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}
function get_tasks($proj_no)
{
    require("includes/db.php");
    $sql = "SELECT * FROM tasks WHERE project_no='$proj_no'";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}
function get_tasks_uploads($task_id)
{
    require("includes/db.php");
    $sql = "SELECT * FROM task_uploads WHERE task_id='$task_id'";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}

function get_task_progress()
{
    require("includes/db.php");
    $sql = "SELECT IF(tasks.task_status='approved',1,0) as prog FROM tasks join project_enquiries on tasks.project_no=project_enquiries.application_no where project_enquiries.enquiry_status='closed'";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}

function get_project_progress()
{
    require("includes/db.php");
    $sql = "SELECT project_enquiries.application_no as proj_id,sum(IF(tasks.task_status='approved',1,0)) as prog, count(tasks.task_status) as total_prog FROM tasks join project_enquiries on tasks.project_no=project_enquiries.application_no where project_enquiries.enquiry_status='closed' group by tasks.project_no";
    $results = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
    if (!empty($results)) {
        return $results;
    } else {
        return array();
    }
}
