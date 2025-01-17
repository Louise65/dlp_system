<?php
// Include database configuration file  
include '../src/connection.php';

// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);


//ADD
if ($jsonObj->request_type == 'addLogs') {
  $logs_data = $jsonObj->logs_data;
  $faculty_name = $logs_data[0];
  $dlp_no = $logs_data[1];
  $date_borrowed = $logs_data[2];
  $time_borrowed = $logs_data[3];
  $subject = $logs_data[4];
  $subject_schedule_start = $logs_data[5];
  $subject_schedule_end = $logs_data[6];
  $is_deleted = 0;

  if (!empty($logs_data) && empty($err)) {
    $sqlQ = "INSERT INTO logs (faculty_name, dlp_no, date_borrowed, subject, subject_schedule_start, subject_schedule_end, time_borrowed, is_deleted, date_added, date_modified) VALUES (?,?,?,?,?,?,?,?, NOW(), NOW())";
    $stmt = $mysqli->prepare($sqlQ);
    $stmt->bind_param("sssssssi", $faculty_name, $dlp_no, $date_borrowed, $subject, $subject_schedule_start, $subject_schedule_end, $time_borrowed, $is_deleted);
    $insert = $stmt->execute();

    if ($insert) {
      $output = [
        'status' => 1,
        'msg' => 'Logs added successfully!'

      ];
      echo json_encode($output);
    } else {
      echo json_encode(['error' => 'Logs Add request failed!']);
    }
  } else {
    echo json_encode(['error' => trim($err, '<br/>')]);
  }
}

//EDIT
if ($jsonObj->request_type == 'editLogs') {
  $logs_data = $jsonObj->logs_data;
  $time_borrowed = $logs_data[0];
  $time_returned = $logs_data[1];
  $remarks = $logs_data[2];
  $is_deleted = 0;
  $id = $logs_data[3];

  if (!empty($logs_data) && empty($err)) {
    $sqlQ = "UPDATE logs SET time_borrowed=?,time_returned=?,remarks=?,is_deleted=?, date_modified=NOW() WHERE id = ?";
    $stmt = $mysqli->prepare($sqlQ);
    $stmt->bind_param("sssii", $time_borrowed, $time_returned, $remarks, $is_deleted, $id);
    $update = $stmt->execute();

    if ($update) {
      $output = [
        'status' => 1,
        'msg' => 'Logs updated successfully!'
      ];
      echo json_encode($output);
    } else {
      echo json_encode(['error' => 'Logs Update request failed!']);
    }
  } else {
    echo json_encode(['error' => trim($err, '<br/>')]);
  }
}

// DELETE
if ($jsonObj->request_type == 'deleteLogs') {
  $logs_data = $jsonObj->logs_data;
  $is_deleted = 1;
  $id = $logs_data[0];

  if (!empty($logs_data) && empty($err)) {
    $sqlQ = "UPDATE logs SET is_deleted=? WHERE id=?";
    $stmt = $mysqli->prepare($sqlQ);
    $stmt->bind_param("ii", $is_deleted, $id);
    $update = $stmt->execute();

    if ($update) {
      $output = [
        'status' => 1,
        'msg' => 'Item updated successfully!'
      ];
      echo json_encode($output);
    } else {
      echo json_encode(['error' => 'Item Update request failed!']);
    }
  } else {
    echo json_encode(['error' => trim($err, '<br/>')]);
  }
}
