<?php

session_start();


include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];
$db = db();
if ($db) {
    try {

        extract($_POST);
        $stmt = $db->prepare("INSERT INTO `pickup_log`(`wastage_id`,`delivery`,`date`,`time`) VALUES (?,?,?,?)");
        $stmt->bind_param('iiss', $Wid, $delivery, $date, $time);
        $stmt->execute();

        $stmt = $db->prepare("update wastage_log set status = '2' where id =?");
        $stmt->bind_param('i', $Wid);
        $stmt->execute();

        $stmt = $db->prepare("update master_delivery set status = '2' where user_id =?");
        $stmt->bind_param('i', $delivery);
        $stmt->execute();

        if ($stmt->error) {
            $res['success'] = false;
            $res['message'] = 'Error: ' . $stmt->error;
        } else {
            $res['success'] = true;
            $res['message'] = 'Booked Successfully';
        }
        $stmt->close();
    } catch (Exception $ex) {
        $res['success'] = false;
        $res['message'] = $ex->__toString();
    }
} else {
    die('Database error');
}
echo json_encode($res);
