<?php

$table = 'logs';

$primaryKey = 'id';


// db - What column in the database should I get the data from?
// dt - What column should I name this data to be sent into the table?\
// formatter - How should I format the data?

$columns = array(
    array('db' => 'id', 'dt' => 'id'),
    array('db' => 'faculty_name', 'dt' => 'faculty_name'),
    array('db' => 'dlp_no', 'dt' => 'dlp_no'),
    array('db' => 'date_borrowed', 'dt' => 'date_borrowed'),
    array('db' => 'subject', 'dt' => 'subject'),
    array('db' => 'subject_schedule_start', 'dt' => 'subject_schedule_start'),
    array('db' => 'subject_schedule_end', 'dt' => 'subject_schedule_end'),
    array(
        'db' => 'time_borrowed',
        'dt' => 'time_borrowed',
        'formatter' => function ($d, $row) {
            return date("g:i A", strtotime($d));
        }
    ),
    array(
        'db' => 'time_returned',
        'dt' => 'time_returned',
        'formatter' => function ($d, $row) {
            if ($d == NULL) {
                return "Not returned yet";
            }
            return date("g:i A", strtotime($d));
        }
    ),
    array('db' => 'remarks', 'dt' => 'remarks'),
    array('db' => 'is_deleted', 'dt' => 'is_deleted'),
    array(
        'db' => 'id',
        'dt' => 'actions',
        'formatter' => function ($d, $row) {
            return ' 
                <a href="javascript:void(0);" class="btn btn-primary" data-bs-target="#logsViewModal" onclick="viewData(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">View</a>&nbsp; 
                <a href="javascript:void(0);" class="btn btn-warning" data-bs-target="#logsUpdateModal" onclick="editData(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">Update</a>&nbsp; 
                <a href="javascript:void(0);" class="btn btn-danger" data-bs-target="#logsDeleteModal" onclick="deleteData(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">Delete</a> 
            ';
        }
    ),
    array('db' => 'date_added', 'dt' => 'date_added'),
    array('db' => 'date_modified', 'dt' => 'date_modified'),
);

$where = "is_deleted = 0";

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'dlp_database',
    'host' => 'localhost'
);

require('ssp.class.php');

echo json_encode(
    SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where)
);
