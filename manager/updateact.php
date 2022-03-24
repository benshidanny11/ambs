<?php
include("../database/connect.php");
include("../displayerrors.php");
session_start();
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nationalid = $_POST['nid'];
    $updatecustomer = "UPDATE customers SET firstname='$firstname',lastname='$lastname',dob='$dob',nationalid='$nationalid',address='$address',email='$email',phonenumber='$phone' WHERE custid=".$_GET['cid'];

    if ($mysqli->query($updatecustomer) === TRUE) {
        header('Location: index.php?message=success-upd');
    } else {
        echo "Error: " . "<br>" . $mysqli->error;
    }
    $mysqli->close();
} else {
    header('Location: index.php?message=fillall');
}
