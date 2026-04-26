<?php
$emailErr = $passwordErr = $loginMsg = "";
$email = $password = "";


$fixedEmail = "abcde@gmail.com";
$fixedPassword = "password123";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
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
            $passwordErr = "Minimum 8 characters required";
        }
    }

    
    if (empty($emailErr) && empty($passwordErr)) {
        if ($email === $fixedEmail && $_POST["password"] === $fixedPassword) {
            $loginMsg = "<p>Login Successful! Welcome back.</p>";
        } else {
            $loginMsg = "<p>Invalid Email or Password.</p>";
        }
    }
}
?>