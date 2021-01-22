<?php

// include config file
require_once("config/config.php");

// admin object
$admin = new Admin($db);

// // Check if admin is not logged in
// if (!($admin->is_logged_in())) {

//     $admin->redirect('index.php');
// }

// get all event regrading admins
$eventObj = new Event($db);
$allEvents = $eventObj->getAllEvent();

// logout button 
if (isset($_REQUEST['logout'])) {
    $admin->logout();
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
        <div class="logo">
            EVENT ASSIGNMENT
        </div>
        <nav>
            <ul>
                <?php if (isset($_SESSION["name"])) { ?>
                    <li><?= $_SESSION["name"] ?></li>
                    <li>

                        <a href="index.php?logout=true" class="btn">Logout</a>

                    </li>
                <?php } else { ?>
                    <li><a href="adminLogin.php">Login</a></li>
                    <li><a href="adminRegister.php">Register</a></li>
                <?php } ?>

            </ul>


        </nav>
    </header>
    <!-- header section end -->

    <!-- main section -->
    <section class="main-container">
        <!-- list section start -->
        <div class="event-list">
            <?php foreach ($allEvents as $singleEvent) { ?>
                <a href="eventDetails.php?id=<?= $singleEvent->id?>" >
                    <h2 class="event-title">
                        <?= $singleEvent->title ?>
                    </h2>
                </a>
            <?php } ?>
        </div>
        <!-- list section end -->
    </section>
    <!-- main section end -->


    <!-- footer section start -->
    <footer>

    </footer>
    <!-- footer section end -->

</body>

</html>