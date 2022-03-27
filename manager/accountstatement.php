<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_customer = "SELECT * from customers WHERE custid=" . $_GET['cid'];
$result = $mysqli->query($sql_customer);
$row = $result->fetch_array();
$cid = $_GET['cid'];
$sql_acc_statement = "SELECT firstname,lastname,dob,nationalid,photo,address,customers.email,customers.phonenumber,accounts.accountnumber as accn,transactions.balance,
amount,transactiontype,transactions.createdon,transactions.userid from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid INNER JOIN transactions ON accounts.accountnumber=transactions.accounnumber WHERE accounts.coutomerid=$cid ORDER BY transactions.transactionid ASC;";
$result_acc_statement = $mysqli->query($sql_acc_statement);
$count_credits = 0;
$count_debits = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambs :: manager dashboard</title>
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body>

    <?php
    include("appbar.php");
    include("sidebar.php")
    ?>
    <div class="mcw">
        <div class="cv">
            <div>
                <div class="inbox">
                    <div class="inbox-sb">
                        <div class="inbox-bx container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <?php
                                                echo '<h4>' . $row['firstname'] . ' ' . $row['lastname'] . '\'s account statement</h4>';
                                                ?>
                                            </div>
                                            <div class="col-2">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="register">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src="<?php echo $row['photo'] ?>" width="330" height="450" />
                                                </div>
                                                <div class="col-8 statement-container">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th><b>Date</b></th>
                                                                <th><b>Account number</b></th>
                                                                <th><b>Trasaction type</b></th>
                                                                <th><b>Transaction amount</b></th>
                                                                <th><b>Balance</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result_acc_statement->num_rows > 0) {
                                                                while ($row_acc_st = $result_acc_statement->fetch_array()) {
                                                                    echo '<tr>
                                                                        <td>' . $row_acc_st['createdon'] . '</td>
                                                                        <td>' . $row_acc_st['accn'] . '</td>
                                                                        <td>' . $row_acc_st['transactiontype'] . '</td>
                                                                        <td>' . $row_acc_st['amount'] . '</td>
                                                                        <td>' . $row_acc_st['balance'] . ' FRW</td>
                                                                        </tr>';
                                                                    if ($row_acc_st['transactiontype'] == 'deposit') {
                                                                        $count_credits += $row_acc_st['amount'];
                                                                    } else {
                                                                        $count_debits += $row_acc_st['amount'];
                                                                    }
                                                                }
                                                            } else {
                                                                echo '<tr ><td rowspan="6">No transactions made on this account</td></tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="card card-footer">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <b class="acc-stats">Total credit amount: <?php echo $count_credits ?> RWF</b>
                                                            </div>
                                                            <div class="col-4">
                                                                <b class="acc-stats">Total debit amount: <?php echo $count_debits ?> RWF</b>
                                                            </div>
                                                            <div class="col-4">
                                                                <b class="acc-stats">Balance: <?php echo $count_credits - $count_debits ?> RWF</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete customer accont</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this account, please note that it will be deleted permanently!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-primary" href="deletecust.php?cid=<?php echo $_GET['cid'] ?>">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>