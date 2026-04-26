<?php require_once "login_process.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Torikul Roman</title>
  
</head>
<body>

<main>
    <div class="login-box">
        <h2>Welcome Back</h2>
        <p>Log In to your account</p>
        
        <?= $loginMsg ?>

        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="abc@gmail.com">
                <span class="error"><?= $emailErr ?></span>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="********">
                <span class="error"><?= $passwordErr ?></span>
            </div>

            <div class="button-row">
                <button type="submit" class="btn btn-submit">Submit</button>
                <button type="reset" class="btn btn-reset">Reset</button>
            </div>
        </form>
    </div>
</main>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($emailErr) && empty($passwordErr)): 
?>
    <div >
        <h3>Submitted values</h3>
        <table >
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Password</td><td><?= str_repeat("*", strlen($password)) ?> (Hidden)</td></tr>
        </table>
    </div>
<?php endif; ?>

</body>
</html>