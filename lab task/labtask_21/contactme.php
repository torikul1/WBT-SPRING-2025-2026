<?php require_once "contact_process.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Torikul Roman</title>
    <link rel="stylesheet" href="../css/contactme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container navbar-container">
            <h1 class="logo">Torikul <span>Roman</span></h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../html/experience.html">Experience</a></li>
                    <li><a href="../html/project.html">Projects</a></li>
                    <li><a href="../html/education.html">Education</a></li>
                    <li><a href="../html/contactme.html">Contact Me</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container">
            <div class="form-header">
                <h1>Contact Me</h1>

            </div>

            <form action="#" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
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
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="abc@gmail.com">
                    <span class="error"><?= $emailErr ?></span>
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" placeholder="Organization name">
                </div>

                <fieldset class="radio-group">
                    <legend>Gender:</legend>
                    <label class="option-item">
                        <input type="radio" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>> 
                        <span>Male</span>
                    </label>
                    <label class="option-item">
                        <input type="radio" name="gender"  value="female" <?= ($gender == "female") ? "checked" : "" ?>>
                        <span>Female</span>
                    </label>
                    <span class="error"><?= $genderErr ?></span>
                </fieldset>

                <fieldset class="radio-group">
                       <label for="reason">Reason of Contact:</label>
                    
                    <label class="option-item">
                        <input type="radio" name="reason" value="projects" >
                        <span>Projects</span>
                    </label>
                    <label class="option-item">
                        <input type="radio" name="reason" value="thesis">
                        <span>Thesis</span>
                    </label>
                    <label class="option-item">
                        <input type="radio" name="reason" value="job">
                        <span>Job</span>
                    </label>
                </fieldset>

                <fieldset class="checkbox-group">
                  <label for="topic">Topics:</label>
                   
                    <label class="option-item">
                        <input type="checkbox" name="topic" value="web">
                        <span>Web Development</span>
                    </label>
                    <label class="option-item">
                        <input type="checkbox" name="topic" value="mobile">
                        <span>Mobile Development</span>
                    </label>
                    <label class="option-item">
                        <input type="checkbox" name="topic" value="ai">
                        <span>AI/ML Development</span>
                    </label>
                </fieldset>

                <div class="form-group">
                    <label for="date">Consultation Date: </label>
                    <input type="date" id="date" >
                </div>

                <div class="button-row">
                    <button type="submit" class="btn btn-submit">Submit</button>
                    <button type="reset" class="btn btn-reset">Reset</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="container footer-content">
            <p class="footertitle">Connect on Social Networks</p>
            <ul class="footer-icons">
                <li><a href="https://www.facebook.com/tori6kul"><img src="../pic/icons8-facebook-100.png"
                            alt="Facebook"></a></li>
                <li><a href="https://www.linkedin.com/in/md-torikul-islam-roman-7853423b7/"><img src="../pic/icons8-linkedin-100.png"
                            alt="LinkedIn"></a></li>
                <li><a href="https://github.com/torikul1"><img src="../pic/icons8-github-100.png" alt="GitHub"></a></li>
            </ul>
            <p>&copy; 2026 Torikul Roman. All rights reserved.</p>
        </div>
    </footer>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        !$nameErr &&!$lnameErr && !$emailErr && !$websiteErr && !$genderErr): ?>
        <h3>Submitted values</h3>
        <table class="result-table">
            <tr><td>Name</td><td><?= $name ?></td></tr>
            <tr><td>Name</td><td><?= $lname ?></td></tr>
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Website</td><td><?= $website ?></td></tr>
            <tr><td>Comment</td><td><?= $comment ?></td></tr>
            <tr><td>Gender</td><td><?= $gender ?></td></tr>
        </table>
    <?php endif; ?>

</body>

</html>