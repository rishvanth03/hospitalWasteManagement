<?php
// include '../display_error.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function db()
{
    $config = parse_ini_file('db.ini');

    $host = $config['server'];
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['db'];
    $port = $config['port'];
    try {
        $db = mysqli_connect($host, $username, $password, $database, $port);
        if ($db) {
            return $db;
        } else {
            return null;
        }
    } catch (Exception $ex) {
        die($ex);
    }
}
$db = db();