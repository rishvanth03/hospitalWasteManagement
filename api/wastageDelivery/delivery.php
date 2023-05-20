<?php

session_start();


include '../db/connection.php';
$db = db();
if ($db) {
    try {

        extract($_POST);
        $stmt = $db->prepare("update `wastage_log` set status = '4' where id =?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt = $db->prepare("update `pickup_log` set status = '1' where wastage_id =?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->error) {
            $res['success'] = false;
            $res['message'] = 'Error: ' . $stmt->error;
        } else {
            $res['success'] = true;
            $res['message'] = 'Picked Up Sccessfully';
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
