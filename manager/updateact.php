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
    $sqlcheckdup = "SELECT * FROM customers where email='$email' OR phonenumber='$phone' OR nationalid=$nationalid AND  custid <> " . $_GET['cid'];
    $updatecustomer = "UPDATE customers SET firstname='$firstname',lastname='$lastname',dob='$dob',nationalid='$nationalid',address='$address',email='$email',phonenumber='$phone' WHERE custid=" . $_GET['cid'];
    if ($result = $mysqli->query($sqlcheckdup)) {
        if ($result->num_rows > 0) {
            header('Location: index.php?message=exists-upd');
        }else {
            if ($mysqli->query($updatecustomer) === TRUE) {
                header('Location: index.php?message=success-upd');
            } else {
                echo "Error: " . "<br>" . $mysqli->error;
            }
        }
       
    } else {
        echo "Error: " . "<br>" . $mysqli->error;
        $mysqli->close();
    }
} else {
    header('Location: index.php?message=fillall');
}
