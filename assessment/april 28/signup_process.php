<?php
$nameErr = $lnameErr = $emailErr = $contactNumberErr = $passwordErr = "";
$name = $lname = $email = $contactNumber = $password = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "First name is required";
    } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = cleanInput($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    


    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = cleanInput($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        }
    }
}
?>