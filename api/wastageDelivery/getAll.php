<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];

$data =  array();
$checkSql = "SELECT wl.*,mh.*,pl.date,pl.time,pl.status FROM wastage_log wl INNER JOIN pickup_log pl ON pl.wastage_id = wl.id INNER JOIN master_hospital mh ON mh.user_id = wl.hospital_⁯id WHERE pl.status='0'";
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
