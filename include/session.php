<?php

$path = $GLOBALS['_path'];
session_start();

if (!isset($_SESSION['userDataHwms'])) {


   header("Location: $path/auth/login.php");
   exit();
}
