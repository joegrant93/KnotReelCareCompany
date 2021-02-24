<?php
include_once "includes/header.inc.php";
include_once "includes/navigation.inc.php";
?>
<form class="form" action="includes/register.inc.php" method="post">
    <p class="form-header" align="center">Register</p>
    <input class="form-input" type="text" name="register-username" placeholder="Username" >
    <input class="form-input" type="text" name="register-name" placeholder="Full Name" >
    <input class="form-input" type="email" name="register-email" placeholder="Email" >
    <input class="form-input" type="password" name="register-password" placeholder="Password" >
    <input class="form-input" type="password" name="register-repeatPassword" placeholder="Repeat Password" >
    <button class="form-submit" type="submit" name="submit">Register</button>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "stmtfailed") {
            echo "<p class= \"errorMessage\">Something failed, try again</p>";
        } else if ($_GET["error"] == "emptyinput") {
            echo "<p class= \"errorMessage\">Fill in all fields.</p>";
        } else if ($_GET["error"] == "invalidusername") {
            echo "<p class= \"errorMessage\">Username is invalid.</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p class= \"errorMessage\">Email is not valid.</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p class= \"errorMessage\">Passwords did not match.</p>";
        } else if ($_GET["error"] == "usernametaken") {
            echo "<p class= \"errorMessage\">Username is already taken.</p>";
        }
    }
    ?>
</form>
<?php
include_once "includes/footer.inc.php";
?>
