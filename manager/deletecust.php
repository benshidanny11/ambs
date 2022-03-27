<?php
include("../database/connect.php");
$status=$_GET['query']=='Disactivate'?'0':'1';
$deletecust = "UPDATE customers SET cstatus='$status' WHERE custid=".$_GET['cid'];

if ($mysqli->query($deletecust) === TRUE) {
    header('Location: index.php?message=success-del');
} else {
    echo "Error: " . "<br>" . $mysqli->error;
}
$mysqli->close();
?>