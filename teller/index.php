<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_all_customers = "SELECT * from customers INNER JOIN accounts ON customers.custid=accounts.coutomerid ORDER BY custid DESC";
$result = $mysqli->query($sql_all_customers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambs :: Teller dashboard</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body>

    <?php
    include("sidebar.php");
    include("appbar.php");
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
                                            } else if ($_GET['message'] == "insufbal") {
                                                echo '<div class="alert alert-warning">Insuficient balance!</div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                                            }
                                        }
                                        ?>
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
                                                <form class="login-form" action="acttrans.php" method="POST">
                                                    <div class="form-group">
                                                        <label>Account number </label>
                                                        <select id="selectacc" placeholder="Account number" name="accn" required>
                                                            <option>Ex: 000-XXXXXXXX</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Customer name</label>
                                                        <input type="text" placeholder="Customer name" name="customername" id="custname" class="form-control" required readonly />
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Transaction type</label>
                                                        <select type="text" name="transtype" class="form-control" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $("#example").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthMenu": [10]
        });
        let accountoptions = document.getElementById("selectacc");
        $.ajax({
            type: "GET",
            url: './fndaccounts.php',
            success: function(response) {
                for (var i = 0; i < response.length; i++) {
                    const levelOption = document.createElement("option");
                    levelOption.innerHTML = response[i].accountnumber;
                    levelOption.value = response[i].accountnumber;
                    accountoptions.appendChild(levelOption);
                }
                $('#selectacc').selectize({
                    sortField: 'text'
                }).on("change", function(e) {
                    //custname
                    $.ajax({
                        type: "GET",
                        url: './findcustomer.php?accn='+e.target.value,
                        success: function(response) {
                         $("#custname").val(`${response.firstname} ${response.lastname}`)
                        },
                        error: (error) => {
                            console.log(error)
                        }

                    });
                });
            },
            error: (error) => {
                console.log(error)
            }

        });
    </script>
</body>

</html>