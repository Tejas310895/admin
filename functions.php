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

function get_project_complete($status, $project_no)
{
    require("includes/db.php");
    $sql = "SELECT p.project_no,p.project_name,p.project_status,p.project_updated_at,e.c_name,e.c_contact,e.c_desc FROM projects AS p INNER JOIN project_enquiries AS e ON p.project_no=e.application_no WHERE p.project_status in ($status) AND p.project_no='$project_no'";
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
        $sql = "SELECT * FROM projects WHERE project_status='$status' ORDER BY project_id DESC";
    }
    $results = $con->query($sql);
    if ($results->num_rows > 0) {
        return $results->fetch_all();
    } else {
        return array();
    }
}
