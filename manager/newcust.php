<?php
include("../database/connect.php");
include("../displayerrors.php");
include("./checkuser.php");
$sql_all_customers = "SELECT * from customers";
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
                                                <h4>Add new customer account</h4>
                                            </div>
                                            <div class="col-2">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="register">
                                            <div class="form-reg">
                                                <form class="login-form" action="newcustact.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>First name </label>
                                                        <input type="text" placeholder="First name" name="firstname" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Last name</label>
                                                        <input type="text" placeholder="Lastname" name="lastname" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date of birth</label>
                                                        <input type="date" placeholder="Date of birth" name="dob" class="form-control" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label>National id</label>
                                                        <input type="text" placeholder="National id" name="nid" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" placeholder="Address" name="address" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone number</label>
                                                        <input type="tel" placeholder="Phone number" name="phone" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" placeholder="Email" name="email" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="file" placeholder="Image" name="photo" class="form-control" required />
                                                    </div>

                                                   <div class="form-group">
                                                   <input class="btn btn-primary" type="submit" value="Add account" name="submit">
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