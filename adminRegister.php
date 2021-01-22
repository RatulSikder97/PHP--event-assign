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

    // create the admin
    if ($admin->register()) {
        header('Location: adminLogin.php');
    } else {
        echo "Error happend";
    }
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
   
    </header>
    <!-- header section end -->

    <!-- main section -->
    <section class="main-container">
        <!-- register section start -->
        <div class="register-section">
            <h2 class="form-title">Admin Registration</h2>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="login-form">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter name">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                </div>

                <div class="input-group">
                    <input type="submit" name="register" value="Registration">
                </div>


            </form>
        </div>
        <!-- register section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>