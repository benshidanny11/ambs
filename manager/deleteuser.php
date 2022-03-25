<?php
include("../database/connect.php");
$delete = "DELETE FROM users WHERE userid=".$_GET['uid'];

if ($mysqli->query($delete) === TRUE) {
    header('Location: users.php?message=success-del');
} else {
    echo "Error: " . "<br>" . $mysqli->error;
}
$mysqli->close();
?>