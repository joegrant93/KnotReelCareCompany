<?php
if (isset($_POST["submit"])) {
  $staffUsername = $_POST["login-username"];
  $staffPassword = $_POST["login-password"];

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';


  if (emptyInputLogin($staffUsername, $staffPassword) === true) {
    header("location: ../login.php?error=emptyinput");
		exit();
  }

  loginUser($conn, $staffUsername, $staffPassword);

} else {
	header("location: ../login.php");
    exit();
}
?>
