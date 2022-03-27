
<?php
function is_password_valid($pass)
{
    $password = $_POST['password'];
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        return false;
    } else {
        return true;
    }
}
?>