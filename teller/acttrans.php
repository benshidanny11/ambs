<?php
include("../database/connect.php");
include("../displayerrors.php");
include("../utils/sendmail.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    $accn = $_POST['accn'];
    $transtype = $_POST['transtype'];
    $amount = $_POST['amount'];
    $userid = $_SESSION["userid"];
    $datetime = date("Y/m/d h:i:s");
    $sql_customer = "SELECT firstname,lastname,email,balance from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid WHERE accounts.accountnumber='$accn'";
    $result = $mysqli->query($sql_customer);
    $row = $result->fetch_array();

    if ($transtype == 'deposit') {
        $balance = $row['balance'] + intval($amount);
        $credit_or_debit = 'credited';
        $sub_credit = 'credit';
        $createtrans = "INSERT INTO transactions(accounnumber,amount,transactiontype,balance,userid,createdon) 
        VALUES('$accn','$amount','$transtype','$balance','$userid','$datetime')";
        if ($mysqli->query($createtrans) === TRUE) {
            $updateacc = "UPDATE accounts SET balance='$balance' WHERE accountnumber='$accn'";
            if ($mysqli->query($updateacc) === TRUE) {
                $message = 'Dear ' . $row['firstname'] . ',<br><br>';
                $message .= 'You have been ' . $credit_or_debit . ' with ' . $amount . ' RWF on your account ' . $accn . '!<br><br>';
                $message .= 'New balance: ' . $balance . ' RWF.<br><br>';
                $message .= 'Thank you for working with us!<br><br>';
                $mail_sent = sendMail($row['email'], $row['firstname'] . ' ' . $row['lastname'], $row['firstname'] . '\'s ' . $sub_credit . ' transaction', $message);
                header('Location: index.php?message=success&sent=' . $mail_sent);
            } else {
                echo "Error: " . "<br>" . $mysqli->error;
            }
        } else {
            echo "Error: " . "<br>" . $mysqli->error;
        }
        $mysqli->close();
    } else if ($transtype == 'withdraw') {
        if (floatval($amount) > $row['balance']) {
            header('Location: index.php?message=insufbal');
        } else {
            $balance = $row['balance'] - floatval($amount);
            $credit_or_debit = 'debited';
            $sub_credit = 'debit';
            $createtrans = "INSERT INTO transactions(accounnumber,amount,transactiontype,balance,userid,createdon) 
            VALUES('$accn','$amount','$transtype','$balance','$userid','$datetime')";
            if ($mysqli->query($createtrans) === TRUE) {
                $updateacc = "UPDATE accounts SET balance='$balance' WHERE accountnumber='$accn'";
                if ($mysqli->query($updateacc) === TRUE) {
                    $message = 'Dear ' . $row['firstname'] . ',<br><br>';
                    $message .= 'You have been ' . $credit_or_debit . ' with ' . $amount . ' RWF on your account ' . $accn . '!<br><br>';
                    $message .= 'New balance: ' . $balance . ' RWF.<br><br>';
                    $message .= 'Thank you for working with us!<br><br>';
                    $mail_sent = sendMail($row['email'], $row['firstname'] . ' ' . $row['lastname'], $row['firstname'] . '\'s ' . $sub_credit . ' transaction', $message);
                    header('Location: index.php?message=success&sent=' . $mail_sent);
                } else {
                    echo "Error: " . "<br>" . $mysqli->error;
                }
            } else {
                echo "Error: " . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }
    }
} else {
    header('Location: index.php?message=fillall');
}
