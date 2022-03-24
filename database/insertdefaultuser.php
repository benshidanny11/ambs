<?php
include ("./connect.php");

$sqltbleusers="CREATE TABLE IF NOT EXISTS users
(
    userid bigint NOT NULL  AUTO_INCREMENT,
    fullname text  NOT NULL,
    email text  NOT NULL,
    phonenumber text  NOT NULL,
    username text  NOT NULL,
    password text ,
    PRIMARY KEY (userid)
);";

$pass=md5('danny123');
$sql="INSERT INTO users(fullname,email,phonenumber,username,password,role) VALUES('Danny Benshi','danny@gmail.com','0788299299','danny123','$pass','manager')";
if($mysqli->query($sql)=== TRUE){
  echo "Inserted default user";
}else{
    echo $mysqli->error;
}
?>
