<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userid=$_SESSION['userid'];
$sql_all_users = "SELECT * from users WHERE userid <> $userid  ORDER BY userid DESC";

$result = $mysqli->query($sql_all_users);
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
                                echo '<div class="alert alert-success">User has been created! </div>
                                                        <script>setTimeout(()=>{location.href="users.php";},7000);</script>';
                            } else if ($_GET["message"] == "exists") {
                                echo '<div class="alert alert-warning">User aleady exists, try to use different email,phone or national id </div>
                                                <script>setTimeout(()=>{location.href="users.php";},7000);</script>';
                            }else if ($_GET["message"] == "fillall") {
                                echo '<div class="alert alert-warning">Please fill all fields!</div>
                                                <script>setTimeout(()=>{location.href="users.php";},7000);</script>';
                            } else if ($_GET['message'] == "success-upd") {
                                echo '<div class="alert alert-success">User has been updated! </div>
                                                <script>setTimeout(()=>{location.href="users.php";},7000);</script>';
                            } else if ($_GET['message'] == "success-del") {
                                echo '<div class="alert alert-success">User has been deleted! </div>
                                                <script>setTimeout(()=>{location.href="users.php";},7000);</script>';
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col-10">
                                <h4>All users</h4>
                            </div>
                            <div class="col-2">

                                <a href="newuser.php" class="btn btn-primary">New user</a>

                            </div>
                        </div>
                        <hr>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Full name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>User name</th>
                                    <th>User role</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_array()) {
                                        echo '<tr>
                                                              
                                                <td>' . $row['fullname'] . '</td>
                                                <td>' . $row['phonenumber'] . '</td>
                                                <td>' . $row['email'] . '</td>
                                                <td>' . $row['username'] . '</td>
                                                <td>' . $row['role'] . '</td>
                                                <td>
                                                  <a href="updateuser.php?uid=' . $row['userid'] . '">Update user</a>
                                                  <a href="deleteuser.php?uid=' . $row['userid'] . '">Delete user</a>
                                                </td>
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