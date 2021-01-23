<?php

// include config file
require_once("config/config.php");

// if clicked on login
if (isset($_REQUEST['register'])) {

    // prepare user object
    $admin = new Admin($db);

    // set user property values
    $admin->name = $_POST['name'];
    $admin->email = $_POST['email'];
    $admin->password = md5($_POST['password']);

    // register
    $admin->register();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- stylesheet link -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Assignment- ADMIN Registration</title>
</head>

<body>
    <!-- header section start -->
    <header>
        <a href="index.php" class="logo">
            <h1 class="title">EVENT ASSIGNMENT</h1>
        </a>

        <nav>
            <ul>
                <li><a href="adminLogin.php" class="btn btn-green">Login</a></li>
                <li><a href="adminRegister.php" class="btn btn-blue">Register</a></li>
            </ul>
        </nav>
    </header>
    <!-- header section end -->

    <!-- main section -->
    <section class="main-container">
        <!-- register section start -->
        <div class="form-section">
            <h2 class="form-title">Admin Registration</h2>
            <div class="error">
                <?php if (isset($_SESSION['error'])) { ?>
                    <p class="error-msg"><?= $_SESSION['error'] ?></p>
                <?php }
                unset($_SESSION['error']);
                ?>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="login-form">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                </div>

                <div class="help-text">
                    Already have an account? <a href="adminLogin.php">Login</a>
                </div>

                <div class="center">
                    <button class="btn btn-blue" type="submit" name="register">Registration</button>
                </div>


            </form>
        </div>
        <!-- register section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>
        <p>Developed by <a href="mailto:ratulsikder104@gmail.com">Ratul Sikder</a></p>
    </footer>
    <!-- footer section end -->

</body>

</html>