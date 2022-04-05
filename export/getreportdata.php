<?php
session_start();

include("../manager/checkuser.php");


 function get_report_data(){
    include("../database/connect.php"); 
    if (isset($_GET['from']) && strlen($_GET['from'])>0) {
        $date = date_create("2013-03-15");
        date_format(date_create("2013-03-15"), "Y/m/d H:i:s");
    
        $datefrom = date("Y/m/d H:i:s", strtotime($_GET['from'] . ' 00:00:00'));
        $dateto = date("Y/m/d H:i:s", strtotime($_GET['to'] . ' 23:59:59'));
        $sql_transactions = "SELECT firstname,lastname,dob,nationalid,photo,address,customers.email,customers.phonenumber,accounts.accountnumber as accn,transactions.balance,transactions.amount,
        transactiontype,transactions.createdon,transactions.userid,users.fullname from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid INNER JOIN transactions ON accounts.accountnumber=transactions.accounnumber INNER JOIN users on transactions.userid=users.userid WHERE transactions.createdon BETWEEN '$datefrom' AND '$dateto' ORDER BY transactions.transactionid DESC;";
    } else {
        $sql_transactions = "SELECT firstname,lastname,dob,nationalid,photo,address,customers.email,customers.phonenumber,accounts.accountnumber as accn,transactions.balance,
    amount,transactiontype,transactions.createdon,transactions.userid,users.fullname from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid INNER JOIN transactions ON accounts.accountnumber=transactions.accounnumber INNER JOIN users on transactions.userid=users.userid ORDER BY transactions.transactionid DESC;";
    }
    $result_trans = $mysqli->query($sql_transactions);
    $data = array();
    while ($row = $result_trans->fetch_array()) {
        $data[] =$row;  
   }
   return $data;
 }

?>