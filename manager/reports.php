<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
if (isset($_GET['from'])&& strlen($_GET['from'])>0) {
    $date = date_create("2013-03-15");
    date_format(date_create("2013-03-15"), "Y/m/d H:i:s");

    $datefrom = date("Y/m/d H:i:s", strtotime($_GET['from'] . ' 00:00:00'));
    $dateto = date("Y/m/d H:i:s", strtotime($_GET['to'] . ' 23:59:59'));
    $sql_transactions = "SELECT firstname,lastname,dob,nationalid,photo,address,customers.email,customers.phonenumber,accounts.accountnumber as accn,transactions.balance,
amount,transactiontype,transactions.createdon,transactions.userid,users.fullname from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid INNER JOIN transactions ON accounts.accountnumber=transactions.accounnumber INNER JOIN users on transactions.userid=users.userid WHERE transactions.createdon BETWEEN '$datefrom' AND '$dateto' ORDER BY transactions.transactionid DESC;";
} else {
    $sql_transactions = "SELECT firstname,lastname,dob,nationalid,photo,address,customers.email,customers.phonenumber,accounts.accountnumber as accn,transactions.balance,
amount,transactiontype,transactions.createdon,transactions.userid,users.fullname from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid INNER JOIN transactions ON accounts.accountnumber=transactions.accounnumber INNER JOIN users on transactions.userid=users.userid ORDER BY transactions.transactionid DESC;";
}

$result = $mysqli->query($sql_transactions);
$count_credits = 0;
$count_debits = 0;
$html_credits='';
$html_debits='';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambs :: manager dashboard</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body>

    <?php
    include("sidebar.php");
    include("appbar.php");
    ?>

    <div class="mcw">
        <div class="cv">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <?php
                        if (isset($_GET['message'])) {
                            if ($_GET["message"] == "success") {
                                echo '<div class="alert alert-success">Transaction has been created! </div>
                                                        <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET["message"] == "exists") {
                                echo '<div class="alert alert-warning">Cutomer account aleady exists, try to use different email,phone or national id </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET["message"] == "invalidimg") {
                                echo '<div class="alert alert-warning">Provided image is invalid, please try another </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET["message"] == "fillall") {
                                echo '<div class="alert alert-warning">Please fill all fields!</div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET['message'] == "success-upd") {
                                echo '<div class="alert alert-success">Cutomer account has been updated! </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET['message'] == "success-del") {
                                echo '<div class="alert alert-success">Cutomer account has been deleted! </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-3">
                                <h4>Overall report</h4>
                            </div>
                            <div class="col-7">

                                <form action="reports.php" method="get">
                                    <div class="d-flex justify-content-between">
                                        From: <input type="date" name="from" required>
                                        To: <input type="date" name="to" required>
                                        <button type="submit" name="filterdata" class="btn btn-success"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-2">
                                 <a  class="btn btn-success" href="../export/exportreport.php?from=<?php echo isset($_GET['from'])?$_GET['from']:''; ?>&to=<?php echo isset($_GET['from'])?$_GET['to']:''; ?>" target="_blank"><i class="fa fa-share" aria-hidden="true"></i> Export report</a>
                            </div>
                        </div>
                        <hr>
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th>Customer name</th>
                                    <th>Phone number</th>
                                    <th>Account number</th>
                                    <th>Amount</th>
                                    <th>Created by</th>
                                    <th>Created on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_array()) {
                                        if ($row['transactiontype'] == 'deposit') {
                                            $count_credits +=$row['amount'];
                                            $html_credits.='<tr>
                                            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                                            <td>' . $row['phonenumber'] . '</td>
                                            <td>' . $row['accn'] . '</td>
                                            <td>' . $row['amount'] . '</td>
                                            <td>' . $row['fullname'] . '</td>
                                            <td>' . $row['createdon'] . '</td>
                                            </tr>';
                                        } else {
                                            $count_debits +=$row['amount'];
                                            $html_debits.='<tr>
                                            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                                            <td>' . $row['phonenumber'] . '</td>
                                            <td>' . $row['accn'] . '</td>
                                            <td>' . $row['amount'] . '</td>
                                            <td>' . $row['fullname'] . '</td>
                                            <td>' . $row['createdon'] . '</td>
                                            </tr>';
                                        }
                                    }
                                    echo '<tr ><td colspan="6"><b>All credits</b></td></tr>'.$html_credits;
                                     
                                    echo '<tr ><td colspan="6"><b>All debits</b></td></tr>'.$html_debits;
                                } else {
                                    echo '<tr ><td colspa="6">No data found</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="card card-footer">
                            <div class="row">
                                <div class="col-4">
                                    <b>Total credit tranactions: <?php echo $count_credits; ?> RWF</b>
                                </div>
                                <div class="col-4">
                                    <b>Total debit transactions: <?php echo $count_debits; ?> RWF</b>  
                                </div>
                                <div class="col-4">
                                    <b>All transactions amount: <?php echo $count_credits+$count_debits; ?> RWF</b>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
    </script>
</body>

</html>