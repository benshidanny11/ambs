<?php
 include("../displayerrors.php");
 //phpinfo();
//echo phpversion();
    $mysqli =new mysqli("localhost","DannyPro","DannyPro@123","ambs_db");

    if (!$mysqli) {

        echo 'Connection attempt failed.';
        
        }
?>