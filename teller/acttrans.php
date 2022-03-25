<?php
include("../database/connect.php");
include("../displayerrors.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    $sql_customer = "SELECT balance from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid WHERE custid=" . $_GET['cid'];
    $result = $mysqli->query($sql_customer);
    $row = $result->fetch_array();
    $accn = $_POST['accn'];
    $transtype = $_POST['transtype'];
    $amount = $_POST['amount'];
    $userid = $_SESSION["userid"];
    $datetime = date("Y/m/d h:i:s");
    
    if ($transtype == 'deposit') {
        $balance = $row['balance'] + floatval($amount);
    } else if($transtype == 'withdraw'){
        if (floatval($amount) > $row['balance']) {
            header('Location: index.php?message=insufbal');
        } else {
            $balance = $row['balance'] - floatval($amount);;
        }
    }

    $createtrans = "INSERT INTO transactions(accounnumber,amount,transactiontype,balance,userid,createdon) 
    VALUES('$accn','$amount','$transtype','$balance','$userid','$datetime')";
    if ($mysqli->query($createtrans) === TRUE) {
        $updateacc = "UPDATE accounts SET balance='$balance' WHERE accountnumber='$accn'";
        if ($mysqli->query($updateacc) === TRUE) {
            header('Location: index.php?message=success');
        } else {
            echo "Error: " . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: " . "<br>" . $mysqli->error;
    }
    $mysqli->close();
} else {
    header('Location: index.php?message=fillall');
}
