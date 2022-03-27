<?php
include("database/connect.php");
include("displayerrors.php");
session_start();
//EmmyL@123
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND ustatus='1' LIMIT 1";
    
    if ($result = $mysqli->query($sql)) {
        $row = $result->fetch_array();
        $count = $result->num_rows;
        if ($count > 0) {
            $_SESSION["userid"] = $row['userid'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["fullname"] = $row['fullname'];
            $_SESSION["username"] = $row['username'];  
            if ($row['role'] == 'manager') {
               header('Location: manager/index.php');
            } else {
                header('Location: teller/index.php');
            }
        } else {
            echo $count;
            header('Location: index.php?err=invalid');
        }
    } else {
        echo $mysqli->error;
    }
} else {
    header('Location: index.php?err=fillall');
}
