<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "krcc";

/*
 * mysqli is used for proceedural php. PDO is used for object orientated
 * mysqli is the updated version of mysql, which isnt safe anymore.
 */
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

/*
 * If statement to stop it going any further if the connection to the SQLiteDatabase
 * fails. Then display an error message from mysqli_connect
 */
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
} else {
  echo "Everything worked";
}
?>
