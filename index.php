<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMBS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles/styles.css">
</head>

<body class="body-bg">
    <div class="login">
        <?php
        if (isset($_GET['err'])) {
            if ($_GET["err"] == "invalid") {
                echo '<div class="alert alert-warning">Incorrect user name or password! </div>
                                                        <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
            }
            if ($_GET["err"] == "fillall") {
                echo '<div class="alert alert-warning">Please provide username and password! </div>
                                                        <script>setTimeout(()=>{location.href="index.php";},7000);</script>';
            }
        }
        ?>
        <div class="form">
            <form class="login-form" action="login.php" method="POST">
                <span class="material-icons">lock</span>
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="password" name="password" required />
                <button>login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>