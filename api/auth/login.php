<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../db/connection.php';


$username = $_POST['username'];
$password = $_POST['password'];

$checkSql = "SELECT * FROM user_login ul INNER JOIN user_role ur ON ul.role = ur.id WHERE ul.username ='$username' AND  ul.password = '$password'";
$checkResult = mysqli_query($db, $checkSql);

if ($checkResult->num_rows > 0) {
    $row = mysqli_fetch_assoc($checkResult);
    $role = $row['role'];
    $roleName = $row['name'];
    $userId = $row['user_id'];
    if ($role == '1') {

        $sql = "select * from master_admin where user_id = $row[user_id]";
        $result = mysqli_query($db, $sql);
    } else if ($role == '2') {

        $sql = "select * from master_hospital where user_id = $row[user_id]";
        $result = mysqli_query($db, $sql);
    } else if ($role == '3') {

        $sql = "select * from master_team_manager where user_id = $row[user_id]";
        $result = mysqli_query($db, $sql);
    }
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $temp['name'] = $row['name'];
        $temp['roleId'] =  $role;
        $temp['roleName'] = $roleName;
        $temp['userId'] = $userId;
        $_SESSION['userDataHwms'] = $temp;

        header("Location: ../../");
        exit();
    } else {
        header("Location: ../../auth/login.php?error=Invalid User");
        exit();
    }
} else {
    header("Location: ../../auth/login.php?error=Invalid User");
    exit();
}
