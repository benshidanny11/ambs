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
                                                <h4>Add new user</h4>
                                            </div>
                                            <div class="col-2">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="register">
                                            <div class="form-reg">
                                                <form class="login-form" action="newuseract.php" method="POST">
                                                    <div class="form-group">
                                                        <label>Full name </label>
                                                        <input type="text" placeholder="Full name" name="fullname" class="form-control" required />
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" placeholder="Email" name="email" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone number</label>
                                                        <input type="tel" placeholder="Phone number" name="phone" class="form-control" required />
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label>User name</label>
                                                        <input type="text" placeholder="User name" name="username" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>User role</label>
                                                        <select type="text" name="userrole" class="form-control" required >
                                                            <option>Select user role</option>
                                                            <option value="manager">Manager</option>
                                                            <option value="teller">Teller</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" placeholder="Password" name="password" class="form-control" required />
                                                    </div>

                                                   <div class="form-group">
                                                   <input class="btn btn-primary" type="submit" value="Create user" name="submit">
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