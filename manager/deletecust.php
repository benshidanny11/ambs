<?php
include("../database/connect.php");
$deletecust = "DELETE FROM customers WHERE custid=".$_GET['cid'];

if ($mysqli->query($deletecust) === TRUE) {
    header('Location: index.php?message=success-del');
} else {
    echo "Error: " . "<br>" . $mysqli->error;
}
$mysqli->close();
?>