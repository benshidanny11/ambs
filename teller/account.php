<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_customer = "SELECT * from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid WHERE custid=" . $_GET['cid'];
$result = $mysqli->query($sql_customer);
$row = $result->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambs :: manager teller</title>
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
                                            <div class="col-9">
                                                <?php
                                                echo '<h4>' . $row['firstname'] . ' ' . $row['lastname'] . '\'s profile</h4>';
                                                ?>
                                            </div>
                                            <div class="col-3">

                                                <a href="createtrans.php?cid=<?php echo $_GET['cid'] ?>" class="btn btn-primary">Create transaction</a>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="register">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src="../manager/<?php echo $row['photo'] ?>" width="330" height="450" />
                                                </div>
                                                <div class="col-8">
                                                    <h5>Personal information</h5>
                                                    <hr>
                                                    <p>Full name: <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></p>
                                                    <p>Email: <?php echo $row['email'] ?></p>
                                                    <p>Phone number: <?php echo $row['phonenumber'] ?></p>
                                                    <p>Address: <?php echo $row['address'] ?></p>
                                                    <p>National id: <?php echo $row['nationalid'] ?></p>
                                                    <p>Date of birth: <?php echo $row['dob'] ?></p>

                                                    <h5>Account information</h5>
                                                    <hr>
                                                    <p>Account number: <?php echo $row['accountnumber'] ?></p>
                                                    <p>Date of creation: <?php echo $row['createdon'] ?></p>
                                                    <p>Balance: <?php echo $row['balance'].' FRW' ?></p>
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