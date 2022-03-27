<?php
include("../database/connect.php");
include("../displayerrors.php");

$sql = "SELECT accountnumber FROM accounts" ;

$result =$mysqli->query($sql);
$rows = array();
while ($row = $result->fetch_assoc()) {
    array_push($rows,$row);
 }
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 echo json_encode($rows);


$mysqli -> close();
