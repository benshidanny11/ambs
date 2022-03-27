<?php
include("../database/connect.php");
$status=$_GET['query']=='Disactivate'?'0':'1';

$delete = "UPDATE users SET ustatus='$status' WHERE userid=".$_GET['uid'];

if ($mysqli->query($delete) === TRUE) {
    header('Location: users.php?message=success-del');
} else {
    echo "Error: " . "<br>" . $mysqli->error;
}
$mysqli->close();
?>