<?php
include("../database/connect.php");
include("../displayerrors.php");

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $userrole = $_POST['userrole'];
    $password = md5($_POST['password']);

    $sqlcheckdup = "SELECT * FROM users where email='$email' OR phonenumber='$phone' OR username='$username'";

    if ($result = $mysqli->query($sqlcheckdup)) {
        if ($result->num_rows > 0) {
            header('Location: users.php?message=exists');
        } else {
            $insertuser = "INSERT INTO users(fullname,email,phonenumber,username,password,role) 
            VALUES('$fullname','$email','$phone','$username','$password','$userrole')";

            if ($mysqli->query($insertuser) === TRUE) {
                header('Location: users.php?message=success');
            } else {
                echo "Error: " . "<br>" . $mysqli->error;
            }

            $mysqli->close();
        }
    } else {
        echo $mysqli->error;
    }
} else {
    header('Location: users.php?message=fillall');
}
