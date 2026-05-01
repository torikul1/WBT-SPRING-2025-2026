<?php require_once "signup_process.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Torikul Roman</title>
    <link rel="stylesheet" href="../css/contactme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>.error { color: red; font-size: 0.8em; }</style>
</head>
<body>

<main>
    <div class="form-container">
        <div class="form-header">
            <h1>Sign Up</h1>
        </div>

        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="name" value="<?= $name ?>">
                    <span class="error"><?= $nameErr ?></span>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" value="<?= $lname ?>">
                    <span class="error"><?= $lnameErr ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="number">Contact Number:</label>
                <input type="text" id="number" name="contactNumber" value="<?= $contactNumber ?>" placeholder="01700000000">
                <span class="error"><?= $contactNumberErr ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?= $email ?>" placeholder="abc@gmail.com">
                <span class="error"><?= $emailErr ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="******">
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
// Only display the table if the form was submitted AND there are no errors
if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    empty($nameErr) && empty($lnameErr) && empty($emailErr) && 
    empty($contactNumberErr) && empty($passwordErr)): 
?>
    <div class="results">
        <h3>Submitted Values</h3>
        <table class="result-table">
            <tr><td>First Name</td><td><?= $name ?></td></tr>
            <tr><td>Last Name</td><td><?= $lname ?></td></tr>
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Contact</td><td><?= $contactNumber ?></td></tr>
            <tr><td>Password</td><td>[PROTECTED]</td></tr>
        </table>
    </div>
<?php endif; ?>

</body>
</html>