<?php
include_once "includes/header.inc.php";
include_once "includes/navigation.inc.php";
?>
<form class="form" action="includes/login.inc.php" method="post">
    <p class="form-header" align="center">Log In</p>
    <input class="form-input" type="text" name="login-username" placeholder="Username/Email">
    <input class="form-input" type="password" name="login-password" placeholder="Password">
    <button class="form-submit" type="submit" name="submit">Log In</button>
</form>
<?php
include_once "includes/footer.inc.php";
?>
