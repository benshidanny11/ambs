<?php
include("../database/connect.php");
include("../displayerrors.php");

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $userrole = $_POST['userrole'];
    $update = "UPDATE users SET fullname='$fullname',email='$email',phonenumber='$phone',username='$username',role='$userrole' WHERE userid=".$_GET['uid'];

    if ($mysqli->query($update) === TRUE) {
        header('Location: users.php?message=success-upd');
    } else {
        echo "Error: " . "<br>" . $mysqli->error;
    }

    $mysqli->close();
} else {
    header('Location: users.php?message=fillall');
}
