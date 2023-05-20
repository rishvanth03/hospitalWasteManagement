<?php

session_start();


include '../db/connection.php';
$user = $_SESSION['userDataHwms'];
$userId = $user['userId'];
$db = db();
if ($db) {
    try {

        extract($_POST);
        $stmt = $db->prepare("update `wastage_log` set status = ? where id =?");
        $stmt->bind_param('si', $state, $id);

        $stmt->execute();

        if ($stmt->error) {
            $res['success'] = false;
            $res['message'] = 'Error: ' . $stmt->error;
        } else {
            $res['success'] = true;
            $res['message'] = 'Updated successfully';
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
