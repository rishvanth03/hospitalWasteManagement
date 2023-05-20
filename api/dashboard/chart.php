<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../db/connection.php';
$data =  array();


// Get today's date
$today = new DateTime();

// Get the last 15 days from today's date
$dates = [];
$day = [];
for ($i = 0; $i < 15; $i++) {
    $dates[] = $today->sub(new DateInterval('P1D'))->format('Y-m-d') . PHP_EOL;
}

$today = new DateTime();

$day = [];
for ($i = 0; $i < 15; $i++) {
    $date = $today->sub(new DateInterval("P1D"));
    $day[] = $date->format("d M");
}



foreach ($dates as $d) {
    $checkSql = "select sum(quanity_kg) from wastage_log where date = '" . trim($d) . "'";
    $checkResult = mysqli_query($db, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);
    if ($row['sum(quanity_kg)'] != null) {
        array_push($data, $row['sum(quanity_kg)']);
    } else {
        array_push($data, '0');
    }
}



$res['data'] = $data;
$res['axis'] = $day;

echo json_encode($res);
