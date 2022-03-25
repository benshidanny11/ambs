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
                            <div class="col-9">
                                <h4>All accounts</h4>
                            </div>
                            <div class="col-3">
                            </div>
                        </div>
                        <hr>
                        <table id="example" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Phone number</th>
                                    <th>Account number</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_array()) {
                                        echo '<tr>
                                                <td><img src="../manager/' . $row['photo'] . '" width="50" height="50"/></td>
                                                <td>' . $row['firstname'] . '</td>
                                                <td>' . $row['lastname'] . '</td>
                                                <td>' . $row['phonenumber'] . '</td>
                                                <td>' . $row['accountnumber'] . '</td>
                                                <td>
                                                    <div class="d-flex justify-content-between actions-teller">
                                                    <a href="account.php?cid=' . $row['custid'] . '" class="btn btn-primary">View details</a>
                                                    <a href="createtrans.php?cid=' . $row['custid'] . '" class="btn btn-success">Create transaction</a>
                                                    </div>
                                                </td>
                                                </tr>';
                                    }
                                } else {
                                    echo '<tr ><td rowspan="6">No data found</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        $("#example").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthMenu": [10]
        });
       // $(".dataTables_filter").attr("placehol")
      const searchBox=  document.getElementsByClassName("dataTables_filter")[0].children[0].children[0];
      searchBox.setAttribute("placeholder","Type account no,name,...");
    </script>
</body>

</html>