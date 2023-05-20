<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];

$data =  array();
$checkSql = "select * from wastage_log wl inner join master_hospital mh on mh.user_id = wl.hospital_⁯id order by wl.status";
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
