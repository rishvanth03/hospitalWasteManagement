<?php

session_start();


include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];
$db = db();
if ($db) {
    try {

        extract($_POST);
        $stmt = $db->prepare("INSERT INTO `wastage_log`(`hospital_⁯id`,`type`,`description`,`quanity_kg`) VALUES (?,?,?,?)");
        $stmt->bind_param('issi', $userId, $type, $description, $quanity);

        $stmt->execute();

        if ($stmt->error) {
            $res['success'] = false;
            $res['message'] = 'Error: ' . $stmt->error;
        } else {
            $res['success'] = true;
            $res['message'] = 'Rised successfully';
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
