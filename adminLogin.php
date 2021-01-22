<?php

// include config file
require_once("config/config.php");


// if clicked on login
if(isset($_REQUEST['login'])){

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
        <nav>

        </nav>
    </header>
    <!-- header section end -->

    <!-- main section -->
    <section class="main-container">
        <!-- login section start -->
        <div class="login-section">
            <h2 class="form-title">Admin Login</h2>
            <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="login-form">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                </div>

                <div class="input-group">
                    <input type="submit" name="login" value="Login">
                </div>


            </form>
        </div>
        <!-- login section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>