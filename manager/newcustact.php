<?php
include("../database/connect.php");
include("../displayerrors.php");
include("../utils/sendmail.php");
session_start();
//echo exec('whoami');
if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nationalid = $_POST['nid'];
    $time=strval(time());
    $account_n = "000-" . rand(100, 999).substr($time,5);
    $datetime = date("Y/m/d h:i:s");
    $userid = $_SESSION['userid'];
    
    $sqlcheckdup = "SELECT * FROM customers where email='$email' OR phonenumber='$phone'";
    
    
    if($result = $mysqli->query($sqlcheckdup)){
        if ($result->num_rows > 0) {
            header('Location: index.php?message=exists');
        } else {
            if ($_FILES["photo"]['size'] != 0) {
                    $filename = $_FILES["photo"]["name"];
                    $tempname = $_FILES["photo"]["tmp_name"];
                    $folder = "uploads/" . $filename;
                    
                    echo "Hello there";
                    $insertcustomer = "INSERT INTO customers(firstname,lastname,dob,nationalid,photo,address,email,phonenumber) 
                                      VALUES('$firstname','$lastname','$dob','$nationalid','$folder','$address','$email','$phone')";
        
                    if (move_uploaded_file($tempname, $folder)) {
                        if ($mysqli->query($insertcustomer) === TRUE) {
                            $custid = $mysqli->insert_id;
                            $createaccount = "INSERT INTO accounts(accountnumber,coutomerid,createdon,userid,balance) 
                            VALUES('$account_n','$custid','$datetime','$userid',0.0)";
                            if ($mysqli->query($createaccount) === TRUE) {
                                $message='Dear '.$firstname.',<br>';
                                $message.='Your AMBS account has been created successfully!<br>';
                                $message.='Account number: '.$account_n.'.<br>';
                                $message.='Initial balance: 0.<br>';
                                $mail_sent= sendMail($email,$filename.' '.$lastname,$firstname.'\'s account creation confirmation',$message);
                                header('Location: index.php?message=success&sent='.$mail_sent);
                            }else {
                                echo "Error: "  ."<br>" . $mysqli->error; 
                            }
                        } else {
                            echo "Error: ". "<br>" . $mysqli->error;
                        }
                    } else {
                        echo "Document failed to upload";
                    }
               
        
                $mysqli->close();
            }else {
                header('Location: index.php?message=invalidimg');
            }
        }
    }else {
        echo $mysqli->error;
    }
    
}else {
    header('Location: index.php?message=fillall');
}
//FOrm data

