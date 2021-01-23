<?php

// include config file
require_once("config/config.php");


// if clicked on login
if (isset($_REQUEST['login'])) {

    // prepare admin object
    $admin = new Admin($db);

    //get value from form
    $admin->email = isset($_REQUEST['email']) ? $_REQUEST['email'] : die();
    $admin->password = md5(isset($_REQUEST['password']) ? $_REQUEST['password'] : die());

    // call login function:: Admin class
    $admin->login();
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


    <title>Assignment- ADMIN LOGIN</title>
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
        <!-- msg show -->

        <?php if (isset($_REQUEST['msg'])) { ?>
            <div class="popup popup-green">
                <h2><?= $_REQUEST['msg'] ?></h2>
            </div>
        <?php }
         unset($_REQUEST['msg']);
        ?>


        <!-- login section start -->
        <div class="form-section">
            <h2 class="form-title">Admin Login</h2>
            <div class="error">
                <?php if(isset($_SESSION['error'])){?>
                    <p class="error-msg"><?=$_SESSION['error']?></p>
                <?php } 
                  unset($_SESSION['error']);
                ?>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="login-form">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                </div>

                <div class="help-text">
                    Don't have an account? <a href="adminRegister.php">Create Account</a>
                </div>

                <div class="center">
                    <button class="btn btn-green" type="submit" name="login">Login</button>
                </div>

            </form>
        </div>
        <!-- login section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>
        <p>Developed by <a href="mailto:ratulsikder104@gmail.com">Ratul Sikder</a></p>
    </footer>
    <!-- footer section end -->

</body>

</html>