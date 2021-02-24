<?php

/*
  Check that the user actually got here by using the submit botton
  on the register form. If they didnt then send them back to the register page
 */
if (isset($_POST["submit"])) {
    $staffUsername = $_POST["register-username"];
    $staffName = $_POST["register-name"];
    $staffEmail = $_POST["register-email"];
    $staffPassword = $_POST["register-password"];
    $staffRepeatPassword = $_POST["register-repeatPassword"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";


    if (emptyInputRegister($staffName, $staffUsername, $staffEmail, $staffPassword, $staffRepeatPassword) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($staffUsername) !== false) {
        header("location: ../register.php?error=invalidusername");
        exit();
    }

    if (invalidEmail($staffEmail) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if (passwordMatch($staffPassword, $staffRepeatPassword) !== false) {
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }

    if (usernameExists($conn, $staffUsername) !== false) {
        header("location: ../register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $staffName, $staffEmail, $staffUsername, $staffPassword);
} else {
    header("location: ../register.php");
    exit();
}
?>
