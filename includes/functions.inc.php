<?php

//checks if any of the fields are empty using empty() which is a built in php method. then
//it returns true if it there is an empty field and flase otherwise.
function emptyInputRegister($staffName, $staffEmail, $staffUsername, $staffPassword, $staffRepeatPassword) {
    $result;
    if (empty($staffName) || empty($staffEmail) || empty($staffUsername) || empty($staffPassword) || empty($staffRepeatPassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Checks that the username only has characters a-zA-Z and 0-9 using an inbuilt preg_match
function invalidUsername($staffUsername) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $staffUsername)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// checks the email field to make sure its valid using an inbuilt function called filter_var ( ,FILTER_VALIDATE_EMAIL)
function invalidEmail($staffEmail) {
    $result;
    if (!filter_var($staffEmail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Compates the passwords in the register form to make sure that they match.
function passwordMatch($staffPassword, $staffRepeatPassword) {
    $result;
    if ($staffPassword !== $staffRepeatPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Queries the database to check if the username already exists using mysqli
function usernameExists($conn, $staffUsername) {
    $sql = "SELECT * FROM staff WHERE staffUsername = ? OR staffEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $staffUsername, $staffUsername);
    mysqli_stmt_execute($stmt);

    // "Get result" returns the results from a prepared statement
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//Adds a new row to the staff table in the KRCC database using mysqli and also encrypts the password
function createUser($conn, $staffName, $staffEmail, $staffUsername, $staffPassword) {
    $sql = "INSERT INTO staff (staffName, staffEmail, staffUsername, staffPassword) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $staffName, $staffEmail, $staffUsername, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("location: ../login.php?error=none");
    exit();
}

//checks if any of the fields are empty in the login form.
function emptyInputLogin($staffUsername, $staffPassword) {
    $result;
    if (empty($staffUsername) || empty($staffPassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Checks first if the username exists using the usernameExists function
function loginUser($conn, $staffUsername, $staffPassword) {
    $usernameExists = usernameExists($conn, $staffUsername);

    if ($usernameExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $usernameExists["login-password"];
    $checkPwd = password_verify($staffPassword, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {
        session_start();
        $_SESSION["staffId"] = $usernameExists["StaffId"];
        $_SESSION["staffUsername"] = $usernameExists["staffUsername"];
        header("location: ../index.php?error=none");
        exit();
    }
}
