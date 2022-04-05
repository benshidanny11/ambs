<?php
include("../database/connect.php");
include("../displayerrors.php");
$acc_n=$_GET['accn'];
$sql = "SELECT firstname,lastname,accounts.balance from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid WHERE accounts.accountnumber='$acc_n' LIMIT 1" ;

$result =$mysqli->query($sql);
$row = $result->fetch_assoc();
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");

 echo json_encode($row);


$mysqli -> close();
