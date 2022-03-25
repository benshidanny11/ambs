<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_customer = "SELECT custid,accountnumber from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid WHERE custid=" . $_GET['cid'];
$result = $mysqli->query($sql_customer);
$row = $result->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambs :: teller dashboard</title>
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
    <?php include("sidebar.php") ?>
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
                                                <h4>Create transaction</h4>
                                            </div>
                                            <div class="col-2">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="register">
                                            <div class="form-reg">
                                                <form class="login-form" action="acttrans.php?cid=<?php echo $row['custid'] ?>" method="POST">
                                                    <div class="form-group">
                                                        <label>Account number </label>
                                                        <input type="text" name="accn" class="form-control" required value="<?php echo $row['accountnumber'] ?>" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Transaction type</label>
                                                        <select type="text" name="transtype" class="form-control" required >
                                                            <option>Select transaction type</option>
                                                            <option value="deposit">Deposit</option>
                                                            <option value="withdraw">Withdraw</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="number" placeholder="Amount" name="amount" class="form-control" required />
                                                    </div>
                                                    
                                                   

                                                   <div class="form-group">
                                                   <input class="btn btn-primary" type="submit" value="Confirm transaction" name="submit">
                                                   </div>
                                                </form>
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>

</html>