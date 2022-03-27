<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_all_customers = "SELECT * from customers ORDER BY custid DESC";
$result = $mysqli->query($sql_all_customers);
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
                                echo '<div class="alert alert-success">Cutomer account has been created! </div>
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
                                echo '<div class="alert alert-success">Cutomer account status has been changed! </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            } else if ($_GET["message"] == "exists-upd") {
                                echo '<div class="alert alert-warning">It looks like there are other customers with the same email,phone or id, please try another. </div>
                                                <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-10">
                                <h4>All customers</h4>
                            </div>
                            <div class="col-2">

                                <a href="newcust.php" class="btn btn-primary">New account</a>

                            </div>
                        </div>
                        <hr>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Phone number</th>
                                    <th>Address</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_array()) {
                                        echo '<tr>
                                                               <td><img src="' . $row['photo'] . '" width="50" height="50"/></td>
                                                               <td>' . $row['firstname'] . '</td>
                                                               <td>' . $row['lastname'] . '</td>
                                                               <td>' . $row['phonenumber'] . '</td>
                                                               <td>' . $row['address'] . '</td>
                                                               <td><div>
                                                                   <a href="customer.php?cid=' . $row['custid'] . '" class="btn btn-primary">View details</a>
                                                                   <a href="accountstatement.php?cid=' . $row['custid'] . '" class="btn btn-success">Account statement</a>
                                                                   </div></td>
                                                             <tr/>';
                                    }
                                } else {
                                    echo '<tr ><td rowspan="6">No data found</td><tr/>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>

</html>