<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];

$data =  array();
$checkSql = "select wl.*,pl.date,pl.time from wastage_log wl LEFT JOIN pickup_log pl ON pl.wastage_id = wl.id where wl.hospital_⁯id = $user[userId]";
$checkResult = mysqli_query($db, $checkSql);

if ($checkResult->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($checkResult)) {
        $data[] = $row;
    }
    $res['success'] = true;
    $res['data'] = $data;
} else {
    $res['success'] = false;
    $res['message'] = "No records Found";
}
echo json_encode($res);
